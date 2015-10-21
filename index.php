<?php
    require_once('model/Maze.php');
	require_once('model/MazeTile.php');
	require_once('model/MazeHazard.php');
	
	require_once('model/DAL/MazeDAL.php');

	require_once('model/exceptions/CantMoveInDirectionException.php');
	require_once('model/exceptions/FileDoesNotExistException.php');
	require_once('model/exceptions/IncorrectCookieInformationException.php');
	require_once('model/exceptions/OutOfMovesException.php');

	require_once('controller/Controls.php');
	require_once('controller/MazeController.php');
	
	require_once('view/LayoutView.php');
	require_once('view/MazeView.php');
	require_once('view/ControlsView.php');
	require_once('view/DrawMazeTile.php');
	
	$mazeDAL = new \model\DAL\MazeDAL();
	$maze = new \model\Maze($mazeDAL);
	$layoutView = new \view\LayoutView();
	$mazeView = new \view\MazeView();
	$controlsView = new \view\ControlsView();
	$controls = new \controller\Controls($maze, $controlsView);
	$mazeController = new \controller\MazeController($maze, $mazeDAL, $mazeView);
	
	$mazeController->InitMaze();
	$mazeController->SaveMaze();
	$controls->EnableButtons();
	$layoutView->Render($mazeView, $controlsView, $maze->GetScore(), $maze->GetSteps());
