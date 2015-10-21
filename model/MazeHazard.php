<?php

namespace model;

class MazeHazard {
	
	const Spike = "H";
	const Goo = "G";
	const Pit = "P";
	
	public function GetSpike() {
		return self::Spike;
	}
	
	public function GetGoo() {
		return self::Goo;
	}
	
	public function GetPit() {
		return self::Pit;
	}
}
