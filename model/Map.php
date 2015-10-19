<?php

namespace model;

class Map {
	
	const maxX = 16;
	const maxY = 6;
	
	private $mapDAL;
	private $mapTileArray = array(array());
	private $charPos;
	
	public function __construct(\model\DAL\MapDAL $DAL) {
		$this->mapDAL = $DAL;
	}
	
	public function GetMapTileArray() {
		return $this->mapTileArray;
	}
	
	public function GetMaxX() {
		return self::maxX;
	}
	
	public function GetMaxY() {
		return self::maxY;
	}
	
	public function FillMapTileArray($mapTileCodeArray) {
		Assert(count($mapTileCodeArray) == self::maxX * self::maxY, "Count: " . count($mapTileCodeArray) . " Should be: " . self::maxX * self::maxY);
		
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
	
	public function FillMapTileArrayFromDAL() {
		$this->FillMapTileArray($this->mapDAL->GetMapTileCodeArray());
	}
}

