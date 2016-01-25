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

    public function getData($attribute, $attributeTest, $valueAttributetest, $isTest = false) {
        $db = connect();
        $request = $db->prepare("SELECT :attribute
                                 FROM user
                                 WHERE :attributeTest = :valueAttributetest");
        $request -> execute(array("attribute" => $attribute, "attributeTest" => $attributeTest, "valueAttributetest" => $valueAttributetest));
        echo "<br>requete :";
        var_dump( $request);
        if ($isTest) {
            if($result = $request -> fetch(PDO::FETCH_ASSOC))
                return true;
            else
                return false;
        }
        else
            return $result = $request -> fetch(PDO::FETCH_ASSOC);
    }
}