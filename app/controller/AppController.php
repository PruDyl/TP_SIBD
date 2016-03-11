<?php
class AppController extends Controller{
    public function __construct(){
        $path='';
        $pathReturn=substr_count($_SERVER['SCRIPT_NAME'] , '/')-2;
        while ($pathReturn > 0) {
            $path.='../';
            --$pathReturn;
        }
        $this->viewpath=$path.'app/view/';
    }

    protected function loadModel($model) {
    	$this->$model = new $model;
    }
}