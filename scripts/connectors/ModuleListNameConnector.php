<?php
	class ModuleListNameConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "moduleListNames";
		public static $COLUMN_ID = "id";
		public static $COLUMN_NAME = "name";
		
		private $createStatement = NULL;
		private $selectStatement = NULL;
		private $selectAllStatement = NULL;
		private $deleteStatement = NULL;
		
		function __construct($mysqli) {
			if($mysqli->connect_errno > 0){
				die('Unable to connect to database [' . $mysqli->connect_error . ']');
			}
			
			$this->mysqli = $mysqli;
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . ModuleListNameConnector::$TABLE_NAME . "(`" . ModuleListNameConnector::$COLUMN_NAME . "`) VALUES(?)");
			
			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . ModuleListNameConnector::$TABLE_NAME . "` WHERE `" . ModuleListNameConnector::$COLUMN_ID . "` = ?");

			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . ModuleListNameConnector::$TABLE_NAME . "`");

			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . ModuleListNameConnector::$TABLE_NAME . " WHERE `" . ModuleListNameConnector::$COLUMN_ID . "` = ?");

			$this->updateStatement = $mysqli->prepare("UPDATE " . ModuleListNameConnector::$TABLE_NAME . " SET `" . ModuleListNameConnector::$COLUMN_NAME . "` = ? WHERE `" . ModuleListNameConnector::$COLUMN_ID . "` = ?");
                
		}
		
		public function create($name) {
			$this->createStatement->bind_param("s", $name);
			return $this->createStatement->execute();
		}
		
		public function select($listId) {
			$this->selectStatement->bind_param("i", $listId);
			if(!$this->selectStatement->execute()) return false; // if the query didn't execute, return false

			$result = $this->selectStatement->get_result();
			if(!$result) return false; // if the query didn't give a result, return false
			$admin = $result->fetch_assoc();
			
			$this->selectStatement->free_result(); // releases memory
			
			return $admin;
		}
		public function selectAll() {
			if(!$this->selectAllStatement->execute()) return false; // if the query didn't execute, return false
			$result = $this->selectAllStatement->get_result(); // frees memory
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		
		public function update($listId, $name) {
			$this->updateStatement->bind_param("si", $name, $listId);
			
			if(!$this->updateStatement->execute()) return false; // if the query didn't execute, return false
			return true;
		}
		
		public function delete($listId) {
			$this->deleteStatement->bind_param("i", $listId);
			if(!$this->deleteStatement->execute()) return false; // if the query didn't execute, return false
			
			return true;
		}
	}
?>
