<?php
    require_once('model/Maze.php');
	require_once('model/MazeTile.php');
	require_once('model/ScoreKeeper.php');
	
	require_once('model/iMazeHazard.php');
	require_once('model/PitHazard.php');
	require_once('model/SpikeHazard.php');
	require_once('model/GooHazard.php');
	
	require_once('model/DAL/DAL.php');
	require_once('model/DAL/MazeDAL.php');

	require_once('model/exceptions/CantMoveInDirectionException.php');
	require_once('model/exceptions/IncorrectCookieInformationException.php');
	require_once('model/exceptions/DatabaseException.php');

	require_once('controller/Controls.php');
	require_once('controller/MazeController.php');
	require_once('controller/MasterController.php');
	
	require_once('view/LayoutView.php');
	require_once('view/MazeView.php');
	require_once('view/ControlsView.php');
	require_once('view/DrawMazeTile.php');
	
	$masterController = new \controller\MasterController();
	$masterController->PlayGame();