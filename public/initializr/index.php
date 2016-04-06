<?php
    session_start();
    define('WEBROOT', str_replace('index.php','../../',$_SERVER['SCRIPT_NAME']));
    define('ROOT', str_replace('index.php','../../',$_SERVER['SCRIPT_FILENAME']));
    require_once('../../core/utils/Autoloader.php');

    Autoloader::register();
    $controller = new ShowController();

    if(isset($_GET['page'])) {
        if (method_exists($controller,$_GET['page'])) {
            call_user_func_array(array($controller, $_GET['page']), $_GET);
        } 
    }
    else {
        $controller->index();
    }
   