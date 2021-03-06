<?php

class Autoloader
{
    static function register()
    {
        spl_autoload_register(array('Autoloader', 'autoload'));
    }

    /*
   * Importe les fichiers nécessaires à l'utilisation des classes
   * @param string class la classe concernée
   */
    static function autoload($class)
    {
        if (file_exists(ROOT . 'app/controller/' . $class . '.php')) {
            require(ROOT . 'app/controller/' . $class . '.php');
        } else if (file_exists(ROOT . 'core/controller/' . $class . '.php')) {
            require(ROOT . 'core/controller/' . $class . '.php');
        } else if (file_exists(ROOT . 'app/model/' . $class . '.php')) {
            require(ROOT . 'app/model/' . $class . '.php');
        }
    }
}