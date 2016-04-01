<?php
function connect()
{
    try{
        $db = new PDO('mysql:host=localhost;dbname=TP_SIBD', "root", "root", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        return $db;
    }
    catch(PDOException $e){
        $e->getMessage();
    }
}