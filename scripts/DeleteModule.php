<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleListItemsConnector.php";
	
	$id = intval($_POST['id']);
	
	$ModuleListItemsConnector = new ModuleListItemsConnector($conn);
	
	$response["success"] = $ModuleListItemsConnector->delete($id);
	
	echo(json_encode($response));
?>
