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
			$this->mapTileArray[$currentY][$currentX] = new MapTile($mapTileCode);

			$currentX += 1;
			if($currentX >= self::maxX) {
				$currentX = 0;
				$currentY += 1;
			}
		}
		$this->MakeLineOfSightTilesVisible();	
	}
	
	public function FillMapTileArrayFromDAL() {
		$this->FillMapTileArray($this->mapDAL->GetMapTileCodeArray());
	}
	
	public function GetCharacterTile() {
		$yxCords = $this->FindCharacterTileCords();
		return $this->mapTileArray[$yxCords[0]][$yxCords[1]];
	}
	
	private function MakeLineOfSightTilesVisible() {
		$yxCords = $this->FindCharacterTileCords();
		if($yxCords != false) {
			$mapTileArray = $this->mapTileArray;
			
			if($mapTileArray[$yxCords[0]][$yxCords[1]]->HasNorthExit()) {
				$mapTileArray[$yxCords[0] - 1][$yxCords[1]]->MakeVisible();
			}
			if($mapTileArray[$yxCords[0]][$yxCords[1]]->HasEastExit()) {
				$mapTileArray[$yxCords[0]][$yxCords[1] + 1]->MakeVisible();
			}
			if($mapTileArray[$yxCords[0]][$yxCords[1]]->HasWestExit()) {
				$mapTileArray[$yxCords[0]][$yxCords[1] - 1]->MakeVisible();
			}
			if($mapTileArray[$yxCords[0]][$yxCords[1]]->HasSouthExit()) {
				$mapTileArray[$yxCords[0] + 1][$yxCords[1]]->MakeVisible();
			}
		}
	}
	
	private function FindCharacterTileCords() {
		for($yCord = 0; $yCord < self::maxY; $yCord += 1) {
			for($xCord = 0; $xCord < self::maxX; $xCord += 1) {
				if($this->mapTileArray[$yCord][$xCord]->HasCharacter()) {
					return [$yCord, $xCord];
				}
			}
		}
		return false;
	}
}

