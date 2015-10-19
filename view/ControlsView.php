<?php

namespace view;

class ControlsView {
	
	private static $northButton = 'ControlsView::NorthButton';
	private static $eastButton = 'ControlsView::EastButton';
	private static $southButton = 'ControlsView::SouthButton';
	private static $westButton = 'ControlsView::WestButton';
	private static $mapExitButton = 'ControlsView::MapExitButton';
	private static $restartButton = 'ControlsView::RestartButton';
	private $enableNorth = false;
	private $enableEast = false;
	private $enableWest = false;
	private $enableSouth = false;
	private $enableMapExit = false;
	
	public function GetControlsHTML() {
		return '<input type="submit" name="' . self::$northButton . '" value="&#8593;"' . ($this->enableNorth ? '' : 'Disabled') . ' />
			<input type="submit" name="' . self::$westButton . '" value="&#8592;"' . ($this->enableWest ? '' : 'Disabled') . ' />
			<input type="submit" name="' . self::$mapExitButton . '" value="Go down"' . ($this->enableMapExit ? '' : 'Disabled') . ' />
			<input type="submit" name="' . self::$eastButton . '" value="&#8594;"' . ($this->enableEast ? '' : 'Disabled') . ' />
			<input type="submit" name="' . self::$southButton . '" value="&#8595;"' . ($this->enableSouth ? '' : 'Disabled') . ' />
			<input type="submit" name="' . self::$restartButton . '" value="Restart game" />';
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
	
	public function EnableMapExit() {
		$this->enableMapExit = true;
	}
	
}
