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

    /**
     * Test if an user exits in the database.
     * @param string $identifiant
     * @param string $mot_de_passe
     * @return bool
     */
    public function isUserExist($identifiant, $mot_de_passe) {
        $db = connect();
        $request = $db->prepare("SELECT *
                                 FROM user
                                 WHERE identifiant = :identifiant
                                 AND   mot_de_passe = :mot_de_passe");
        $request -> execute(array("identifiant" => $identifiant, "mot_de_passe" => $mot_de_passe));
        if($result = $request -> fetch())
            return true;
        else
            return false;
    }

    /**
     * Get back data of a user
     * @param string $attribute
     * @param string $attributeTest
     * @param string $valueAttributetest
     * @return array
     */
    public function getData($attribute, $attributeTest, $valueAttributetest) {
        $db = connect();
        $request = $db->prepare("SELECT :attribute
                                 FROM user
                                 WHERE :attributeTest = :valueAttributetest");
        $request -> execute(array("attribute" => $attribute, "attributeTest" => $attributeTest, "valueAttributetest" => $valueAttributetest));
        return $result = $request -> fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get back data of a user
     * @param string $attribute
     * @param string $attributeTest
     * @param string $valueAttributetest
     * @return array
     */
    public function isAlreadyRegistred($email = null){
        $db = connect();
        $result = $db->prepare("SELECT id
                                FROM user
                                WHERE email = '.$email.'");
        $result = $result->fetch(PDO::FETCH_ASSOC);

        if($result)
            return true;
        else
            return false;
    }
}