<?php
class AppModel {
	private $pdo;

	public function __CONSTRUCT(){
		$this->pdo= new PDO('mysql:host=localhost;dbname=sibd', 'root', 'root');
	}

	public function getData($table) {
		$requestStr='
		SELECT *
		FROM '.$table.'
		';
		$request = $this->pdo->query($requestStr);
		$result = $request->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function connect($host, $db, $user, $password) {
		$success = true;
		try {
		    $this->pdo= new PDO('mysql:host='.$host.';dbname='.$db.'',$user, $password);
		} 
		catch (PDOException $e) {
			echo '<p>Identifiant incorrect</p>';
			$success = false;
		}
		if($success) {
			$_SESSION['user']=$_POST['pseudo'];
			echo '
			<SCRIPT LANGUAGE="JavaScript">
				document.location.href="./"
			</SCRIPT>';
		}
	
	}
}