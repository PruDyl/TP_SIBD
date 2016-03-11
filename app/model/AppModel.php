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
	
	/*
	 * Crée un joueur
	 * @param array[] contenant les attributs d'un player
	 * @return bool true si ajout a réussi sinon false
	 */
	public function addPlayer($params = array()) {
		if(count($params) == 0)
			return false;
		
		$sql = "INSERT INTO	Player (pseudo, mail, mot_de_passe, prenom, nom, sexe, date_naissance, 
									telephone, adresse_postal, avatar, description, adresse_site_web, 
									argent, IP, date_heure_inscription, date_heure_derniere_connexion, 
									id_compte_bancaire, operation_bancaire)
				VALUES (";
	}
}