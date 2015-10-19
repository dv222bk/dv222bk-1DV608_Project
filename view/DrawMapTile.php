<?php

namespace view;

class DrawMapTile {
	
	public function DrawMapTile(\model\MapTile $mapTile) {
		
		if($mapTile->HasCharacter()) {
			$drawnMapTile = '<div class="mapTileCurrent">';
		} else {
			$drawnMapTile = '<div class="mapTile">';
		}
		
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
			$drawnMapTile .= '│&nbsp;<span class="mapHazard">' . $mapTile->GetNorthHazard() . '</span>&nbsp;│';
		} else {
			$drawnMapTile .= '#####';
		}

		// row 2
		$drawnMapTile .= '####';
		
		if($hasNorthExit) {
			$drawnMapTile .= '│&nbsp;&nbsp;&nbsp;│';
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

		// row 3
		if($hasWestExit) {
			$drawnMapTile = '───';
		} else {
			$drawnMapTile = '##│';
		}
		
		if($hasNorthExit) {
			$drawnMapTile .= '&nbsp;&nbsp;&nbsp;';
		} else {
			$drawnMapTile .= '───';
		}
		
		if($hasEastExit) {
			$drawnMapTile .= '───';
		} else {
			$drawnMapTile .= '│##';
		}
		
		// row 4
		if($hasWestExit) {
			$drawnMapTile .= '<span class="mapHazard">' . $mapTile->GetWestHazard() . '</span>&nbsp;&nbsp;';
		} else {
			$drawnMapTile .= '##│';
		}
		
		if($mapTile->HasCharacter()) {
			$drawnMapTile .= '<span class="mapCharacter">C</span>&nbsp;';
		} else {
			$drawnMapTile .= '&nbsp;&nbsp;';
		}
		
		if($mapTile->HasMapExit()) {
			$drawnMapTile .= '<span class="mapExit">Q</span>';
		} else {
			$drawnMapTile .= '&nbsp;';
		}
		
		if($hasEastExit) {
			$drawnMapTile .= '&nbsp;&nbsp;<span class="mapHazard">' . $mapTile->GetEastHazard() . '</span>';
		} else {
			$drawnMapTile .= '│##';
		}
		
		// row 5
		if($hasWestExit) {
			$drawnMapTile .= '───';
		} else {
			$drawnMapTile .= '##│';
		}
		
		if($hasSouthExit) {
			$drawnMapTile .= '&nbsp;&nbsp;&nbsp;';
		} else {
			$drawnMapTile .= '───';
		}
		
		if($hasEastExit) {
			$drawnMapTile .= '───';
		} else {
			$drawnMapTile .= '│##';
		}
		
		return $drawnMapTile;
	}

	private function DrawSouthPartOfTile(\model\MapTile $mapTile) {
		
		$hasSouthExit = $mapTile->HasSouthExit();
		
		// row 6
		$drawnMapTile = '##';
		
		if($hasSouthExit) {
			$drawnMapTile .= '│&nbsp;&nbsp;&nbsp;│';
		} else {
			$drawnMapTile .= '#####';
		}
		
		// row 7
		$drawnMapTile .= '####';
		
		if($hasSouthExit) {
			$drawnMapTile .= '│&nbsp;<span class="mapHazard">' . $mapTile->GetSouthHazard() . '</span>&nbsp;│';
		} else {
			$drawnMapTile .= '#####';
		}
		
		$drawnMapTile .= '##';
		
		return $drawnMapTile;
	}
}
