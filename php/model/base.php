<?php
/**
 * Created by PhpStorm.
 * User: v13000737
 * Date: 18/01/16
 * Time: 15:55
 */

function connect()
{
    try{
        $db = new PDO('mysql:host=localhost;dbname=TP_SIDB', "root", "root", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        return $db;
    }
    catch(PDOException $e){
        $e->getMessage();
    }
}
?>