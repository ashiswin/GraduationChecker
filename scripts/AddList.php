<?php
	require_once "utils/database.php";
	require_once "connectors/ModuleListNameConnector.php";
	
	$name = trim($_POST['name']);
	
	if(strcmp($name, "") == 0) {
		$response["success"] = false;
		$response["message"] = "Please provide a name";
		
		echo(json_encode($response));
		return;
	}
	
	$ModuleListNameConnector = new ModuleListNameConnector($conn);
	
	$response["listId"] = $ModuleListNameConnector->create($name);
	$response["success"] = true;
	
	echo(json_encode($response));
?>
