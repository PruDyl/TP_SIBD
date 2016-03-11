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

    public function objets($table){
        $this->render('head');
        $this->render('header');

        $tableData = $this->AppModel->getData($table);

        $this->render('objets', compact($tableData));
        $this->render('footer');
        $this->render('script');
    }
}