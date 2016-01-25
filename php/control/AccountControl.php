<?php

class AccountControl {

    /**
     *
     */
    public function controlLogin() {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
        $accountModel = new AccountModel();
        if($accountModel -> isUserExist($identifiant, $mot_de_passe)) {
            session_start();
            echo "Bonjour !";

        }
        else {
            echo "Mauvais mot de passe !";
        }

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
            echo "Champ(s) non renseigné";
        elseif($_POST['mot_de_passe'] != $_POST['mot_de_passe_verif'])
            echo "Vérification de mot de passe non identique";
        else {
            $accountmodel = new AccountModel();
            if($accountmodel->isAlreadyRegistred($_POST['email']))
                $accountmodel->AddUser($_POST);
        }
    }
}