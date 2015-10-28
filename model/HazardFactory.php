<?php

namespace model;

class HazardFactory {
	
	public function GetStandardHazards() {
		return [
			new SpikeHazard(),
			new GooHazard(),
			new PitHazard()			
		];
	}
}
