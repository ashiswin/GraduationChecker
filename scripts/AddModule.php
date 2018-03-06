<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleConnector.php";
	
	$moduleCode = trim($_POST['moduleCode']);
	$moduleName = trim($_POST['moduleName']);
	$requiredGrades = trim($_POST['requiredGrades']);
	
	$ModuleConnector = new ModuleConnector($conn);
	
	$ModuleConnector->create($moduleCode, $moduleName, $requiredGrades);
	$response["success"] = true;
	
	echo(json_encode($response));
?>
