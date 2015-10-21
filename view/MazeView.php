<?php

namespace view;

class MazeView {
	
	private static $identification = "MazeView::Identification";
	private $mazeTileArray = array(array());
	private $message;
	
	public function SaveMazeTileArray($array) {
		$this->mazeTileArray = $array;
	}
	
	public function GetMazeHTML() {
		$drawMazeTile = new DrawMazeTile();	
		$maze = "";
		
		foreach($this->mazeTileArray as $tileRow) {
			foreach($tileRow as $mazeTile) {
				$maze .= $drawMazeTile->DrawMazeTile($mazeTile);
			}
		}
		
		return $maze;
	}
	
	public function GetIdentification() {
		if(isset($_COOKIE[self::$identification])) {
			return $_COOKIE[self::$identification];
		}
	}
	
	public function SetIdentification($identification) {
		setcookie(self::$identification, $identification, time()+60*60*24*30);
	}
	
	public function RemoveIdentification() {
		unset($_COOKIE[self::$identification]);
	}
	
	public function SaveErrorMessage($exception) {
		
	}
	
	public function GetMessage() {
		return $this->message;
	}
}
