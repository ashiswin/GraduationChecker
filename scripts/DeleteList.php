<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleListNameConnector.php";
	require_once "connectors/ModuleListItemsConnector.php";
	
	$listId = intval($_POST['listId']);
	
	$ModuleListNameConnector = new ModuleListNameConnector($conn);
	$ModuleListItemsConnector = new ModuleListItemsConnector($conn);
	
	$response["success"] = $ModuleListNameConnector->delete($listId) && $ModuleListItemsConnector->deleteList($listId);
	
	echo(json_encode($response));
?>
