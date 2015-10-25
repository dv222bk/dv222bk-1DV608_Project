<?php

namespace view;

class MazeView {
	
	private static $identification = 'MazeView::Identification';
	private $mazeTileArray = array(array());
	private $messages = '';
	
	public function SaveMazeTileArray($array) {
		$this->mazeTileArray = $array;
	}
	
	public function GetMazeHTML() {
		$drawMazeTile = new DrawMazeTile();	
		$maze = '';
		
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
	
	public function SaveExceptionMessage(\Exception $exception) {
		$exceptionClass = get_class($exception);
		switch ($exceptionClass) {
			case 'model\exceptions\CantMoveInDirectionException' :
				$this->messages .= '<span class="message">You cannot move in that direction!</span>';
				break;
			case 'model\exceptions\IncorrectCookieInformationException' :
				$this->messages .= '<span class="message">Your cookie contains invalid information</span>';
				break;
		}
	}
	
	public function SaveGameOverMessage($score) {
		$this->messages .= '<span class="message">Game Over! Final score: ' . $score . '</span>';
	}
	
	public function GetMessages() {
		return $this->messages;
	}
}
