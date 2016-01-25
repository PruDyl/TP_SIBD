<?php
class AccountControl {
    public function controlLogin() {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);

        $accountModel = new AccountModel();
        if($accountModel -> getData('*','mot_de_passe','mot_de_passe')) {
            session_start();
            echo "Bonjour !";

        }
        else {
            echo "Mauvais mot de passe !";
        }

    }
}