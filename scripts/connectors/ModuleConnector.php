<?php
	class ModuleListItemsConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "modules";
		public static $COLUMN_ID = "id";
		public static $COLUMN_MODULECODE = "moduleCode";
		public static $COLUMN_MODULENAME = "moduleName";
		public static $COLUMN_REQUIREDGRADES = "requiredGrades";
		
		private $createStatement = NULL;
		private $selectStatement = NULL;
		private $selectAllStatement = NULL;
		private $deleteStatement = NULL;
		
		function __construct($mysqli) {
			if($mysqli->connect_errno > 0){
				die('Unable to connect to database [' . $mysqli->connect_error . ']');
			}
			
			$this->mysqli = $mysqli;
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . ModuleListItemsConnector::$TABLE_NAME . "(`" . ModuleListItemsConnector::$COLUMN_MODULECODE . "`, `" . ModuleListItemsConnector::$COLUMN_MODULENAME . "`, `" . ModuleListItemsConnector::$COLUMN_REQUIREDGRADES . "`) VALUES(?,?,?)");
			
			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . ModuleListItemsConnector::$TABLE_NAME . "` WHERE `" . ModuleListItemsConnector::$COLUMN_ID . "` = ?");

			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . ModuleListItemsConnector::$TABLE_NAME);

			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . ModuleListItemsConnector::$TABLE_NAME . " WHERE `" . ModuleListItemsConnector::$COLUMN_ID . "` = ?");

			$this->updateStatement = $mysqli->prepare("UPDATE " . ModuleListItemsConnector::$TABLE_NAME . " SET `" . ModuleListItemsConnector::$COLUMN_MODULECODE . "` = ?, `" . ModuleListItemsConnector::$COLUMN_MODULENAME . "` = ?, `" . ModuleListItemsConnector::$COLUMN_REQUIREDGRADES . "` = ? WHERE `" . ModuleListItemsConnector::$COLUMN_ID . "` = ?");
                
		}
		
		public function create($moduleCode, $moduleName, $requiredGrades) {
			$this->createStatement->bind_param("sss", $moduleCode, $moduleName, $requiredGrades);
			return $this->createStatement->execute();
		}
		
		public function select($id) {
			$this->selectStatement->bind_param("i", $id);
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
		
		public function update($moduleCode, $moduleName, $requiredGrades, $id) {
			$this->updateStatement->bind_param("sssi", $moduleCode, $moduleName, $requiredGrades, $id);
			
			if(!$this->updateStatement->execute()) return false; // if the query didn't execute, return false
			return true;
		}
		
		public function delete($id) {
			$this->deleteStatement->bind_param("i", $id);
			if(!$this->deleteStatement->execute()) return false; // if the query didn't execute, return false
			
			return true;
		}
	}
?>
