<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleListItemsConnector.php";
	
	$listId = intval($_POST['listId']);
	$moduleCode = trim($_POST['moduleCode']);
	$moduleName = trim($_POST['moduleName']);
	$requiredGrades = trim($_POST['requiredGrades']);
	
	$ModuleListItemsConnector = new ModuleListItemsConnector($conn);
	
	$response["moduleId"] = $ModuleListItemsConnector->create($listId, $moduleCode, $moduleName, $requiredGrades);
	$response["success"] = true;
	
	echo(json_encode($response));
?>
