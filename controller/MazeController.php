<?php

namespace controller;

/*
 * Class: controller/MazeController
 * 
 * Keeps track of the logic concerning the maze.
 */

class MazeController {
	
	private $maze;
	private $mazeDAL;
	private $mazeView;
	
	public function __construct(\model\Maze $model, \model\DAL\MazeDAL $DAL, \view\MazeView $view) {
		$this->maze = $model;
		$this->mazeDAL = $DAL;
		$this->mazeView = $view;
	}
	
	public function InitMaze() {
		if($this->mazeView->GetIdentification()) {
			$this->mazeDAL->GetDatabaseContent($this->mazeView->GetIdentification(), $this->mazeView->GetUserAgent());
			$this->maze->FillMazeTileArrayFromString($this->mazeDAL->GetMazeString());
		} else {
			$this->mazeView->SetIdentification($this->CreateNewIdentification());
			$this->maze->FillMazeTileArray($this->CreateMazeTileCodeArray());
		}
		$this->mazeView->SaveMazeTileArray($this->maze->GetMazeTileArray());
	}
	
	public function SaveMaze($score, $stepsAtStartOfMaze, $stepsLeft) {
		assert(is_numeric($score));
		assert(is_numeric($stepsAtStartOfMaze));
		assert(is_numeric($stepsLeft));
		
		$this->mazeDAL->SaveContentToDatabase(
			$this->mazeView->GetIdentification(), 
			$this->mazeView->GetUserAgent(), 
			$this->maze->GetMazeTileArray(),
			$score, 
			$stepsAtStartOfMaze, 
			$stepsLeft
		);
	}
	
	public function RemoveMaze() {
		$this->mazeDAL->RemoveFromDatabase($this->mazeView->GetIdentification(), $this->mazeView->GetUserAgent());
		$this->mazeView->RemoveIdentification();
	}

	public function CreateMazeTileCodeArray() {
		$maxX = $this->maze->GetMaxX();
		$maxY = $this->maze->GetMaxY();
		
		$characterCords = $this->GetRandomMazeTileCords();
		$exitCords = $this->GetRandomMazeTileCords();
		
		// prevent that the exit has the same cords as the character
		while($characterCords == $exitCords) {
			$exitCords = $this->GetRandomMazeTileCords();
		}
		
		$mazeTileCodeArray = array(array());
		
		for($y = 0; $y < $maxY; $y += 1) {
			for($x = 0; $x < $maxX; $x += 1) {
				$mazeTileCode = "";
				
				if($y == $characterCords['y'] && $x == $characterCords['x']) {
					$mazeTileCode .= "C";
				}
				
				if($y == $exitCords['y'] && $x == $exitCords['x']) {
					$mazeTileCode .= "Q";
				}
				
				// If the tile to the north has an exit south, connect this tile to it
				if($y - 1 >= 0) {
					if (is_numeric(strpos($mazeTileCodeArray[$y - 1][$x], "S"))) {
						$mazeTileCode .= "N" . $this->GetRandomHazardChar();
					}
				}
				
				// If the tile to the west has an exit east, connect this tile to it
				if($x - 1 >= 0) {
					if (is_numeric(strpos($mazeTileCodeArray[$y][$x - 1], "E"))) {
						$mazeTileCode .= "W" . $this->GetRandomHazardChar();
					}
				}
				
				// Randomize a south and/or east exit, or add a south or east exit if only one is possible
				if($y + 1 < $maxY && $x + 1 < $maxX) {
					if(mt_rand(0, 1)) {
						$mazeTileCode .= "S" . $this->GetRandomHazardChar();
						if(mt_rand(0, 1)) {
							$mazeTileCode .= "E" . $this->GetRandomHazardChar();
						}
					} else {
						$mazeTileCode .= "E" . $this->GetRandomHazardChar();
						if(mt_rand(0, 1)) {
							$mazeTileCode .= "S" . $this->GetRandomHazardChar();
						}
					}
				} else if ($y + 1 < $maxY) {
					// If the tile to the left of this tile has an exit in all directions
					if(!is_numeric(strpos($mazeTileCodeArray[$y][$x - 1], "E")) ||
					!is_numeric(strpos($mazeTileCodeArray[$y][$x - 1], "N")) ||
					!is_numeric(strpos($mazeTileCodeArray[$y][$x - 1], "W")) ||
					!is_numeric(strpos($mazeTileCodeArray[$y][$x - 1], "S"))) {
						$mazeTileCode .= "S" . $this->GetRandomHazardChar();
					}
				} else if ($x + 1 < $maxX) {
					// If the tile above this tile has an exit in all directions
					if(!is_numeric(strpos($mazeTileCodeArray[$y - 1][$x], "E")) ||
					!is_numeric(strpos($mazeTileCodeArray[$y - 1][$x], "N")) ||
					!is_numeric(strpos($mazeTileCodeArray[$y - 1][$x], "W")) ||
					!is_numeric(strpos($mazeTileCodeArray[$y - 1][$x], "S"))) {
						$mazeTileCode .= "E" . $this->GetRandomHazardChar();
					}
				} else {
					// prevent that the last tile is empty
					$mazeTileCode .= "W" . $this->GetRandomHazardChar();
					$mazeTileCode .= "N" . $this->GetRandomHazardChar();
					$mazeTileCodeArray[$y - 1][$x] .= "S" . $this->GetRandomHazardChar();
					$mazeTileCodeArray[$y][$x - 1] .= "E" . $this->GetRandomHazardChar();
				}

				$mazeTileCodeArray[$y][$x] = $mazeTileCode;
			}
		}
		
		return $mazeTileCodeArray;
	}

