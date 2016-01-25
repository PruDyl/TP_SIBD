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
        $result = $db->prepare("INSERT INTO user (identifiant, civilite, email, mot_de_passe, telephone, pays, date)
                                VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $result->bindParam(1, $params['identifiant']);
        $result->bindParam(2, $params['civilite']);
        $result->bindParam(3, $params['email']);
        $result->bindParam(4, sha1($params['mot_de_passe']));
        $result->bindParam(5, $params['telephone']);
        $result->bindParam(6, $params['pays']);

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