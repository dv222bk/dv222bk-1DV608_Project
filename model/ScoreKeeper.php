<?php

namespace model;

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
		$this->score += (self::$totalSteps - ($this->stepsAtStartOfMaze - $this->stepsLeft)) * 500;
		$this->stepsAtStartOfMaze = $this->stepsLeft;
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
