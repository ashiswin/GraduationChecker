<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleListItemsConnector.php";
	
	$listId = intval($_GET['listId']);
	
	$ModuleListItemsConnector = new ModuleListItemsConnector($conn);
	
	$response["modules"] = $ModuleListItemsConnector->selectAll($listId);
	$response["success"] = true;
	
	echo(json_encode($response));
?>
