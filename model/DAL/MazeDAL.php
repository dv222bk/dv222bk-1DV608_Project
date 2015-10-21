<?php

namespace model\DAL;

class MazeDAL {
	
	private static $filePath = "save_files/";
	private $mazeTileCodeArray;
	private $score;
	private $steps;
	
	public function ReadFromFile($fileName) {
		if(file_exists(self::$filePath . $fileName)) {
			$fileContents = rtrim(file_get_contents(self::$filePath . $fileName));
			
			$fileArray = explode(PHP_EOL, $fileContents);
			
			$this->score = $fileArray[0];
			array_shift($fileArray);
			$this->steps = $fileArray[0];
			array_shift($fileArray);
			
			$this->mazeTileCodeArray = $this->CreateMazeTileCodeArrayFromArray($fileArray);
		} else {
			throw new \model\exceptions\FileDoesNotExistException();
		}
	}
	
	public function SaveToFile($mazeTileArray, $score, $steps, $maxY, $maxX, $fileName) {
		$file = fopen(self::$filePath . $fileName, "w");
		
		fwrite($file, $score . PHP_EOL . $steps . PHP_EOL . $maxY . PHP_EOL . $maxX . PHP_EOL);
		
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
		return $this->mazeTileCodeArray;
	}
	
	public function GetScore() {
		return $this->$score;
	}
	
	public function GetSteps() {
		return $this->steps;
	}
	
	private function CreateMazeTileCodeArrayFromArray($codeArray) {
		$maxY = $codeArray[0];
		array_shift($codeArray);
		$maxX = $codeArray[0];
		array_shift($codeArray);
		
		$mazeTileArray = array(array());
		$arrayPos = 0;
		for($y = 0; $y < $maxY; $y += 1) {
			for($x = 0; $x < $maxX; $x += 1) {
				$mazeTileArray[$y][$x] = $codeArray[$arrayPos];
				$arrayPos += 1; 
			}
		}
		
		return $mazeTileArray;
	}
}
