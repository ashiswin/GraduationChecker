<?php
	require_once "utils/database.php";
	require_once "connectors/TrackConnector.php";
	require_once "connectors/TrackCoreConnector.php";
	require_once "connectors/TrackElectiveConnector.php";
	
	$TrackConnector = new TrackConnector($conn);
	$TrackCoreConnector = new TrackCoreConnector($conn);
	$TrackElectiveConnector = new TrackElectiveConnector($conn);
	
	$response["track"] = $TrackConnector->select($_GET['id']);
	$response["cores"] = $TrackCoreConnector->select($_GET['id']);
	$response["electives"] = $TrackElectiveConnector->select($_GET['id']);
	$response["success"] = true;
	
	echo(json_encode($response));
?>
