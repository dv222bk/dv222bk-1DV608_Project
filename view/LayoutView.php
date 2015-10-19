<?php

namespace view;

class LayoutView {
	
	public function Render(MapView $mapView, ControlsView $controlsView, $stepsLeft) {
		echo '<!DOCTYPE html>
		  <html>
		      <head>
		    	<meta charset="utf-8">
		    	<link rel="stylesheet" type="text/css" href="css/site.css" />
		    	<title>PHP Maze</title>
		      </head>
		      <body>
			      <main>
				      <h1>PHP Maze</h1>
				      <h2>Map</h2>
				      <div id="Map">
				      	' . $mapView->GetMapHTML() . '
				      </div>
				      <div id="Sidebar">
					      <h2>Controls</h2>
					      <div id="Controls">
					      	' . $controlsView->GetControlsHTML() . '
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
			echo '<h3>Message</h3><span class="message">
				' . $_SESSION['message'] . '</span>';
				
			unset($_SESSION['message']);
		}
	}
}