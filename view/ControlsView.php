<?php

namespace view;

class ControlsView {
	
	private static $northButton = 'ControlsView::NorthButton';
	private static $eastButton = 'ControlsView::EastButton';
	private static $southButton = 'ControlsView::SouthButton';
	private static $westButton = 'ControlsView::WestButton';
	private static $mazeExitButton = 'ControlsView::MazeExitButton';
	private static $restartButton = 'ControlsView::RestartButton';
	private $enableNorth = false;
	private $enableEast = false;
	private $enableWest = false;
	private $enableSouth = false;
	private $enableMazeExit = false;
	
	public function GetControlsHTML() {
		return '<form method="post" >
			<input type="submit" name="' . self::$northButton . '" value="&#8593;"' . ($this->enableNorth ? '' : ' Disabled') . ' />
			<input type="submit" name="' . self::$westButton . '" value="&#8592;"' . ($this->enableWest ? '' : ' Disabled') . ' />
			<input type="submit" name="' . self::$mazeExitButton . '" value="Next Maze"' . ($this->enableMazeExit ? '' : ' Disabled') . ' />
			<input type="submit" name="' . self::$eastButton . '" value="&#8594;"' . ($this->enableEast ? '' : ' Disabled') . ' />
			<input type="submit" name="' . self::$southButton . '" value="&#8595;"' . ($this->enableSouth ? '' : ' Disabled') . ' />
			<input type="submit" name="' . self::$restartButton . '" value="Restart game" />
			</form>';
	}
	
	public function EnableNorth() {
		$this->enableNorth = true;
	}
	
	public function EnableEast() {
		$this->enableEast = true;
	}
	
	public function EnableWest() {
		$this->enableWest = true;
	}
	
	public function EnableSouth() {
		$this->enableSouth = true;
	}
	
	public function EnableMazeExit() {
		$this->enableMazeExit = true;
	}
	
	public function NorthClicked() {
		return isset($_POST[self::$northButton]);
	}
	
	public function EastClicked() {
		return isset($_POST[self::$eastButton]);
	}
	
	public function SouthClicked() {
		return isset($_POST[self::$southButton]);
	}
	
	public function WestClicked() {
		return isset($_POST[self::$westButton]);
	}
	
	public function MazeExitClicked() {
		return isset($_POST[self::$mazeExitButton]);
	}
	
	public function RestartClicked() {
		return isset($_POST[self::$restartButton]);
	}
}
