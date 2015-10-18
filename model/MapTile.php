<?php
    
namespace model;

class MapTile {
	
	/*
	 * MAPTILE CODE SHEET
	 * 
	 * Character
	 * C - The character is standing on this tile
	 * 
	 * Directional exits
	 * N - Has North Exit
	 * E - Has East Exit
	 * S - Has South Exit
	 * W - Has West Exit
	 * 
	 * Exit
	 * Q - Has Exit to next map
	 * 
	 * Hazards are placed directly after a directional exit
	 * H - Has Spike Hazard
	 * P - Has Pit Hazard
	 * G - Has Goo Hazard
	 * 
	 * Sample code:
	 * CNEHS
	 * The character is occupying this tile. This tile has a north, east and south exit. At the east exit, there's a spike hazard
	 */
	
	private $mapTileCode;
	private $visible = false;
	
	public function __construct($code) {
		assert(is_string($code));
		$this->mapTileCode = $code;
		
		if($this->hasCharacter()) {
			$this->visible = true;
		}
	}
	
	public function MakeVisible() {
		$this->visible = true;
	}
	
	public function GetVisibility() {
		return $this->visible;
	}
	
	public function GetMapTileCode() {
		return $mapTileCode;
	}
	
	public function SetMapTileCode($code) {
		$this->__construct($code);
	}
	
	public function HasCharacter() {
		if(strpos($this->mapTileCode, 'C')) {
			return true;
		}
		return false;
	}
	
	public function HasNorthExit() {
		if(strpos($this->mapTileCode, 'N')) {
			return true;
		}
		return false;
	}
	
	public function HasEastExit() {
		if(strpos($this->mapTileCode, 'E')) {
			return true;
		}
		return false;
	}

	public function HasSouthExit() {
		if(strpos($this->mapTileCode, 'S')) {
			return true;
		}
		return false;
	}
	
	public function HasWestExit() {
		if(strpos($this->mapTileCode, 'W')) {
			return true;
		}
		return false;
	}

	public function HasMapExit() {
		if(strpos($this->mapTileCode, 'Q')) {
			return true;
		}
		return false;
	}

	public function GetNorthHazard() {
		if(strpos($this->mapTileCode, 'NH')) {
			return new MapHazard(MapHazard::Spike);
		} else if (strpos($this->mapTileCode, 'NP')) {
			return new MapHazard(MapHazard::Pit);
		} else if (strpos($this->mapTileCode, 'NG')) {
			return new MapHazard(MapHazard::Goo);
		}
		return new MapHazard(MapHazard::None);
	}
	
	public function GetEastHazard() {
		if(strpos($this->mapTileCode, 'EH')) {
			return new MapHazard(MapHazard::Spike);
		} else if (strpos($this->mapTileCode, 'EP')) {
			return new MapHazard(MapHazard::Pit);
		} else if (strpos($this->mapTileCode, 'EG')) {
			return new MapHazard(MapHazard::Goo);
		}
		return new MapHazard(MapHazard::None);
	}
	
	public function GetSouthHazard() {
		if(strpos($this->mapTileCode, 'SH')) {
			return new MapHazard(MapHazard::Spike);
		} else if (strpos($this->mapTileCode, 'SP')) {
			return new MapHazard(MapHazard::Pit);
		} else if (strpos($this->mapTileCode, 'SG')) {
			return new MapHazard(MapHazard::Goo);
		}
		return new MapHazard(MapHazard::None);
	}
	
	public function GetWestHazard() {
		if(strpos($this->mapTileCode, 'WH')) {
			return new MapHazard(MapHazard::Spike);
		} else if (strpos($this->mapTileCode, 'WP')) {
			return new MapHazard(MapHazard::Pit);
		} else if (strpos($this->mapTileCode, 'WG')) {
			return new MapHazard(MapHazard::Goo);
		}
		return new MapHazard(MapHazard::None);
	}
}