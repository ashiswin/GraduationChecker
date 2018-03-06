<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleConnector.php";
	
	$id = intval($_POST['id']);
	
	$ModuleConnector = new ModuleConnector($conn);
	
	$response["success"] = $ModuleConnector->delete($id);
	
	echo(json_encode($response));
?>
