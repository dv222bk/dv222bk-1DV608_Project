<?php

namespace model\DAL;

class MapDAL {
	
	public function GetMapTileCodeArray() {
		$array = array();
		
		for($i = 0; $i < 96; $i += 1) {
			$array[$i] = "NHEPSGW";
			
			if($i == 72) {
				$array[$i] = "NHEPSGWQ";
			}
			
			if($i == 50) {
				$array[$i] = "CNHEPSGW";
			}
		}
		
		return $array;
	}
	
}
