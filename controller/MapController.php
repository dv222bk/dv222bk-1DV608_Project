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
		$this->map->FillMapTileArrayFromDAL();
		$this->mapView->SaveMapTileArray($this->map->GetMapTileArray());
	}
}
