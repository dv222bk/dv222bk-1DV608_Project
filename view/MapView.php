<?php

namespace view;

class MapView {
	
	private function DrawMapTile(\model\MapTile $mapTile) {
		
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
		
		function row3and5 ($hasNorthExit, $hasEastExit, $hasWestExit) {
			if($hasWestExit) {
			$drawnMapTile = '───';
				if($hasNorthExit) {
					$drawnMapTile .= ' ';
				} else {
					$drawnMapTile .= '─';
				}
			} else {
				$drawnMapTile = '###│';
			}
			
			if($hasNorthExit) {
				$drawnMapTile .= '───';
			} else {
				$drawnMapTile .= '   ';
			}
			
			if($hasEastExit) {
				$drawnMapTile .= '───';
			} else {
				$drawnMapTile .= '│###';
			}
			
			return $drawnMapTile;
		}
		// row 3
		$drawnMapTile = row3and5($hasNorthExit, $hasEastExit, $hasWestExit);
		
		// row 4
		if($hasWestExit) {
			$drawnMapTile .= $mapTile->GetWestHazard() . '  ';
		} else {
			$drawnMapTile .= '###│';
		}
		
		if($mapTile->HasCharacter()) {
			$drawnMapTile .= ' C ';
		} else {
			$drawnMapTile .= '   ';
		}
		
		if($hasEastExit) {
			$drawnMapTile .= '  ' . $mapTile->GetEastHazard();
		} else {
			$drawnMapTile .= '│###';
		}
		
		// row 5
		$drawnMapTile = row3and5($hasNorthExit, $hasEastExit, $hasWestExit);
		
		return drawnMapTile;
	}
}
