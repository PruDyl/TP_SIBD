<?php
    ini_set("display_errors", 1);
    include_once("../model/base.php");
    include_once("./AccountControl.php");
    include_once("../model/AccountModel.php");

    $accountControl = new AccountControl();
    $accountControl->controlLogin();