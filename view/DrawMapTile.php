<?php

namespace view;

class DrawMapTile {
	
	public function DrawMapTile(\model\MapTile $mapTile) {
		
		$drawnMapTile = '<div class="mapTile">';
		
		if($mapTile->GetVisibility()) {
			
			$drawnMapTile .= $this->DrawNorthPartOfTile($mapTile);
			$drawnMapTile .= $this->DrawCenterPartOfTile($mapTile);
			$drawnMapTile .= $this->DrawSouthPartOfTile($mapTile);
			
		}
		
		$drawnMapTile .= '</div>';
		
		return $drawnMapTile;
	}
	
	private function DrawNorthPartOfTile(\model\MapTile $mapTile) {
		
		$hasNorthExit = $mapTile->HasNorthExit();
		
		// row 1
		$drawnMapTile = '##';
		
		if($hasNorthExit) {
			$drawnMapTile .= '│ ' . $mapTile->GetNorthHazard() . ' │';
		} else {
			$drawnMapTile .= '#####';
		}

		// row 2
		$drawnMapTile .= '####';
		
		if($hasNorthExit) {
			$drawnMapTile .= '│   │';
		} else {
			$drawnMapTile .= '#####';
		}
		$drawnMapTile .= '##';
		
		return $drawnMapTile;
	}
	
	private function DrawCenterPartOfTile(\model\MapTile $mapTile) {
		
		$hasNorthExit = $mapTile->HasNorthExit();
		$hasEastExit = $mapTile->HasEastExit();
		$hasWestExit = $mapTile->HasWestExit();
		$hasSouthExit = $mapTile->HasSouthExit();

		function Row4And6($hasEastExit, $hasWestExit) {
			
			$drawnMapTile = '';
			
			if($hasWestExit) {
				$drawnMapTile .= '   ';
			} else {
				$drawnMapTile .= '##│';
			}
			
			$drawnMapTile .= '   ';
			
			if($hasEastExit) {
				$drawnMapTile .= '   ';
			} else {
				$drawnMapTile .= '│##';
			}
			return $drawnMapTile;
			
		}

		// row 3
		if($hasWestExit) {
			$drawnMapTile = '───';
			if($hasNorthExit) {
				$drawnMapTile .= ' ';
			} else {
				$drawnMapTile .= '─';
			}
		} else {
			$drawnMapTile = '##│';
		}
		
		if($hasNorthExit) {
			$drawnMapTile .= '   ';
		} else {
			$drawnMapTile .= '───';
		}
		
		if($hasEastExit) {
			$drawnMapTile .= '───';
		} else {
			$drawnMapTile .= '│##';
		}
		
		// row 4
		$drawnMapTile .= Row4And6($hasEastExit, $hasWestExit);
		
		// row 5
		if($hasWestExit) {
			$drawnMapTile .= $mapTile->GetWestHazard() . '  ';
		} else {
			$drawnMapTile .= '##│';
		}
		
		if($mapTile->HasCharacter()) {
			$drawnMapTile .= 'C ';
		} else {
			$drawnMapTile .= '  ';
		}
		
		if($mapTile->HasMapExit()) {
			$drawnMapTile .= 'Q';
		}
		
		if($hasEastExit) {
			$drawnMapTile .= '  ' . $mapTile->GetEastHazard();
		} else {
			$drawnMapTile .= '│##';
		}
		
		// row 6
		$drawnMapTile .= Row4And6($hasEastExit, $hasWestExit);
		
		// row 7
		if($hasWestExit) {
			$drawnMapTile = '───';
			if($hasNorthExit) {
				$drawnMapTile .= ' ';
			} else {
				$drawnMapTile .= '─';
			}
		} else {
			$drawnMapTile = '##│';
		}
		
		if($hasSouthExit) {
			$drawnMapTile .= '   ';
		} else {
			$drawnMapTile .= '───';
		}
		
		if($hasEastExit) {
			$drawnMapTile .= '───';
		} else {
			$drawnMapTile .= '│##';
		}
		
		return drawnMapTile;
	}

	private function DrawSouthPartOfTile(\model\MapTile $mapTile) {
		
		$hasSouthExit = $mapTile->HasSouthExit();
		
		// row 8
		$drawnMapTile = '##';
		
		if($hasSouthExit) {
			$drawnMapTile .= '│   │';
		} else {
			$drawnMapTile .= '#####';
		}
		
		// row 9
		$drawnMapTile .= '####';
		
		if($hasSouthExit) {
			$drawnMapTile .= '│ ' . $mapTile->GetSouthHazard() . ' │';
		} else {
			$drawnMapTile .= '#####';
		}
		
		$drawnMapTile .= '##';
		
		return $drawnMapTile;
	}
}
