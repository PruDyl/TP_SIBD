<?php

class AccountControl {

    /**
     *
     */
    public function controlLogin() {
        $identifiant = htmlspecialchars($_SESSION['identifiant']);
    }

    /**
     * @param $_POST
     * @return bool|string
     */
    public function controlInscription($_POST) {
        if(count($_POST) == 0)
            return false;

        if(($_POST['identifiant'] || $_POST['civilite'] || $_POST['email'] || $_POST['mot_de_passe']
        || $_POST['mot_de_passe_verif'] || $_POST['telephone'] || $_POST['pays']) == "")
            return "Champ(s) non renseigné";
        elseif($_POST['mot_de_passe'] != $_POST['mot_de_passe_verif'])
            return "Vérification de mot de passe non identique";
        else {
            $accountmodel = new AccountModel();
            $accountmodel->AddUser($_POST);
        }
    }
}