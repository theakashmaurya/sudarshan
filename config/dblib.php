<?php

Class DatabaseLib {

	private $conn;

	public function createConnection() {

		$this->conn = mysqli_connect('localhost', 'root', '', 'core_sudarshan');

		if($this->conn){
			return true;
		}
		else{
			return false;
		}
	}

	public function runQuery($query) {

		$result = mysqli_query($this->conn, $query);

		if ($result) {
			return true;
		}
		else {
			return false;
		}

		mysqli_close($this->conn);
	}

	public function getData($query) {

		$result = mysqli_query($this->conn, $query);

		if(mysqli_num_rows($result)>0){
			return $result;
		}
		else{
			return false;
		}

		mysqli_close($this->conn);
	}
}

?>
