<?php

namespace controller;

class MapController {
	
	private $map;
	private $mapView;
	
	public function __construct(\model\Map $model, \view\MapView $view) {
		$this->map = $model;
		$this->mapView = $view;
	}
	
	public function SaveMap() {
		$this->map->FillMapTileArray($this->CreateMapTileCodeArray());
		$this->mapView->SaveMapTileArray($this->map->GetMapTileArray());
	}
	
	public function CreateMapTileCodeArray() {
		$maxX = $this->map->GetMaxX();
		$maxY = $this->map->GetMaxY();
		
		$characterCords = $this->GetRandomMapTileCords();
		$exitCords = $this->GetRandomMapTileCords();
		while($characterCords == $exitCords) {
			$exitCords = $this->GetRandomMapTileCords();
		}
		
		$mapTileCodeArray = array(array());
		
		for($y = 0; $y < $maxY; $y += 1) {
			for($x = 0; $x < $maxX; $x += 1) {
				$mapTileCode = "";
				
				if($y == $characterCords[0] && $x == $characterCords[1]) {
					$mapTileCode .= "C";
				}
				
				if($y == $exitCords[0] && $x == $exitCords[1]) {
					$mapTileCode .= "Q";
				}
				
				// If the tile to the north has an exit south, connect this tile to it
				if($y - 1 >= 0) {
					if (is_numeric(strpos($mapTileCodeArray[$y - 1][$x], "S"))) {
						$mapTileCode .= "N" . $this->GetRandomHazard();
					}
				}
				
				// If the tile to the west has an exit east, connect this tile to it
				if($x - 1 >= 0) {
					if (is_numeric(strpos($mapTileCodeArray[$y][$x - 1], "E"))) {
						$mapTileCode .= "W" . $this->GetRandomHazard();
					}
				}
				
				// Randomize a south and/or west exit, or add a south or east exit if only one is possible
				if($y + 1 < $maxY && $x + 1 < $maxX) {
					if(mt_rand(0, 1)) {
						$mapTileCode .= "S" . $this->GetRandomHazard();
						if(mt_rand(0, 1)) {
							$mapTileCode .= "E" . $this->GetRandomHazard();
						}
					} else {
						$mapTileCode .= "E" . $this->GetRandomHazard();
						if(mt_rand(0, 1)) {
							$mapTileCode .= "S" . $this->GetRandomHazard();
						}
					}
				} else if ($y + 1 < $maxY) {
					// If the tile to the left of this tile has an exit in all directions
					if(!is_numeric(strpos($mapTileCodeArray[$y][$x - 1], "E")) ||
					!is_numeric(strpos($mapTileCodeArray[$y][$x - 1], "N")) ||
					!is_numeric(strpos($mapTileCodeArray[$y][$x - 1], "W")) ||
					!is_numeric(strpos($mapTileCodeArray[$y][$x - 1], "S"))) {
						$mapTileCode .= "S" . $this->GetRandomHazard();
					}
				} else if ($x + 1 < $maxX) {
					// If the tile above this tile has an exit in all directions
					if(!is_numeric(strpos($mapTileCodeArray[$y - 1][$x], "E")) ||
					!is_numeric(strpos($mapTileCodeArray[$y - 1][$x], "N")) ||
					!is_numeric(strpos($mapTileCodeArray[$y - 1][$x], "W")) ||
					!is_numeric(strpos($mapTileCodeArray[$y - 1][$x], "S"))) {
						$mapTileCode .= "E" . $this->GetRandomHazard();
					}
				} else {
					// prevent that the last tile is empty
					$mapTileCode .= "W" . $this->GetRandomHazard();
					$mapTileCode .= "N" . $this->GetRandomHazard();
					$mapTileCodeArray[$y - 1][$x] .= "S" . $this->GetRandomHazard();
					$mapTileCodeArray[$y][$x - 1] .= "E" . $this->GetRandomHazard();
				}

				$mapTileCodeArray[$y][$x] = $mapTileCode;
			}
		}
		
		return $mapTileCodeArray;
	}

	private function GetRandomMapTileCords() {
		return [mt_rand(0, $this->map->GetMaxY() - 1), mt_rand(0, $this->map->GetMaxX() - 1)];
	}

	private function GetRandomHazard() {
		$randomNumber = mt_rand(0, 12);
		
		switch ($randomNumber) {
			case 10:
				return "P";
			case 11:
				return "G";
			case 12:
				return "H";
			default:
				return "";
		}
	}
	
	private function ValidateMapTileCodeArray($mapTileCodeArray) {
		
	}
}