	public function MakeLineOfSightTilesVisible() {
		$yxCords = $this->maze->GetCharacterTileCords();
		if($yxCords != false) {
			$mazeTileArray = $this->maze->GetMazeTileArray();
			
			$distance = 0;
			while($mazeTileArray[$yxCords["y"] - $distance][$yxCords["x"]]->HasNorthExit()) {
				if($mazeTileArray[$yxCords["y"] - ($distance + 1)][$yxCords["x"]]->HasSouthExit()) {
					$mazeTileArray[$yxCords["y"] - ($distance + 1)][$yxCords["x"]]->MakeVisible();
				}	
				$distance += 1;
			}
			
			$distance = 0;
			while($mazeTileArray[$yxCords["y"]][$yxCords["x"] + $distance]->HasEastExit()) {
				if($mazeTileArray[$yxCords["y"]][$yxCords["x"] + ($distance + 1)]->HasWestExit()) {
					$mazeTileArray[$yxCords["y"]][$yxCords["x"] + ($distance + 1)]->MakeVisible();
				}	
				$distance += 1;
			}
			
			$distance = 0;
			while($mazeTileArray[$yxCords["y"]][$yxCords["x"] - $distance]->HasWestExit()) {
				if($mazeTileArray[$yxCords["y"]][$yxCords["x"] - ($distance + 1)]->HasEastExit()) {
					$mazeTileArray[$yxCords["y"]][$yxCords["x"] - ($distance + 1)]->MakeVisible();
				}	
				$distance += 1;
			}
			
			$distance = 0;
			while($mazeTileArray[$yxCords["y"] + $distance][$yxCords["x"]]->HasSouthExit()) {
				if($mazeTileArray[$yxCords["y"] + ($distance + 1)][$yxCords["x"]]->HasNorthExit()) {
					$mazeTileArray[$yxCords["y"] + ($distance + 1)][$yxCords["x"]]->MakeVisible();
				}	
				$distance += 1;
			}
		}
	}

	public function NextMaze() {
		if($this->maze->GetCharacterTile()->HasMazeExit()) {
			$this->maze->FillMazeTileArray($this->CreateMazeTileCodeArray());
			$this->mazeView->SaveMazeTileArray($this->maze->GetMazeTileArray());
		} else {
			throw new \model\exceptions\CantMoveInDirectionException();
		}
	}

	/**
	 * Returns an array containing a randomized Y and X cordinate on the maze
	 * Values can be retrived using array["x"] and array["y"];
	 */
	private function GetRandomMazeTileCords() {
		return  ['y' => mt_rand(0, $this->maze->GetMaxY() - 1), 'x' => mt_rand(0, $this->maze->GetMaxX() - 1)];
	}

	private function GetRandomHazardChar() {
		$mazeHazards = (new \model\HazardFactory())->GetStandardHazards();
		
		if(mt_rand(0, 12) >= 10) {
			return $mazeHazards[mt_rand(0, count($mazeHazards) - 1)]->GetMazeTileCodeChar(); 
		}
		
		return "";
	}
	
	/*
	 * Creates a new identification string, used for identifying which maze belongs to which user
	 */
	private function CreateNewIdentification() {
		return password_hash(str_shuffle(bin2hex(openssl_random_pseudo_bytes(200))), PASSWORD_BCRYPT);
	}
}
