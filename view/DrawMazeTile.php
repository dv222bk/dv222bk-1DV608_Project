<?php

namespace view;

class DrawMazeTile {
	
	public function DrawMazeTile(\model\MazeTile $mazeTile) {
		
		if($mazeTile->HasCharacter()) {
			$drawnMazeTile = '<div class="mazeTileCurrent">';
		} else {
			$drawnMazeTile = '<div class="mazeTile">';
		}
		
		if($mazeTile->GetVisibility()) {
			
			$drawnMazeTile .= $this->DrawNorthPartOfTile($mazeTile);
			$drawnMazeTile .= $this->DrawCenterPartOfTile($mazeTile);
			$drawnMazeTile .= $this->DrawSouthPartOfTile($mazeTile);
			
		}
		
		$drawnMazeTile .= '</div>';
		
		return $drawnMazeTile;
	}
	
	private function DrawNorthPartOfTile(\model\MazeTile $mazeTile) {
		
		$hasNorthExit = $mazeTile->HasNorthExit();
		
		// row 1
		$drawnMazeTile = '##';
		
		if($hasNorthExit) {
			$drawnMazeTile .= '│&nbsp;<span class="mazeHazard">' . $mazeTile->GetNorthHazard() . '</span>&nbsp;│';
		} else {
			$drawnMazeTile .= '#####';
		}

		// row 2
		$drawnMazeTile .= '####';
		
		if($hasNorthExit) {
			$drawnMazeTile .= '│&nbsp;&nbsp;&nbsp;│';
		} else {
			$drawnMazeTile .= '#####';
		}
		$drawnMazeTile .= '##';
		
		return $drawnMazeTile;
	}
	
	private function DrawCenterPartOfTile(\model\MazeTile $mazeTile) {
		
		$hasNorthExit = $mazeTile->HasNorthExit();
		$hasEastExit = $mazeTile->HasEastExit();
		$hasWestExit = $mazeTile->HasWestExit();
		$hasSouthExit = $mazeTile->HasSouthExit();

		// row 3
		if($hasWestExit) {
			$drawnMazeTile = '───';
		} else {
			$drawnMazeTile = '##│';
		}
		
		if($hasNorthExit) {
			$drawnMazeTile .= '&nbsp;&nbsp;&nbsp;';
		} else {
			$drawnMazeTile .= '───';
		}
		
		if($hasEastExit) {
			$drawnMazeTile .= '───';
		} else {
			$drawnMazeTile .= '│##';
		}
		
		// row 4
		if($hasWestExit) {
			$drawnMazeTile .= '<span class="mazeHazard">' . $mazeTile->GetWestHazard() . '</span>&nbsp;&nbsp;';
		} else {
			$drawnMazeTile .= '##│';
		}
		
		if($mazeTile->HasCharacter()) {
			$drawnMazeTile .= '<span class="mazeCharacter">C</span>&nbsp;';
		} else {
			$drawnMazeTile .= '&nbsp;&nbsp;';
		}
		
		if($mazeTile->HasMazeExit()) {
			$drawnMazeTile .= '<span class="mazeExit">Q</span>';
		} else {
			$drawnMazeTile .= '&nbsp;';
		}
		
		if($hasEastExit) {
			$drawnMazeTile .= '&nbsp;&nbsp;<span class="mazeHazard">' . $mazeTile->GetEastHazard() . '</span>';
		} else {
			$drawnMazeTile .= '│##';
		}
		
		// row 5
		if($hasWestExit) {
			$drawnMazeTile .= '───';
		} else {
			$drawnMazeTile .= '##│';
		}
		
		if($hasSouthExit) {
			$drawnMazeTile .= '&nbsp;&nbsp;&nbsp;';
		} else {
			$drawnMazeTile .= '───';
		}
		
		if($hasEastExit) {
			$drawnMazeTile .= '───';
		} else {
			$drawnMazeTile .= '│##';
		}
		
		return $drawnMazeTile;
	}

	private function DrawSouthPartOfTile(\model\MazeTile $mazeTile) {
		
		$hasSouthExit = $mazeTile->HasSouthExit();
		
		// row 6
		$drawnMazeTile = '##';
		
		if($hasSouthExit) {
			$drawnMazeTile .= '│&nbsp;&nbsp;&nbsp;│';
		} else {
			$drawnMazeTile .= '#####';
		}
		
		// row 7
		$drawnMazeTile .= '####';
		
		if($hasSouthExit) {
			$drawnMazeTile .= '│&nbsp;<span class="mazeHazard">' . $mazeTile->GetSouthHazard() . '</span>&nbsp;│';
		} else {
			$drawnMazeTile .= '#####';
		}
		
		$drawnMazeTile .= '##';
		
		return $drawnMazeTile;
	}
}
