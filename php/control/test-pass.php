<?php
    include_once("./AccountControl.php");
    include_once("../model/AccountModel.php");

    $accountControl = new AccountControl();
    $accountControl->controlLogin();