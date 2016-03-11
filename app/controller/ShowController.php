<?php
class ShowController extends AppController{
	public function __CONSTRUCT(){
		parent::__construct();
		$this->loadModel('AppModel');
	}
	
    public function index() {
    	$this->render('head');
    	$this->render('header');

    	$chevalInfos=$this->AppModel->getData('Cheval');
    	if(isset($_SESSION['user'])) {
    		$this->render('adminIndex', compact($chevalInfos));
    	}
    	else {
    		$this->render('loginForm');
            if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['password']) && !empty($_POST['password'])) {
                $this->AppModel->connect('localhost', 'sibd', $_POST['pseudo'], $_POST['password']);
    	    }

        }

    	$this->render('footer');
    	$this->render('script');
        
    }

    public function objets($table){
        $this->render('head');
        $this->render('header');
        $dataTable = [];
        $tableData = $this->AppModel->getData($table);
        array_push($dataTable, $tableData); 
        $this->render('objets', $dataTable);
        $this->render('footer');
        $this->render('script');
    }
}