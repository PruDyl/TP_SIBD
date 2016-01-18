<?php
/**
 * Created by PhpStorm.
 * User: v13000737
 * Date: 18/01/16
 * Time: 16:25
 */

function AddUser($params = array()){
    if (count($params) == 0)
        return false;

    $db = connect();
    $result = $db->prepare("INSERT INTO user (date, email)
                            VALUES (NOW(), ?)");
    $result->bindParam(1, $params['email']);
    $result->execute();

}