<?php
    ini_set('display_errors',1);
    include_once('../model/base.php');
    include_once('../model/AccountModel.php');
    include_once('./AccountControl.php');
    $accountcontroller = new AccountControl();
    if(!$accountcontroller->isAlreadyRegistred($_POST['email']))
        $accountcontroller->controlInscription($_POST);