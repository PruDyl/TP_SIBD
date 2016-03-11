<?php
class AppModel {
	private $pdo;

	public function __CONSTRUCT(){
		$this->pdo= new PDO('mysql:host=localhost;dbname=sibd', 'root', 'root');
	}

	public function getData($table) {
		$requestStr = "
		SELECT *
		FROM $table
		";
		$request = $this->pdo->query($requestStr);
		$result = $request->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getUserData() {
		
	}
}