<?php
    
namespace model;

class MazeTile {
	
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
	 * Q - Has Exit to next maze
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
	
	private $mazeTileCode;
	private $mazeHazard;
	private $visible = false;
	
	public function __construct($code) {
		assert(is_string($code));
		$this->mazeTileCode = $code;
		
		if($this->hasCharacter()) {
			$this->visible = true;
		}
		
		$this->mazeHazard = new MazeHazard();
	}
	
	public function MakeVisible() {
		$this->visible = true;
	}
	
	public function GetVisibility() {
		return $this->visible;
	}
	
	public function GetMazeTileCode() {
		return $this->mazeTileCode;
	}
	
	public function SetMazeTileCode($code) {
		$this->__construct($code);
	}
	
	public function HasCharacter() {
		if(is_numeric(strpos($this->mazeTileCode, 'C'))) {
			return true;
		}
		return false;
	}
	
	public function HasNorthExit() {
		if(is_numeric(strpos($this->mazeTileCode, 'N'))) {
			return true;
		}
		return false;
	}
	
	public function HasEastExit() {
		if(is_numeric(strpos($this->mazeTileCode, 'E'))) {
			return true;
		}
		return false;
	}

	public function HasSouthExit() {
		if(is_numeric(strpos($this->mazeTileCode, 'S'))) {
			return true;
		}
		return false;
	}
	
	public function HasWestExit() {
		if(is_numeric(strpos($this->mazeTileCode, 'W'))) {
			return true;
		}
		return false;
	}

	public function HasMazeExit() {
		if(is_numeric(strpos($this->mazeTileCode, 'Q'))) {
			return true;
		}
		return false;
	}

	public function GetNorthHazard() {
		if(is_numeric(strpos($this->mazeTileCode, 'NH'))) {
			return $this->mazeHazard->GetSpike();
		} else if (is_numeric(strpos($this->mazeTileCode, 'NP'))) {
			return $this->mazeHazard->GetPit();
		} else if (is_numeric(strpos($this->mazeTileCode, 'NG'))) {
			return $this->mazeHazard->GetGoo();
		}
		return '&nbsp;';
	}
	
	public function GetEastHazard() {
		if(is_numeric(strpos($this->mazeTileCode, 'EH'))) {
			return $this->mazeHazard->GetSpike();
		} else if (is_numeric(strpos($this->mazeTileCode, 'EP'))) {
			return $this->mazeHazard->GetPit();
		} else if (is_numeric(strpos($this->mazeTileCode, 'EG'))) {
			return $this->mazeHazard->GetGoo();
		}
		return '&nbsp;';
	}
	
	public function GetSouthHazard() {
		if(is_numeric(strpos($this->mazeTileCode, 'SH'))) {
			return $this->mazeHazard->GetSpike();
		} else if (is_numeric(strpos($this->mazeTileCode, 'SP'))) {
			return $this->mazeHazard->GetPit();
		} else if (is_numeric(strpos($this->mazeTileCode, 'SG'))) {
			return $this->mazeHazard->GetGoo();
		}
		return '&nbsp;';
	}
	
	public function GetWestHazard() {
		if(is_numeric(strpos($this->mazeTileCode, 'WH'))) {
			return $this->mazeHazard->GetSpike();
		} else if (is_numeric(strpos($this->mazeTileCode, 'WP'))) {
			return $this->mazeHazard->GetPit();
		} else if (is_numeric(strpos($this->mazeTileCode, 'WG'))) {
			return $this->mazeHazard->GetGoo();
		}
		return '&nbsp;';
	}
}