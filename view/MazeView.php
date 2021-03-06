<?php

namespace view;

/*
 * Class: view/MazeView
 * 
 * Handles all visual aspects concerning a maze
 * Also handles cookies related to identifying a maze owner
 */

class MazeView {
	
	private static $identification = 'MazeView::Identification';
	private $mazeTileArray = array(array());
	private $messages = '';
	
	public function SaveMazeTileArray($array) {
		assert(is_array($array));
		
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
		} else if(isset($_SESSION[self::$identification])) {
			return $_SESSION[self::$identification];
		}
		return false;
	}
	
	public function SetIdentification($identification) {
		assert(is_string($identification));
		
		setcookie(self::$identification, $identification, time()+60*60*24*30);
		$_SESSION[self::$identification] = $identification;
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
				$this->messages .= '<span class="message">Your cookie contains invalid information!</span>';
				break;
			case 'model\exceptions\DatabaseException' :
				$this->messages .= '<span class="message">Somekind of database related error occured!</span>';
				break;
			default :
				$this->messages .= '<span class="message">An unknown error occured!</span>';
				break;
		}
	}
	
	public function SaveGameOverMessage($score) {
		assert(is_numeric($score));
		
		$this->messages .= '<span class="message">Game Over! Final score: ' . $score . '</span>';
	}
	
	public function GetMessages() {
		return $this->messages;
	}
	
	public function GetUserAgent() {
		return $_SERVER["HTTP_USER_AGENT"];
	}
}
