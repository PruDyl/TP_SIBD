<?php
class ShowController extends AppController{
	public function __CONSTRUCT(){
		parent::__construct();
		$this->loadModel('AppModel');
	}
	
    public function index() {
    	$this->render('head');
    	$this->render('header');

    	if(isset($_SESSION['user'])) {
    		;
    	}
    	else {
    		$this->render('loginForm');
            if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
                if ($this->AppModel->connect('localhost', 'mysql', $_POST['pseudo'], $_POST['password'])) {
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

    public function objets($table, $param = []){
        $this->render('head');
        $this->render('header');
        $dataTable = [];
        $perPage = 15;
        $cPage = 1;
        if (isset($_GET['p'])) {
            $cPage = $_GET['p'];
        }
        else{
            $cPage = 1;
        }
        if(isset($_GET['table'])) {
            $columnName = $this->AppModel->getColumnData($_GET['table']);
            $tableData = $this->AppModel->getDataLimit($_GET['table'], $perPage, $cPage);
            $countData = $this->AppModel->countData($_GET['table']);
            array_push($dataTable, $tableData, $columnName, $countData, $perPage, $cPage, $_GET['table']);
                
        }
        else {
            $tablesName = $this->AppModel->getTables();
            array_push($dataTable, $tablesName);
        }
        $this->render('objets', $dataTable);
        $this->render('footer');
        $this->render('script');
    }
}