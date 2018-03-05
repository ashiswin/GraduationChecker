<?php
	require_once "utils/database.php";
	require_once "connectors/TrackConnector.php";
	
	$TrackConnector = new TrackConnector($conn);
	
	$response["tracks"] = $TrackConnector->selectByPillar($_GET['pillar']);
	$response["success"] = true;
	
	echo(json_encode($response));
?>
