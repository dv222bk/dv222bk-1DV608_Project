<?php

namespace controller;

class MasterController {
	
	private $mazeDAL;
	private $maze;
	private $layoutView;
	private $mazeView;
	private $controlsView;
	private $controls;
	private $mazeController;
	private $scoreKeeper;
	
	public function __construct() {
		$this->mazeDAL = new \model\DAL\MazeDAL();
		$this->maze = new \model\Maze();
		$this->layoutView = new \view\LayoutView();
		$this->mazeView = new \view\MazeView();
		$this->controlsView = new \view\ControlsView();
		$this->controls = new \controller\Controls($this->maze, $this->controlsView);
		$this->mazeController = new \controller\MazeController($this->maze, $this->mazeDAL, $this->mazeView);
		$this->scoreKeeper = new \model\ScoreKeeper();
	}
	
	public function PlayGame() {
		
		if($this->controlsView->RestartClicked()) {
			try {
				$this->mazeController->RemoveMaze();
			}
			catch (\model\exceptions\DatabaseException $e) {
				$this->mazeView->SaveExceptionMessage($e);
			}
		}
		
		try {
			$this->mazeController->InitMaze();
		}
		catch (\model\exceptions\IncorrectCookieInformationException $e) {
			$this->mazeView->SaveExceptionMessage($e);
			$this->mazeController->RemoveMaze();
			try {
				$this->mazeController->InitMaze();
			}
			catch (\model\exceptions\DatabaseException $e) {
				$this->mazeView->SaveExceptionMessage($e);
			}
		}
		catch (\model\exceptions\DatabaseException $e) {
			$this->mazeView->SaveExceptionMessage($e);
		}
		
		if($this->mazeDAL->HasReadInformation()) {
			$this->scoreKeeper->SetScore($this->mazeDAL->GetScore());
			$this->scoreKeeper->SetStepsAtStartOfMaze($this->mazeDAL->GetStepsAtStartOfMaze());
			$this->scoreKeeper->SetStepsLeft($this->mazeDAL->GetStepsLeft());
		}
		
		$stepsTaken = 0;
		
		if($this->controlsView->NorthClicked() || $this->controlsView->WestClicked() || 
		$this->controlsView->EastClicked() || $this->controlsView->SouthClicked()) {
			
			if($this->scoreKeeper->GetStepsLeft() > 0) {
				try {
					$stepsTaken = $this->controls->MoveCharacter();
					$this->scoreKeeper->DecreaseStepsLeft($stepsTaken);
					
					if($this->scoreKeeper->GetStepsLeft() <= 0) {
						$this->mazeView->SaveGameOverMessage($this->scoreKeeper->GetScore());
					}
				}
				catch (\model\exceptions\CantMoveInDirectionException $e) {
					$this->mazeView->SaveExceptionMessage($e);
				}
			} else {
				$this->mazeView->SaveGameOverMessage($this->scoreKeeper->GetScore());
			}
			
		} else if ($this->controlsView->MazeExitClicked()) {
			
			try {
				$this->mazeController->NextMaze();
				$this->scoreKeeper->AddScoreEndOfMaze();
			}
			catch (\model\exceptions\CantMoveInDirectionException $e) {
				$this->mazeView->SaveExceptionMessage($e);
			}
			
		}
		
		$this->maze->MakeLineOfSightTilesVisible();
		
		try {
			$this->mazeController->SaveMaze($this->scoreKeeper->GetScore(), $this->scoreKeeper->GetStepsAtStartOfMaze(), $this->scoreKeeper->GetStepsLeft());
		}
		catch (\model\exceptions\DatabaseException $e) {
			$this->mazeView->SaveExceptionMessage($e);
		}
		
		if($this->scoreKeeper->GetStepsLeft() > 0) {
			$this->controls->EnableButtons();
		}
		
		$this->layoutView->Render
		(
			$this->mazeView, 
			$this->controlsView, 
			$this->scoreKeeper->GetScore(), 
			$this->scoreKeeper->GetStepsLeft(),
			$stepsTaken
		);
	}
}
