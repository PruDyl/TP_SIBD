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
	
	/*
	 * Crée un joueur
	 * @param array[] contenant les attributs d'un player
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addPlayer($params = array()) {
		if(count($params) == 0)
			return false;
		
		$sql = "INSERT INTO	Player (pseudo, mail, mot_de_passe, prenom, nom, sexe, date_naissance, 
									telephone, adresse_postal, avatar, description, adresse_site_web, 
									argent, IP, date_heure_inscription, date_heure_derniere_connexion, 
									id_compte_bancaire, operation_bancaire)
				VALUES ('".$params['pseudo']."', '".$params['mail']."', '".sha1($params['mot_de_passe'])."', 
						'".$params['prenom']."', '".$params['nom']."', '".$params['sexe']."', 
						'".$params['date_naissance']."', '".$params['telephone']."', '".$params['adresse_postal']."', 
						'".$params['avatar']."', '".$params['description']."', '".$params['adresse_site_web']."', 
						'".$params['argent']."', '".$params['IP']."', '".$params['date_heure_inscription']."', 
						'".$params['date_heure_derniere_connexion']."', '".$params['id_compte_bancaire']."', '".$params['operation_bancaire']."')";
		
		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée une tache
	 * @param array[] contenant les attributs d'une tache
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addTache($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Tache (id_item, id_player, action, frequence)
				VALUES	('".$params['id_item']."', '".$params['id_player']."', 
						 '".$params['action']."', '".$params['frequence']."')";
	
		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée un journal
	 * @param array[] contenant les attributs d'un journal
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addJournal($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Journal (titre, texte, image)
				VALUES	('".$params['titre']."', '".$params['texte']."', '".$params['image']."')";
	
		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée une ligne dans item_consours
	 * @param array[] contenant les attributs d'un item_concours
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addItemConcours($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Item_concours (id_item, id_concours, rang_concours)
				VALUES ('".$params['id_item']."', '".$params['id_concours']."', '".$params['rang_concours']."')";
	
		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée un item
	 * @param array[] contenant les attributs d'un item
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addItem($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Item (id_infrastructure, id_cheval, description, type, niveau, famille, prix)
				VALUES ('".$params['id_infrastructure']."', '".$params['id_cheval']."', '".$params['description']."', 
						'".$params['type']."', '".$params['niveau']."', '".$params['famille']."', 
						'".$params['prix']."')";
	
		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée une infrastructure
	 * @param array[] contenant les attributs d'une infrastructure
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addInfrastructure($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Infrastructure (id_centre, id_club, type_infrastructure, niveau, 
											 description, famille_infrastructure, prix, conso_ressources, 
											 capacite_stock_item, capacite_stock_cheval, choix_batiment)
				VALUES ('".$params['id_centre']."', '".$params['id_club']."', '".$params['type_infrastructure']."',
						'".$params['niveau']."', '".$params['description']."', '".$params['famille_infrastructure']."',
						'".$params['prix']."', '".$params['conso_ressources']."', '".$params['capacite_stock_item']."', 
						'".$params['capacite_stock_cheval']."', '".$params['choix_batiment']."')";

		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée un concours
	 * @param array[] contenant les attributs d'un concours
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addConcours($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Concours (id_item, id_infrastructure, date_debut, date_fin)
				VALUES ('".$params['id_item']."', '".$params['id_infrastructure']."', 
						'".$params['date_debut']."', '".$params['date_fin']."')";

		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée un club hippique
	 * @param array[] contenant les attributs d'un club hippique
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addClubHippique($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Club_hippique (id_player, id_infrastructure, capacite_accueil)
				VALUES ('".$params['id_player']."', '".$params['id_infrastructure']."', '".$params['capacite_accueil']."')";

		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée un cheval
	 * @param array[] contenant les attributs d'un cheval
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addCheval($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Player (id_player, nom, race, description, resistance, endurance, 
									detente, vitesse, sociabilite, intelligence, temperament, sante, 
									moral, stress, fatigue, faim, proprete, experience, 
									niveau, etat_general, blessures, maladies, parasites)
				VALUES ('".$params['id_player']."', '".$params['nom']."', '".$params['race']."', 
						'".$params['description']."', '".$params['resistance']."', '".$params['endurance']."', 
						'".$params['detente']."', '".$params['vitesse']."', '".$params['sociabilite']."', 
						'".$params['intelligence']."', '".$params['temperament']."', '".$params['sante']."', 
						'".$params['moral']."', '".$params['stress']."', '".$params['fatigue']."', 
						'".$params['faim']."', '".$params['proprete']."', '".$params['experience']."', 
						'".$params['niveau']."', '".$params['etat_general']."', '".$params['blessures']."', 
						'".$params['maladies']."', '".$params['parasites']."')";
		
		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
	/*
	 * Crée un centre equestre
	 * @param array[] contenant les attributs d'un centre equestre
	 * @return int or false dernier id si ajout a réussi sinon false
	 */
	public function addCentreEquestre($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "INSERT INTO	Centre_equestre (id_player, id_infrastructure, id_tache, capacite)
				VALUES ('".$params['id_player']."', '".$params['id_infrastructure']."', 
						'".$params['id_tache']."', '".$params['capacite']."')";
	
		if($this->pdo->exec($sql))
			return $this->pdo->lastInsertId();
		else
			return false;
	}
	
}