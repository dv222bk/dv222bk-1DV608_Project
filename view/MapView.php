<?php

namespace view;

class MapView {
	
	private $mapTileArray = array(array());
	
	public function SaveMapTileArray($array) {
		$this->mapTileArray = $array;
	}
	
	public function GetMapHTML() {
		$drawMapTile = new DrawMapTile();	
		$map = "";
		
		foreach($this->mapTileArray as $tileRow) {
			foreach($tileRow as $mapTile) {
				$map .= $drawMapTile->DrawMapTile($mapTile);
			}
		}
		
		return $map;
	}
}
