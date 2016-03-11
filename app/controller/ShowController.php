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
    	if(isset($_SESSION)) {
    		$this->render('adminIndex', compact($chevalInfos));
    	}
    	else {
    		$this->render('loginForm');
    	}

    	$this->render('footer');
    	$this->render('script');
        
    }

    public function objets($table, $param){
        $this->render('head');
        $this->render('header');
        $dataTable = [];
        $perPage = 2;
        $cPage = 1;
        if (isset($_GET['p'])) {
            $cPage = $_GET['p'];
        }
        else{
            $cPage = 1;
        }
        $columnName = $this->AppModel->getColumnData($table);
        $tableData = $this->AppModel->getDataLimit($table, $perPage, $cPage);
        $countData = $this->AppModel->countData($table);
        array_push($dataTable, $tableData, $columnName, $countData, $perPage, $cPage, $table);
        $this->render('objets', $dataTable);
        $this->render('footer');
        $this->render('script');
    }
}