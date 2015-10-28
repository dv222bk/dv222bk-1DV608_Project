<?php

namespace model;

/*
 * Class: model/Maze
 * 
 * Contains everything about the maze
 */

class Maze {
	
	const maxX = 16;
	const maxY = 6;
	
	private $mazeTileArray = array(array());
	private $charPos;
	
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
		assert(is_array($mazeTileCodeArray));
		
		for($y = 0; $y < self::maxY; $y += 1) {
			for($x = 0; $x < self::maxX; $x += 1) {
				$this->mazeTileArray[$y][$x] = new MazeTile($mazeTileCodeArray[$y][$x]);
			}
		}
	}
	
	public function FillMazeTileArrayFromString($mazeTileCodeString) {
		assert(is_string($mazeTileCodeString));
		
		$mazeTileCodeString = rtrim($mazeTileCodeString);
		$codeArray = explode(PHP_EOL, $mazeTileCodeString);
		
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
}

