<?php
	require_once "utils/database.php";
	require_once "connectors/TrackConnector.php";
	
	$name = $_POST['name'];
	$pillar = $_POST['pillar'];
	
	$TrackConnector = new TrackConnector($conn);
	
	$TrackConnector->create($name, $pillar);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>
