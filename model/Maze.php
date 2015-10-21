<?php

namespace model;

class Maze {
	
	const maxX = 16;
	const maxY = 6;
	
	private $mazeDAL;
	private $mazeTileArray = array(array());
	private $charPos;
	private $score = 0;
	private $steps = 500;
	
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
	
	public function GetScore() {
		return $this->score;
	}
	
	public function GetSteps() {
		return $this->steps;
	}
	
	public function SetSteps($stepsLeft) {
		$this->steps = $stepsLeft;
	}
	
	public function SetScore($newScore) {
		$this->score = $newScore;
	}
	
	public function FillMazeTileArray($mazeTileCodeArray) {
		for($y = 0; $y < self::maxY; $y += 1) {
			for($x = 0; $x < self::maxX; $x += 1) {
				$this->mazeTileArray[$y][$x] = new MazeTile($mazeTileCodeArray[$y][$x]);
			}
		}
		$this->MakeLineOfSightTilesVisible();
	}
	
	public function FillMazeTileArrayFromDAL() {
		$this->FillMazeTileArray($this->mazeDAL->GetMazeTileCodeArray());
	}
	
	public function GetCharacterTile() {
		$yxCords = $this->FindCharacterTileCords();
		return $this->mazeTileArray[$yxCords[0]][$yxCords[1]];
	}
	
	private function MakeLineOfSightTilesVisible() {
		$yxCords = $this->FindCharacterTileCords();
		if($yxCords != false) {
			$mazeTileArray = $this->mazeTileArray;
			
			if($mazeTileArray[$yxCords[0]][$yxCords[1]]->HasNorthExit()) {
				$mazeTileArray[$yxCords[0] - 1][$yxCords[1]]->MakeVisible();
			}
			if($mazeTileArray[$yxCords[0]][$yxCords[1]]->HasEastExit()) {
				$mazeTileArray[$yxCords[0]][$yxCords[1] + 1]->MakeVisible();
			}
			if($mazeTileArray[$yxCords[0]][$yxCords[1]]->HasWestExit()) {
				$mazeTileArray[$yxCords[0]][$yxCords[1] - 1]->MakeVisible();
			}
			if($mazeTileArray[$yxCords[0]][$yxCords[1]]->HasSouthExit()) {
				$mazeTileArray[$yxCords[0] + 1][$yxCords[1]]->MakeVisible();
			}
		}
	}
	
	private function FindCharacterTileCords() {
		for($yCord = 0; $yCord < self::maxY; $yCord += 1) {
			for($xCord = 0; $xCord < self::maxX; $xCord += 1) {
				if($this->mazeTileArray[$yCord][$xCord]->HasCharacter()) {
					return [$yCord, $xCord];
				}
			}
		}
		return false;
	}
}

