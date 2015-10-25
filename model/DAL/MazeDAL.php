<?php

namespace model\DAL;

class MazeDAL {
	
	private static $filePath = "save_files/";
	private $mazeTileCodeArray;
	private $score;
	private $stepsAtStartOfMaze;
	private $stepsLeft;
	private $hasReadInformation = false;
	
	public function ReadFromFile($fileName) {
		if(file_exists(self::$filePath . $fileName)) {
			$fileContents = rtrim(file_get_contents(self::$filePath . $fileName));
			
			$fileArray = explode(PHP_EOL, $fileContents);
			
			$this->score = $fileArray[0];
			array_shift($fileArray);
			$this->stepsAtStartOfMaze = $fileArray[0];
			array_shift($fileArray);
			$this->stepsLeft = $fileArray[0];
			array_shift($fileArray);
			
			$this->mazeTileCodeArray = $fileArray;
			$this->hasReadInformation = true;
		} else {
			throw new \model\exceptions\IncorrectCookieInformationException();
		}
	}
	
	public function SaveToFile($mazeTileArray, $score, $stepsAtStartOfMaze, $stepsLeft, $fileName) {
		$file = fopen(self::$filePath . $fileName, "w");
		
		fwrite($file, $score . PHP_EOL . $stepsAtStartOfMaze . PHP_EOL . $stepsLeft . PHP_EOL);
		
		foreach($mazeTileArray as $mazeTileRow) {
			foreach($mazeTileRow as $mazeTile) {
				fwrite($file, $mazeTile->GetMazeTileCode() . PHP_EOL);
			}
		}
		fclose($file);
	}
	
	public function RemoveFile($fileName) {
		if(file_exists(self::$filePath . $fileName)) {
			unlink(self::$filePath . $fileName);
		} else {
			throw new \model\exceptions\FileDoesNotExistException();
		}
	}
	
	public function GetHighestFileNumber() {
		$files = glob(self::$filePath . "*");
		sort($files);
		$highestNumber = filter_var(array_pop($files), FILTER_SANITIZE_NUMBER_INT);
		if($highestNumber == "" || $highestNumber == NULL) {
			return 0;
		} else {
			return $highestNumber;
		}
	}
	
	public function GetMazeTileCodeArray() {
		if(isset($this->mazeTileCodeArray)) {
			return $this->mazeTileCodeArray;
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
