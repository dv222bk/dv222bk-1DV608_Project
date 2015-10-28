<?php

namespace model;

/*
 * Interface: model/iMazeHazard
 * 
 * Interface for maze hazards. All mazehazards must use iMazeHazard interface.
 */

interface iMazeHazard {
		
	public function __construct();
	
	public function GetName();
	
	public function GetMazeTileCodeChar();
	
	public function GetStepRedcution();
}
