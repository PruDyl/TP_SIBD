<?php
class AppModel {
	private $pdo;

	public function __CONSTRUCT(){
		$this->pdo= new PDO('mysql:host=localhost;dbname=sibd', 'root', 'root');
	}

	public function getTables() {
		$requestStr='SHOW tables';
		$request = $this->pdo->query($requestStr);
		$result = $request->fetchAll(PDO::FETCH_NUM);
		//var_dump($result);
		return $result;
	}

	public function getData($table) {
		$requestStr='
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

	public function connect($host, $db, $user, $password) {
		$success = true;
		try {
		    $this->pdo= new PDO('mysql:host='.$host.';dbname='.$db.'',$user, $password);
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
			$success = false;
		}
		if($success) {
			$_SESSION['user']=$_POST['pseudo'];
		}
		return $success;
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
	
	/*
	 * Modifie un joueur
	 * @param array[] contenant les attributs d'un joueur
	 * @return bool true si modif réussi sinon false
	 */
	public function modPlayer($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Player 
				SET		pseudo = '".$params['pseudo']."', mail = '".$params['mail']."', mot_de_passe = '".sha1($params['mot_de_passe'])."', 
						prenom = '".$params['prenom']."', nom = '".$params['nom']."', sexe = '".$params['sexe']."', 
						date_naissance = '".$params['date_naissance']."', telephone = '".$params['telephone']."', adresse_postal = '".$params['adresse_postal']."', 
						avatar = '".$params['avatar']."', description = '".$params['description']."', adresse_site_web = '".$params['adresse_site_web']."',
						argent = '".$params['argent']."', IP = '".$params['IP']."', date_heure_derniere_connexion = '".$params['date_heure_derniere_connexion']."',
						id_compte_bancaire = '".$params['id_compte_bancaire']."', operation_bancaire = '".$params['operation_bancaire']."'
				WHERE	id_player = '".$params['id_player']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie une tache
	 * @param array[] contenant les attributs d'une tache
	 * @return bool true si modif réussi sinon false
	 */
	public function modTache($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Tache 
				SET		id_item = '".$params['id_item']."', id_player = '".$params['id_player']."', 
						action = '".$params['action']."', frequence = '".$params['frequence']."'
				WHERE	id_tache = '".$params['id_tache']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie un journal
	 * @param array[] contenant les attributs d'un journal
	 * @return bool true si modif réussi sinon false
	 */
	public function modJournal($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Journal 
				SET		titre = '".$params['titre']."', texte = '".$params['texte']."', image = '".$params['image']."'
				WHERE	id_journal = '".$params['id_journal']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie un item_concours
	 * @param array[] contenant les attributs d'un item_concours
	 * @return bool true si modif réussi sinon false
	 */
	public function modItemConcours($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Item_concours 
				SET		id_item = '".$params['id_item']."', id_concours = '".$params['id_concours']."', 
						rang_concours = '".$params['rang_concours']."'
				WHERE	id_item_concours = '".$params['id_item_concours']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie un item
	 * @param array[] contenant les attributs d'un item
	 * @return bool true si modif réussi sinon false
	 */
	public function modItem($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Item 
				SET		id_infrastructure = '".$params['id_infrastructure']."', id_cheval = '".$params['id_cheval']."', 
						description = '".$params['description']."', type = '".$params['type']."', 
						niveau = '".$params['niveau']."', famille = '".$params['famille']."', prix = '".$params['prix']."'
				WHERE	id_item = '".$params['id_item']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie une infrastructure
	 * @param array[] contenant les attributs d'une infrastructure
	 * @return bool true si modif réussi sinon false
	 */
	public function modInfrastructure($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Infrastructure 
				SET		id_centre = '".$params['id_centre']."', id_club = '".$params['id_club']."', 
						type_infrastructure = '".$params['type_infrastructure']."', niveau = '".$params['niveau']."',
						description = '".$params['description']."', famille_infrastructure = '".$params['famille_infrastructure']."', 
						prix = '".$params['prix']."', conso_ressources = '".$params['conso_ressources']."',
						capacite_stock_item = '".$params['capacite_stock_item']."', capacite_stock_cheval = '".$params['capacite_stock_cheval']."', 
						choix_batiment = '".$params['choix_batiment']."'
				WHERE	id_infrastructure = '".$params['id_infrastructure']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie un concours
	 * @param array[] contenant les attributs d'un concours
	 * @return bool true si modif réussi sinon false
	 */
	public function modConcours($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Concours 
				SET		id_item = '".$params['id_item']."', id_infrastructure = '".$params['id_infrastructure']."', 
						date_debut = '".$params['date_debut']."', date_fin = '".$params['date_fin']."'
				WHERE	id_concours = '".$params['id_concours']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie un club hippique
	 * @param array[] contenant les attributs d'un club hippique
	 * @return bool true si modif réussi sinon false
	 */
	public function modClubHippique($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Club_hippique 
				SET		id_player = '".$params['id_player']."', id_infrastructure = '".$params['id_infrastructure']."', 
						capacite_accueil = '".$params['capacite_accueil']."'
				WHERE	id_club = '".$params['id_club']."')";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie un cheval
	 * @param array[] contenant les attributs d'un cheval
	 * @return bool true si modif réussi sinon false
	 */
	public function modCheval($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Player 
				SET		id_player = '".$params['id_player']."', nom = '".$params['nom']."', race = '".$params['race']."', 
						description = '".$params['description']."', resistance = '".$params['resistance']."', 
						endurance = '".$params['endurance']."', detente = '".$params['detente']."', vitesse = '".$params['vitesse']."', 
						sociabilite = '".$params['sociabilite']."', intelligence = '".$params['intelligence']."', 
						temperament = '".$params['temperament']."', sante = '".$params['sante']."', moral = '".$params['moral']."', 
						stress = '".$params['stress']."', fatigue = '".$params['fatigue']."', faim = '".$params['faim']."', 
						proprete = '".$params['proprete']."', experience = '".$params['experience']."', niveau = '".$params['niveau']."', 
						etat_general = '".$params['etat_general']."', blessures = '".$params['blessures']."', 
						maladies = '".$params['maladies']."', parasites = '".$params['parasites']."'
				WHERE	id_cheval = '".$params['id_cheval']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Modifie un centre equestre
	 * @param array[] contenant les attributs d'un centre equestre
	 * @return bool true si modif réussi sinon false
	 */
	public function modCentreEquestre($params = array()) {
		if(count($params) == 0)
			return false;
	
		$sql = "UPDATE	Centre_equestre 
				SET		id_player = '".$params['id_player']."', id_infrastructure = '".$params['id_infrastructure']."', 
						id_tache = '".$params['id_tache']."', capacite = '".$params['capacite']."')
				WHERE	id_centre = '".$params['id_centre']."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime un joueur
	 * @param int contenant l'id d'un joueur
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprPlayer($id_player = 0) {
		if($id_player == 0)
			return false;
	
		$sql = "DELETE FROM	Player
				WHERE		id_player = '".$id_player."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime une tache
	 * @param int contenant l'id d'une tache
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprTache($id_tache = 0) {
		if($id_tache == 0)
			return false;
	
		$sql = "DELETE FROM	Tache
				WHERE		id_tache = '".$id_tache."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime un journal
	 * @param int contenant l'id d'un journal
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprJournal($id_journal = 0) {
		if($id_journal == 0)
			return false;
	
		$sql = "DELETE FROM	Journal
				WHERE		id_journal = '".$id_journal."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime un item_concours
	 * @param int contenant l'id d'un item_concours
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprItemConcours($id_item_concours = 0) {
		if($id_item_concours == 0)
			return false;
	
		$sql = "DELETE FROM	Item_concours
				WHERE		id_item_concours = '".$id_item_concours."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime un item
	 * @param int contenant l'id d'un item
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprItem($id_item = 0) {
		if($id_item == 0)
			return false;
	
		$sql = "DELETE FROM	Item
				WHERE		id_item = '".$id_item."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime une infrastructure
	 * @param int contenant l'id d'une infrastructure
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprInfrastructure($id_infrastructure = 0) {
		if($id_infrastructure == 0)
			return false;
	
		$sql = "DELETE FROM	Infrastructure
				WHERE		id_infrastructure = '".$id_infrastructure."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime un concours
	 * @param int contenant l'id d'un concours
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprConcours($id_concours = 0) {
		if($id_concours == 0)
			return false;
	
		$sql = "DELETE FROM	Concours
				WHERE		id_concours = '".$id_concours."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime un club hippique
	 * @param int contenant l'id d'un club hippique
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprClubHippique($id_club = 0) {
		if($id_club == 0)
			return false;
	
		$sql = "DELETE FROM	Club_hippique
				WHERE		id_club = '".$id_club."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime un cheval
	 * @param int contenant l'id d'un cheval
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprCheval($id_cheval = 0) {
		if($id_cheval == 0)
			return false;
	
		$sql = "DELETE FROM	Cheval
				WHERE		id_cheval = '".$id_cheval."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
	/*
	 * Supprime un centre equestre
	 * @param int contenant l'id d'un centre equestre
	 * @return bool true si suppression réussi sinon false
	 */
	public function SuprCentreEquestre($id_centre = 0) {
		if($id_centre == 0)
			return false;
	
		$sql = "DELETE FROM	Centre_equestre
				WHERE		id_centre = '".$id_centre."'";
	
		if($this->pdo->exec($sql))
			return true;
		else
			return false;
	}
	
}