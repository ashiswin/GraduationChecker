<?php
	class TrackCoreConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "trackCores";
		public static $COLUMN_TRACKID = "trackId";
		public static $COLUMN_MODULEID = "moduleId";
		
		private $createStatement = NULL;
		private $selectStatement = NULL;
		private $selectAllStatement = NULL;
		private $deleteStatement = NULL;
		
		function __construct($mysqli) {
			if($mysqli->connect_errno > 0){
				die('Unable to connect to database [' . $mysqli->connect_error . ']');
			}
			
			$this->mysqli = $mysqli;
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . TrackCoreConnector::$TABLE_NAME . "(`" . TrackCoreConnector::$COLUMN_TRACKID . "`,`" . TrackCoreConnector::$COLUMN_MODULEID . "`) VALUES(?,?)");
			
			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . TrackCoreConnector::$TABLE_NAME . "` WHERE `" . TrackCoreConnector::$COLUMN_TRACKID . "` = ?");

			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . TrackCoreConnector::$TABLE_NAME . "`");

			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . TrackCoreConnector::$TABLE_NAME . " WHERE `" . TrackCoreConnector::$COLUMN_TRACKID . "` = ? AND `" . TrackCoreConnector::$COLUMN_MODULEID . "` = ?");
                
		}
		
		public function create($trackid, $moduleid) {
			$this->createStatement->bind_param("ii", $trackid, $moduleid);
			return $this->createStatement->execute();
		}
		
		public function select($trackId) {
			$this->selectStatement->bind_param("i", $trackId);
			if(!$this->selectStatement->execute()) return false; // if the query didn't execute, return false
			$result = $this->selectStatement->get_result(); // frees memory
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;;
		}
		public function selectAll() {
			if(!$this->selectAllStatement->execute()) return false; // if the query didn't execute, return false
			$result = $this->selectAllStatement->get_result(); // frees memory
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		
		public function delete($trackid, $moduleid) {
			$this->deleteStatement->bind_param("ii", $trackid, $moduleid);
			if(!$this->deleteStatement->execute()) return false; // if the query didn't execute, return false
			
			return true;
		}
	}
?>
