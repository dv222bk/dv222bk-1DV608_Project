<?php

namespace model;

class Maze {
	
	const maxX = 16;
	const maxY = 6;
	
	private $mazeDAL;
	private $mazeTileArray = array(array());
	private $charPos;
	
	public function __construct(\model\DAL\MazeDAL $DAL) {
		$this->mazeDAL = $DAL;
	}
	
	public function GetMazeTileArray() {
		return $this->mazeTileArray;
	}
	
	public function GetMaxX() {
		return self::maxX;
	}
	
	public function GetMaxY() {
		return self::maxY;
	}
	
	public function FillMazeTileArray($mazeTileCodeArray) {
		for($y = 0; $y < self::maxY; $y += 1) {
			for($x = 0; $x < self::maxX; $x += 1) {
				$this->mazeTileArray[$y][$x] = new MazeTile($mazeTileCodeArray[$y][$x]);
			}
		}
	}
	
	public function FillMazeTileArrayFromDAL() {
		$codeArray = $this->mazeDAL->GetMazeTileCodeArray();
		
		$mazeTileArray = array(array());
		$arrayPos = 0;
		for($y = 0; $y < self::maxY; $y += 1) {
			for($x = 0; $x < self::maxX; $x += 1) {
				$mazeTileArray[$y][$x] = $codeArray[$arrayPos];
				$arrayPos += 1; 
			}
		}
		
		$this->FillMazeTileArray($mazeTileArray);
	}
	
	public function GetCharacterTile() {
		$yxCords = $this->GetCharacterTileCords();
		return $this->mazeTileArray[$yxCords["y"]][$yxCords["x"]];
	}
	
	public function GetCharacterTileCords() {
		for($yCord = 0; $yCord < self::maxY; $yCord += 1) {
			for($xCord = 0; $xCord < self::maxX; $xCord += 1) {
				if($this->mazeTileArray[$yCord][$xCord]->HasCharacter()) {
					return [ "y" => $yCord, "x" => $xCord];
				}
			}
		}
		return false;
	}
	
	public function MakeLineOfSightTilesVisible() {
		$yxCords = $this->GetCharacterTileCords();
		if($yxCords != false) {
			$mazeTileArray = $this->mazeTileArray;
			
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
}

