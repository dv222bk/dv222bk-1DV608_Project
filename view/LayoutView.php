<?php

namespace view;

class LayoutView {
	
	public function Render(MazeView $mazeView, ControlsView $controlsView, $score, $stepsLeft) {
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
				      <div id="Maze">
				      	' . $mazeView->GetMazeHTML() . '
				      </div>
				      <div id="Sidebar">
				      	  <div id="scoreContainer">Score: <span id="score">' . $score . '</span></div>
					      <div id="stepsLeftContainer">Steps left: <span id="stepsLeft">' . $stepsLeft . '</span></div>
					      <h2>Controls</h2>
					      <div id="Controls">
					      	' . $controlsView->GetControlsHTML() . '
					      </div>
					      ' . $this->GetMessage($mazeView) . '
					      <h2>How to play</h2>
					      <p>You control a character in a maze. Your goal is to go the exit of the maze and enter the next maze.</p>
					      <p>The less steps you take to reach the exit, the more points you score</p>
					      <p>When you are out of steps, the game is over</p>
					      <p>Look out for hazards! They will consume extra steps!</p>
					      <h3>Symbol meanings</h3>
					      <ul>
					      	<li>C - Your character</li>
					      	<li>Q - Exit</li>
					      	<li>H - Spike hazard (Takes 3 steps)</li>
					      	<li>G - Goo hazard (Takes 5 steps)</li>
					      	<li>P - Pit hazard (Takes 8 steps)</li>
				      	  </ul>
				      </div>
			 	</main>
		     </body>
		  </html>
		';
	}
	
	private function GetMessage($mazeView) {
		if(is_string($mazeView->GetMessage())) {
			echo '<h3>Message</h3><span class="message">
				' . $mazeView->GetMessage() . '</span>';
				
		}
	}
}