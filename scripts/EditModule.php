<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleConnector.php";
	
	$id = $_POST['id'];
	$moduleCode = trim($_POST['moduleCode']);
	$moduleName = trim($_POST['moduleName']);
	$requiredGrades = trim($_POST['requiredGrades']);
	
	$ModuleConnector = new ModuleConnector($conn);
	
	$response["success"] = $ModuleConnector->update($moduleCode, $moduleName, $requiredGrades, $id);
	
	echo(json_encode($response));
?>
