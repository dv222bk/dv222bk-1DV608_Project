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
	private $mapHazard;
	private $visible = false;
	
	public function __construct($code) {
		assert(is_string($code));
		$this->mapTileCode = $code;
		
		if($this->hasCharacter()) {
			$this->visible = true;
		}
		
		$this->mapHazard = new MapHazard();
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
		if(is_numeric(strpos($this->mapTileCode, 'C'))) {
			return true;
		}
		return false;
	}
	
	public function HasNorthExit() {
		if(is_numeric(strpos($this->mapTileCode, 'N'))) {
			return true;
		}
		return false;
	}
	
	public function HasEastExit() {
		if(is_numeric(strpos($this->mapTileCode, 'E'))) {
			return true;
		}
		return false;
	}

	public function HasSouthExit() {
		if(is_numeric(strpos($this->mapTileCode, 'S'))) {
			return true;
		}
		return false;
	}
	
	public function HasWestExit() {
		if(is_numeric(strpos($this->mapTileCode, 'W'))) {
			return true;
		}
		return false;
	}

	public function HasMapExit() {
		if(is_numeric(strpos($this->mapTileCode, 'Q'))) {
			return true;
		}
		return false;
	}

	public function GetNorthHazard() {
		if(is_numeric(strpos($this->mapTileCode, 'NH'))) {
			return $this->mapHazard->GetSpike();
		} else if (is_numeric(strpos($this->mapTileCode, 'NP'))) {
			return $this->mapHazard->GetPit();
		} else if (is_numeric(strpos($this->mapTileCode, 'NG'))) {
			return $this->mapHazard->GetGoo();
		}
		return '&nbsp;';
	}
	
	public function GetEastHazard() {
		if(is_numeric(strpos($this->mapTileCode, 'EH'))) {
			return $this->mapHazard->GetSpike();
		} else if (is_numeric(strpos($this->mapTileCode, 'EP'))) {
			return $this->mapHazard->GetPit();
		} else if (is_numeric(strpos($this->mapTileCode, 'EG'))) {
			return $this->mapHazard->GetGoo();
		}
		return '&nbsp;';
	}
	
	public function GetSouthHazard() {
		if(is_numeric(strpos($this->mapTileCode, 'SH'))) {
			return $this->mapHazard->GetSpike();
		} else if (is_numeric(strpos($this->mapTileCode, 'SP'))) {
			return $this->mapHazard->GetPit();
		} else if (is_numeric(strpos($this->mapTileCode, 'SG'))) {
			return $this->mapHazard->GetGoo();
		}
		return '&nbsp;';
	}
	
	public function GetWestHazard() {
		if(is_numeric(strpos($this->mapTileCode, 'WH'))) {
			return $this->mapHazard->GetSpike();
		} else if (is_numeric(strpos($this->mapTileCode, 'WP'))) {
			return $this->mapHazard->GetPit();
		} else if (is_numeric(strpos($this->mapTileCode, 'WG'))) {
			return $this->mapHazard->GetGoo();
		}
		return '&nbsp;';
	}
}