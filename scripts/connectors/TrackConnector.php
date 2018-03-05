<?php
	class TrackConnector {
		private $mysqli = NULL;
		
		public static $TABLE_NAME = "tracks";
		public static $COLUMN_ID = "id";
		public static $COLUMN_NAME = "name";
		public static $COLUMN_PILLAR = "pillar";
		public static $COLUMN_ELECTIVES = "electives";
		
		private $createStatement = NULL;
		private $selectStatement = NULL;
		private $selectByIdStatement = NULL;
		private $selectAllStatement = NULL;
		private $deleteStatement = NULL;
		
		function __construct($mysqli) {
			if($mysqli->connect_errno > 0){
				die('Unable to connect to database [' . $mysqli->connect_error . ']');
			}
			
			$this->mysqli = $mysqli;
			
			$this->createStatement = $mysqli->prepare("INSERT INTO " . TrackConnector::$TABLE_NAME . "(`" . TrackConnector::$COLUMN_NAME . "`, `" . TrackConnector::$COLUMN_PILLAR . "`) VALUES(?, ?)");

			$this->selectStatement = $mysqli->prepare("SELECT * FROM `" . TrackConnector::$TABLE_NAME . "` WHERE `" . TrackConnector::$COLUMN_ID . "` = ?");

			$this->selectByPillarStatement = $mysqli->prepare("SELECT * FROM `" . TrackConnector::$TABLE_NAME . "` WHERE `" . TrackConnector::$COLUMN_PILLAR . "` = ? ORDER BY `" . TrackConnector::$COLUMN_NAME . "`");

			$this->selectAllStatement = $mysqli->prepare("SELECT * FROM `" . TrackConnector::$TABLE_NAME . "`");

			$this->deleteStatement = $mysqli->prepare("DELETE FROM " . TrackConnector::$TABLE_NAME . " WHERE `" . TrackConnector::$COLUMN_ID . "` = ?");

			$this->updateStatement = $mysqli->prepare("UPDATE " . TrackConnector::$TABLE_NAME . " SET `" . TrackConnector::$COLUMN_NAME . "` = ? WHERE `" . TrackConnector::$COLUMN_ID . "` = ?");
                
        }
		
		public function create($name, $pillar) {
			$this->createStatement->bind_param("ss", $name, $pillar);
			return $this->createStatement->execute();
		}
		
		public function select($id) {
			$this->selectStatement->bind_param("i", $id);
			if(!$this->selectStatement->execute()) return false; // if the query didn't execute, return false

			$result = $this->selectStatement->get_result();
			if(!$result) return false; // if the query didn't give a result, return false
			$track = $result->fetch_assoc();
			
			$this->selectStatement->free_result(); // releases memory
			
			return $track;
		}
        
		public function selectByPillar($pillar) {
			$this->selectByPillarStatement->bind_param("s", $pillar);
			if(!$this->selectByPillarStatement->execute()) return false; // if the query didn't execute, return false
			$result = $this->selectByPillarStatement->get_result(); // frees memory
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		public function selectAll() {
			if(!$this->selectAllStatement->execute()) return false; // if the query didn't execute, return false
			$result = $this->selectAllStatement->get_result(); // frees memory
			$resultArray = $result->fetch_all(MYSQLI_ASSOC);
			return $resultArray;
		}
		
		public function updateTrack($name, $id) {
			$this->updateStatement->bind_param("si", $name, $id);
			
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
