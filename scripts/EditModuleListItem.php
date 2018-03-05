<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleListItemsConnector.php";
	
	$id = intval($_POST['id']);
	$moduleCode = trim($_POST['moduleCode']);
	$moduleName = trim($_POST['moduleName']);
	$requiredGrades = trim($_POST['requiredGrades']);
	
	$ModuleListItemsConnector = new ModuleListItemsConnector($conn);
	
	$response["success"] = $ModuleListItemsConnector->update($moduleCode, $moduleName, $requiredGrades, $id);
	
	echo(json_encode($response));
?>
