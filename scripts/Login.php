<?php
	require_once 'utils/database.php';
	require_once 'connectors/AdminConnector.php';

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$AdminConnector = new AdminConnector($conn);

	$result = $AdminConnector->select($username);
	if(!$result) {
		$response["message"] = "Invalid username or password";
		$response["success"] = false;
	}
	else {
		$passwordHash = hash('sha512', ($password . $result[AdminConnector::$COLUMN_SALT]));
		if(strcmp($passwordHash, $result[AdminConnector::$COLUMN_PASSWORDHASH]) == 0) {
			$response["success"] = true;
			$response["adminId"] = $result[AdminConnector::$COLUMN_ID];
		}
		else {
			$response["success"] = false;
			$response["message"] = "Invalid username or password";
		}
	}
	
	echo(json_encode($response));
?>
