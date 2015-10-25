<?php

namespace model;

class PitHazard implements iMazeHazard {
	
	private $name;
	private $mazeTileCodeChar;
	private $stepReduction;
	
	public function __construct() {
		$this->name = "Pit";
		$this->mazeTileCodeChar = "P";
		$this->stepReduction = 8;
	}
	
	public function GetName() {
		return $this->name;
	}
	
	public function GetMazeTileCodeChar() {
		return $this->mazeTileCodeChar;
	}
	
	public function GetStepRedcution() {
		return $this->stepReduction;
	}
}
