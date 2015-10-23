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
		$this->maze = new \model\Maze($this->mazeDAL);
		$this->layoutView = new \view\LayoutView();
		$this->mazeView = new \view\MazeView();
		$this->controlsView = new \view\ControlsView();
		$this->controls = new \controller\Controls($this->maze, $this->controlsView);
		$this->mazeController = new \controller\MazeController($this->maze, $this->mazeDAL, $this->mazeView);
		$this->scoreKeeper = new \model\ScoreKeeper();
	}
	
	public function PlayGame() {
		
		try {
			$this->mazeController->InitMaze();
			
			if($this->mazeDAL->HasReadInformation()) {
				$this->scoreKeeper->SetScore($this->mazeDAL->GetScore());
				$this->scoreKeeper->SetStepsAtStartOfMaze($this->mazeDAL->GetStepsAtStartOfMaze());
				$this->scoreKeeper->SetStepsLeft($this->mazeDAL->GetStepsLeft());
			}
			
			if($this->controlsView->NorthClicked() || $this->controlsView->WestClicked() || 
			$this->controlsView->EastClicked() || $this->controlsView->SouthClicked()) {
				
				$stepsTaken = $this->controls->MoveCharacter();
				$this->scoreKeeper->DecreaseStepsLeft($stepsTaken);
				
			} else if ($this->controlsView->MazeExitClicked()) {
				
				$this->mazeController->NewMaze();
				$this->scoreKeeper->AddScoreEndOfMaze();
				
			}
			
			$this->maze->MakeLineOfSightTilesVisible();
			
			$this->mazeController->SaveMaze($this->scoreKeeper->GetScore(), $this->scoreKeeper->GetStepsAtStartOfMaze(), $this->scoreKeeper->GetStepsLeft());
			$this->controls->EnableButtons();
		}
		catch (\Exception $e) {
			$this->$mazeView->SaveExceptionMessage($e);
		}
		
		$this->layoutView->Render
		(
			$this->mazeView, 
			$this->controlsView, 
			$this->scoreKeeper->GetScore(), 
			$this->scoreKeeper->GetStepsLeft()
		);
	}
}
