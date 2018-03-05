<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleListNameConnector.php";
	
	$ModuleListNameConnector = new ModuleListNameConnector($conn);
	
	$response["lists"] = $ModuleListNameConnector->selectAll();
	$response["success"] = true;
	
	echo(json_encode($response));
?>
