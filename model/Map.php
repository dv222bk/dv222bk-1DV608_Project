<?php

namespace model;

class Map {
	
	const maxX = 8;
	const maxY = 8;
	
	private $mapDAL;
	private $mapTileArray = array(array());
	private $charPos;
	
	public function __construct(\DAL\MapDAL $DAL) {
		$this->mapDAL = $DAL;
	}
	
	public function GetMapDAL(){
		return $mapDAL;
	}
	
	public function GetMapTileArray() {
		return $mapTileArray;
	}
	
	public function GetMaxX() {
		return self::maxX;
	}
	
	public function GetMaxY() {
		return self::maxY;
	}
	
	private function FillMapTileArray($mapTileCodeArray) {
		Assert(count($mapTileCodeArray) == self::maxX * self::maxY);
		
		$currentX = 0;
		$currentY = 0;
		
		foreach($mapTileCodeArray as $mapTileCode) {
			$this->mapTileArray[$currentX][$currentY] = new MapTile($mapTileCode);

			$currentY += 1;
			if($currentY >= self::maxY) {
				$currentY = 0;
				$currentX += 1;
			}
		}	
	}
	
	private function FillMapTileArrayFromDAL() {
		
	}
}

