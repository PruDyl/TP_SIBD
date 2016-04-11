<?php
class ShowController extends AppController{
	public function __CONSTRUCT(){
		parent::__construct();
		$this->loadModel('AppModel');
	}

    /*
     * Affiche l'accueil de l'administration
     */
    public function index() {
        $dataTable = [];
        array_push($dataTable, 'Accueil administration');
    	$this->render('head', $dataTable);

    	$this->render('header');

        $dataTable = [];

    	if(isset($_SESSION['user'])) {
            $userPriv = $this->AppModel->getUserPrivilleges();
            $nbUsers = $this->AppModel->countData('Joueur');
            $averageMoney = $this->AppModel->getAverageData('argent','id_joueur', 'Joueur');
            $maxMoney = $this->AppModel->getMaxData('argent', 'Joueur');
            $minMoney = $this->AppModel->getMinData('argent', 'Joueur');
            $statServer = $this->AppModel->getStatServer();

            array_push($dataTable, $userPriv, $nbUsers, $averageMoney, $maxMoney, $minMoney, $statServer);

            $this->render('adminIndex', $dataTable);
    	}
    	else {
    		$this->render('loginForm');
            if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
                if ($this->AppModel->connect($_POST['pseudo'], $_POST['password'])) {
                    $this->AppModel->setPdo('sibd', $_POST['pseudo'], $_POST['password']);
                    echo '
                    <SCRIPT LANGUAGE="JavaScript">
                        document.location.href="./"
                    </SCRIPT>';
                }
                else {
                    echo '<div class="row"><div class="alert alert-warning col-md-4 col-md-offset-4" role="alert">Identifiant incorrect</div></div>';
                }
    	    }

        }

    	$this->render('footer');
    	$this->render('script');

    }

    /*
     * Affiche la table mise en parametre de l'url
     * @param string table contenant la table à afficher
     * @param array[] param contenant la liste des données utiles à la génération de la page
     */
    public function objets($table, $param = []){
        $dataTable = [];
        array_push($dataTable, 'Liste des tables');
        $this->render('head', $dataTable);

        $this->render('header');
        if(isset($_SESSION['user'])) {
            $dataTable = [];
            $perPage = 15;
            $cPage = 1;
            if (isset($_GET['p'])) {
                $cPage = $_GET['p'];
            } else {
                $cPage = 1;
            }
            if (isset($_GET['table'])) {
                $userPriv = $this->AppModel->getUserPrivilleges();
                $columnName = $this->AppModel->getColumnData($_GET['table']);
                $tableData = $this->AppModel->getDataLimit($_GET['table'], $perPage, $cPage);
                $countData = $this->AppModel->countData($_GET['table']);
                array_push($dataTable, $tableData, $columnName, $countData, $perPage, $cPage, $userPriv);

            } else {
                $tablesName = $this->AppModel->getTables();
                array_push($dataTable, $tablesName);
            }
            $this->render('objets', $dataTable);
        }
        else {
            $this->render('loginForm');
            if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
                if ($this->AppModel->connect($_POST['pseudo'], $_POST['password'])) {
                    $this->AppModel->setPdo('sibd', $_POST['pseudo'], $_POST['password']);
                    echo '
                    <SCRIPT LANGUAGE="JavaScript">
                        document.location.href="./"
                    </SCRIPT>';
                }
                else {
                    echo '<div class="row"><div class="alert alert-warning col-md-4 col-md-offset-4" role="alert">Identifiant incorrect</div></div>';
                }
            }
        }
        $this->render('footer');
        $this->render('script');
    }

    function insertion($table) {
        $dataTable = [];
        array_push($dataTable, 'Ajouter des données');
        $this->render('head', $dataTable);

        $this->render('header');
        if(isset($_SESSION['user']) & isset($_GET['table'])) {
            $dataTable = array();
            $columnName = $this->AppModel->getColumnData($_GET['table']);
            array_push($dataTable, $columnName);
            $this->render('insertion', $dataTable);

            if(isset($_POST['submit'])) {
                $fct = "add".ucfirst($_GET['table']);
                if(!$this->AppModel->$fct()) {
                    echo '<div class="row"><div class="alert alert-warning col-md-4 col-md-offset-4" role="alert">Erreur d\'insertion</div></div>';
                }

                else {
                    echo '<div class="row"><div class="alert alert-success col-md-4 col-md-offset-4" role="alert">Ajout effectué</div></div>';
                }
            }
        }
        else {
            $this->render('index');
        }

        $this->render('footer');
        $this->render('script');
    }
    
    /**
     * Affiche la page de modification
     * @param string table contenant la table à afficher
     */
    function modification($table) {
    	$dataTable = [];
    	array_push($dataTable, 'Modifier des données');
    	$this->render('head', $dataTable);
    	
    	$this->render('header');
    	if(isset($_SESSION['user']) & isset($_GET['table'])) {
    		$dataTable = $this->AppModel->getColumnData($_GET['table']);
    		$this->render('modification', $dataTable);
    	}
    	else {
    		$this->render('index');
    	}
    }
}
