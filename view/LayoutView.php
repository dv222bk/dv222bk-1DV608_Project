<?php

namespace view;

class LayoutView {
	
	public function Render(MapView $mapView, ControlsView $controlsView, $stepsLeft) {
		echo '<!DOCTYPE html>
		  <html>
		      <head>
		    	<meta charset="utf-8">
		    	<title>PHP Maze</title>
		      </head>
		      <body>
			      <main>
				      <h1>PHP Maze</h1>
				      <h2>Map</h2>
				      <div id="Map">
				      	' . $mapView->getMap() . '
				      </div>
				      <div id="Sidebar">
					      <h2>Controls</h2>
					      <div id="Controls">
					      	' . $controlsView->getControls() . '
					      </div>
					      <h3>Steps left</h3>
					      ' . $stepsLeft . '
					      ' . $this->GetMessage() . '
				      </div>
			 	</main>
		     </body>
		  </html>
		';
	}
	
	private function GetMessage() {
		if(isset($_SESSION['message'])) {
			echo '<h3>Message</h3>
				' . $_SESSION['message'];
				
			unset($_SESSION['message']);
		}
	}
}