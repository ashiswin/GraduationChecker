<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleConnector.php";
	
	$ModuleConnector = new ModuleConnector($conn);
	
	$response["modules"] = $ModuleConnector->selectAll();
	$response["success"] = true;
	
	echo(json_encode($response));
?>
