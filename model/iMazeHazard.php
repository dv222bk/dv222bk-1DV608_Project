<?php

namespace model;

interface iMazeHazard {
		
	public function __construct();
	
	public function GetName();
	
	public function GetMazeTileCodeChar();
	
	public function GetStepRedcution();
}
