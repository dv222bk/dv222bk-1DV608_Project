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
			if($northHazard = $mazeTile->GetHazard("N")) {
				$drawnMazeTile .= '│&nbsp;<span class="mazeHazard">' . $northHazard->GetMazeTileCodeChar() . '</span>&nbsp;│';
			} else {
				$drawnMazeTile .= '│&nbsp;&nbsp;&nbsp;│';
			}
		} else {
			$drawnMazeTile .= '#####';
		}

		// row 2
		$drawnMazeTile .= '####';
		$drawnMazeTile .= ($hasNorthExit) ? '│&nbsp;&nbsp;&nbsp;│' : '#####';
		$drawnMazeTile .= '##';
		
		return $drawnMazeTile;
	}
	
	private function DrawCenterPartOfTile(\model\MazeTile $mazeTile) {
		
		$hasNorthExit = $mazeTile->HasNorthExit();
		$hasEastExit = $mazeTile->HasEastExit();
		$hasWestExit = $mazeTile->HasWestExit();
		$hasSouthExit = $mazeTile->HasSouthExit();

		// row 3
		$drawnMazeTile = ($hasWestExit) ? '───' : '##│';
		$drawnMazeTile .= ($hasNorthExit) ? '&nbsp;&nbsp;&nbsp;' : '───';
		$drawnMazeTile .= ($hasEastExit) ? '───' : '│##';
		
		// row 4
		if($hasWestExit) {
			if($westHazard = $mazeTile->GetHazard("W")) {
				$drawnMazeTile .= '<span class="mazeHazard">' . $westHazard->GetMazeTileCodeChar() . '</span>&nbsp;&nbsp;';
			} else {
				$drawnMazeTile .= '&nbsp;&nbsp;&nbsp;';
			}
			
		} else {
			$drawnMazeTile .= '##│';
		}
		
		$drawnMazeTile .= ($mazeTile->HasCharacter()) ? '<span class="mazeCharacter">C</span>&nbsp;' : '&nbsp;&nbsp;';
		$drawnMazeTile .= ($mazeTile->HasMazeExit()) ? '<span class="mazeExit">Q</span>' : '&nbsp;';
		
		if($hasEastExit) {
			if($eastHazard = $mazeTile->GetHazard("E")) {
				$drawnMazeTile .= '&nbsp;&nbsp;<span class="mazeHazard">' . $eastHazard->GetMazeTileCodeChar() . '</span>';
			} else {
				$drawnMazeTile .= '&nbsp;&nbsp;&nbsp;';
			}
		} else {
			$drawnMazeTile .= '│##';
		}
		
		// row 5
		$drawnMazeTile .= ($hasWestExit) ? '───' : '##│';
		$drawnMazeTile .= ($hasSouthExit) ? '&nbsp;&nbsp;&nbsp;' : '───';
		$drawnMazeTile .= ($hasEastExit) ? '───' : '│##';

		return $drawnMazeTile;
	}

	private function DrawSouthPartOfTile(\model\MazeTile $mazeTile) {
		
		$hasSouthExit = $mazeTile->HasSouthExit();
		
		// row 6
		$drawnMazeTile = '##';
		$drawnMazeTile .= ($hasSouthExit) ? '│&nbsp;&nbsp;&nbsp;│' : '#####';
		
		// row 7
		$drawnMazeTile .= '####';
		
		if($hasSouthExit) {
			if($southHazard = $mazeTile->GetHazard("S")) {
				$drawnMazeTile .= '│&nbsp;<span class="mazeHazard">' . $southHazard->GetMazeTileCodeChar() . '</span>&nbsp;│';
			} else {
				$drawnMazeTile .= '│&nbsp;&nbsp;&nbsp;│';
			}
		} else {
			$drawnMazeTile .= '#####';
		}
		
		$drawnMazeTile .= '##';
		
		return $drawnMazeTile;
	}
}
