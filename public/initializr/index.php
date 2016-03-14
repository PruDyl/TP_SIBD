<?php
    session_start();
    require_once('../../core/utils/Autoloader.php');
    Autoloader::register();
    if(empty($_GET['page']) || $_GET['page']==='index' ) {

        $controller = new ShowController();
        $controller->index();
    }
    else if ($_GET['page']==='objets' && !empty($_GET['table']) && !empty($_GET['p'])) {
        $controller = new ShowController();
        $controller->objets($_GET['table'], $_GET['p']);
    }
?>