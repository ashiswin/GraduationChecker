<?php
	require_once "utils/database.php";
	require_once "connectors/TrackConnector.php";
	
	$TrackConnector = new TrackConnector($conn);
	
	$response["track"] = $TrackConnector->select($_GET['id']);
	$response["success"] = true;
	
	echo(json_encode($response));
?>
