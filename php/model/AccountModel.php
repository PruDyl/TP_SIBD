<?php
class AccountModel {
    /**
    * Add a new user to the database.
    * @param array $params
    * @return bool
    */
    public function addUser($params = array()){
        if (count($params) == 0)
        return false;

        $db = connect();
        $result = $db->prepare("INSERT INTO user (date, email)
        VALUES (NOW(), ?)");
        $result->bindParam(1, $params['email']);
        $result->execute();
    }

    public function getData($attribute, $attributeTest, $valueAttributetest) {
        $db = connect();
        $request = $db->prepare("SELECT :attribute
                                 FROM user
                                 WHERE :attributeTest = :valueAttributetest");
        $request -> execute(array("attribute" => $attribute, "attributeTest" => $attributeTest, "valueAttributetest" => $valueAttributetest));
        return $result = $request -> fetch(PDO::FETCH_ASSOC);
    }
}