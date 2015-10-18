<?php
    require_once('model/Map.php');
	require_once('model/MapTile.php');
	require_once('model/MapHazard.php');
	
	require_once('model/DAL/MapDAL.php');

	require_once('model/exceptions/CantMoveInDirectionException.php');
	require_once('model/exceptions/DatabaseException.php');
	require_once('model/exceptions/IncorrectCookieInformationException.php');
	require_once('model/exceptions/OutOfMovesException.php');

	require_once('controller/Controls.php');
	require_once('controller/MapController.php');
	
	require_once('view/LayoutView.php');
	require_once('view/MapView.php');
	require_once('view/ControlsView.php');
	
	$mapDAL = new \model\DAL\MapDAL();
	$map = new \model\Map($mapDAL);
	$layoutView = new \view\LayoutView();
	$mapView = new \view\MapView();
	$controlsView = new \view\ControlsView();
	$controls = new \controller\Controls($controlsView);
	$mapController = new \controller\MapController($map, $mapView);