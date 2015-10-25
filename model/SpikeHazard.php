<?php

namespace model;

class SpikeHazard implements iMazeHazard {
	
	private $name;
	private $mazeTileCodeChar;
	private $stepReduction;
	
	public function __construct() {
		$this->name = "Spike";
		$this->mazeTileCodeChar = "H";
		$this->stepReduction = 3;
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
