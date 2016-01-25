<?php
class AccountModel {
    /**
    * Add a new user to the database.
    * @param array $params
    * @return bool
    */
    public function AddUser($params = array()){
        if (count($params) == 0)
            return false;

        $db = connect();
        $result = $db->prepare("INSERT INTO user (date, email)
        VALUES (NOW(), ?)");
        $result->bindParam(1, $params['email']);
        $result->execute();
    }
}