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
	
	public function MoveCharacter() {
		$mazeTileArray = $this->maze->GetMazeTileArray();
		$characterTileCords = $this->maze->GetCharacterTileCords();
		$newTileCords = $characterTileCords;
		$stepsTaken = 1;
		
		if($this->controlsView->NorthClicked()) {
			
			if(!$mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]]->HasNorthExit()) {
				throw new \model\exceptions\CantMoveInDirectionException();
			}
			
			$newTileCords["y"] -= 1;
			
			$stepsTaken += $this->GetStepsReductionFromTile($mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]], "N");
			$stepsTaken += $this->GetStepsReductionFromTile($mazeTileArray[$newTileCords["y"]][$newTileCords["x"]], "S");
						
		} else if ($this->controlsView->EastClicked()) {
			
			if(!$mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]]->HasEastExit()) {
				throw new \model\exceptions\CantMoveInDirectionException();
			}
			
			$newTileCords["x"] += 1;
			
			$stepsTaken += $this->GetStepsReductionFromTile($mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]], "E");
			$stepsTaken += $this->GetStepsReductionFromTile($mazeTileArray[$newTileCords["y"]][$newTileCords["x"]], "W");
			
		} else if ($this->controlsView->WestClicked()) {
			
			if(!$mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]]->HasWestExit()) {
				throw new \model\exceptions\CantMoveInDirectionException();
			}
			
			$newTileCords["x"] -= 1;
			
			$stepsTaken += $this->GetStepsReductionFromTile($mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]], "W");
			$stepsTaken += $this->GetStepsReductionFromTile($mazeTileArray[$newTileCords["y"]][$newTileCords["x"]], "E");
			
		} else if ($this->controlsView->SouthClicked()) {
			
			if(!$mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]]->HasSouthExit()) {
				throw new \model\exceptions\CantMoveInDirectionException();
			}
			
			$newTileCords["y"] += 1;
			
			$stepsTaken += $this->GetStepsReductionFromTile($mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]], "S");
			$stepsTaken += $this->GetStepsReductionFromTile($mazeTileArray[$newTileCords["y"]][$newTileCords["x"]], "N");
			
		}
		
		$mazeTileCode = $mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]]->GetMazeTileCode();
		$mazeTileCode = str_replace("C", "", $mazeTileCode);
		$mazeTileArray[$characterTileCords["y"]][$characterTileCords["x"]]->SetMazeTileCode($mazeTileCode);
		
		$mazeTileCode = $mazeTileArray[$newTileCords["y"]][$newTileCords["x"]]->GetMazeTileCode();
		$mazeTileCode .= "C";
		$mazeTileArray[$newTileCords["y"]][$newTileCords["x"]]->SetMazeTileCode($mazeTileCode);
		
		return $stepsTaken;
	}

	private function GetStepsReductionFromTile($tile, $directionChar) {
		if($mazeHazard = $tile->GetHazard($directionChar)) {
			return $mazeHazard->GetStepRedcution();
		}
		return 0;
	}
}
