<?php
class AccountControl {
    public function controlLogin() {
        $identifiant = htmlspecialchars($_SESSION['identifiant']);
    }
}