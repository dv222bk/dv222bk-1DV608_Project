<?php

namespace controller;

class Controls {
	
	private $maze;
	private $controlsView;
	
	public function __construct(\model\Maze $model, \view\ControlsView $view) {
		$this->maze = $model;
		$this->controlsView = $view;
	}
	
	public function EnableButtons() {
		$mazeTile = $this->maze->GetCharacterTile();
		
		if($mazeTile->HasNorthExit()) {
			$this->controlsView->EnableNorth();
		}
		
		if($mazeTile->HasEastExit()) {
			$this->controlsView->EnableEast();
		}
		
		if($mazeTile->HasSouthExit()) {
			$this->controlsView->EnableSouth();
		}
		
		if($mazeTile->HasWestExit()) {
			$this->controlsView->EnableWest();
		}
		
		if($mazeTile->HasMazeExit()) {
			$this->controlsView->EnableMazeExit();
		}
	}
}
