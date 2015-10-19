<?php

namespace controller;

class Controls {
	
	private $map;
	private $controlsView;
	
	public function __construct(\model\Map $model, \view\ControlsView $view) {
		$this->map = $model;
		$this->controlsView = $view;
	}
	
	public function EnableButtons() {
		$mapTile = $this->map->GetCharacterTile();
		
		if($mapTile->HasNorthExit()) {
			$this->controlsView->EnableNorth();
		}
		
		if($mapTile->HasEastExit()) {
			$this->controlsView->EnableEast();
		}
		
		if($mapTile->HasSouthExit()) {
			$this->controlsView->EnableSouth();
		}
		
		if($mapTile->HasWestExit()) {
			$this->controlsView->EnableWest();
		}
		
		if($mapTile->HasMapExit()) {
			$this->controlsView->EnableMapExit();
		}
	}
}
