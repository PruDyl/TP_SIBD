<?php
class AppModel {
	private $pdo;

	public function __CONSTRUCT(){
		$this->pdo= new PDO('mysql:host=localhost;dbname=sibd', 'root', 'root');
	}

	public function getData($table) {
		$requestStr = '
		SELECT *
		FROM '.$table.'
		';
		$request = $this->pdo->query($requestStr);
		$result = $request->fetchAll(PDO::FETCH_NUM);
		//var_dump($result);
		return $result;
	}

	public function getDataLimit($table, $perPage, $cPage) {
		$requestStr = '
		SELECT *
		FROM '.$table.'
		LIMIT '.(($cPage - 1)*$perPage).','.$perPage.'
		';
		$request = $this->pdo->query($requestStr);
		$result = $request->fetchAll(PDO::FETCH_NUM);
		//var_dump($request);
		return $result;
	}

	public function getColumnData($table) {
		$requestStr = '
				SELECT COLUMN_NAME 
				FROM information_schema.columns 
				WHERE TABLE_NAME="'.$table.'"';
				//var_dump($requestStr);
				$request = $this->pdo->query($requestStr);
				$result = $request->fetchAll(PDO::FETCH_NUM);
				return $result;
	}

	public function countData($table) {
		$requestStr = '
				SELECT COUNT(*) as nbData
				FROM '. $table .' 
				';
				//var_dump($requestStr);
				$request = $this->pdo->query($requestStr);
				$result = $request->fetchAll(PDO::FETCH_NUM);
				return $result;
	}
}