<?php

namespace model\DAL;

class MazeDAL extends DAL {
	
	private static $filePath = "save_files/";
	private $mazeString;
	private $score;
	private $stepsAtStartOfMaze;
	private $stepsLeft;
	private $hasReadInformation = false;
	
	public function GetDatabaseContent($identificationString, $userAgent) {
		$mysqli = $this->GetMysqli();
		
		$mysqli->query("SET @UserAgent = '" . mysqli_real_escape_string($mysqli, $userAgent) . "'");
		$mysqli->query("SET @IDString = '" . mysqli_real_escape_string($mysqli, $identificationString) . "'");
		
		$result = $mysqli->query("CALL GetContentFromIdentification(@UserAgent, @IDString)");
		
		if($result->num_rows == 1) {
			
	    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	        $this->mazeString = $row["MazeString"];
			$this->score = $row["Score"];
	        $this->stepsLeft = $row["StepsLeft"];
			$this->stepsAtStartOfMaze = $row["StepsAtStartOfMaze"];
			
			$this->hasReadInformation = true;
			
			$mysqli->close();
		} else {
		    throw new \model\exceptions\IncorrectCookieInformationException();
		}
	}
	
	public function SaveContentToDatabase($identificationString, $userAgent, $mazeTileArray, $score, $stepsAtStartOfMaze, $stepsLeft) {
		$mysqli = $this->GetMysqli();
		
		$mysqli->query("SET @UserAgent = '" . mysqli_real_escape_string($mysqli, $userAgent) . "'");
		$mysqli->query("SET @IDString = '" . mysqli_real_escape_string($mysqli, $identificationString) . "'");
		$mysqli->query("SET @Score = '" . $score . "'");
		$mysqli->query("SET @StepsLeft = '" . $stepsLeft . "'");
		$mysqli->query("SET @StepsAtStartOfMaze = '" . $stepsAtStartOfMaze . "'");
		
		$mazeString = "";
		
		foreach($mazeTileArray as $mazeTileRow) {
			foreach($mazeTileRow as $mazeTile) {
				$mazeString .= $mazeTile->GetMazeTileCode() . PHP_EOL;
			}
		}
		
		$mysqli->query("SET @MazeString = '" . $mazeString . "'");
		
		$mysqli->query("CALL CreateUpdateContentFromIdentification(@UserAgent, @IDString, @MazeString, @Score, @StepsLeft, @StepsAtStartOfMaze)");
		
		$mysqli->close();
	}
	
	public function RemoveFromDatabase($identificationString, $userAgent) {
		$mysqli = $this->GetMySqli();
		
		$mysqli->query("SET @UserAgent = '" . mysqli_real_escape_string($mysqli, $userAgent) . "'");
		$mysqli->query("SET @IDString = '" . mysqli_real_escape_string($mysqli, $identificationString) . "'");
		
		$mysqli->query("CALL DeleteContentFromIdentification(@UserAgent, @IDString)");
		
		$mysqli->close();
	}
	
	public function GetMazeString() {
		if(isset($this->mazeString)) {
			return $this->mazeString;
		}
		return false;
	}
	
	public function GetScore() {
		if(isset($this->score)) {
			return $this->score;
		}
		return false;
	}
	
	public function GetStepsLeft() {
		if(isset($this->stepsLeft)) {
			return $this->stepsLeft;
		}
		return false;
	}
	
	public function GetStepsAtStartOfMaze() {
		if(isset($this->stepsAtStartOfMaze)) {
			return $this->stepsAtStartOfMaze;
		}
		return false;
	}
	
	public function HasReadInformation() {
		return $this->hasReadInformation;
	}
}
