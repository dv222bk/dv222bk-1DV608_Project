<?php

namespace model;

/*
 * Class: model/ScoreKeeper
 * 
 * Keeps track of the players score and the steps the character has left
 */

class ScoreKeeper {
	
	private $score = 0;
	private static $totalSteps = 500;
	private $stepsAtStartOfMaze;
	private $stepsLeft;
	
	public function __construct() {
		$this->stepsAtStartOfMaze = self::$totalSteps;
		$this->stepsLeft = self::$totalSteps;
	}
	
	public function AddScoreEndOfMaze() {
		$gainedScore = (self::$totalSteps - ($this->stepsAtStartOfMaze - $this->stepsLeft)) * self::$totalSteps;
		$this->score += $gainedScore;
		$this->stepsAtStartOfMaze = $this->stepsLeft;
		return $gainedScore;
	}
	
	public function SetScore($newScore) {
		assert(is_numeric($newScore));
		
		$this->score = $newScore;
	}
	
	public function SetStepsAtStartOfMaze($newStepsAtStartOfMaze) {
		assert(is_numeric($newStepsAtStartOfMaze));
		
		$this->stepsAtStartOfMaze = $newStepsAtStartOfMaze;
	}
	
	public function SetStepsLeft($newStepsLeft) {
		assert(is_numeric($newStepsLeft));
		
		$this->stepsLeft = $newStepsLeft;
	}
	
	public function DecreaseStepsLeft($decreaseAmount) {
		assert(is_numeric($decreaseAmount));
		
		$this->stepsLeft -= $decreaseAmount;
	}
	
	public function GetScore() {
		return $this->score;
	}
	
	public function GetStepsAtStartOfMaze() {
		return $this->stepsAtStartOfMaze;
	}
	
	public function GetStepsLeft() {
		return $this->stepsLeft;
	}
}
