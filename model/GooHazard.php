<?php

namespace model;

class GooHazard implements iMazeHazard {
	
	private $name;
	private $mazeTileCodeChar;
	private $stepReduction;
	
	public function __construct() {
		$this->name = "Goo";
		$this->mazeTileCodeChar = "G";
		$this->stepReduction = 5;
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
