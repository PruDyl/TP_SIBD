<?php
class Autoloader{
    static function register() {
        spl_autoload_register(array('Autoloader', 'autoload'));
    }

    static function autoload($class) {
        if( file_exists (ROOT.'app/controller/'.$class.'.php')) {
            $path.=ROOT.'app/controller/'.$class.'.php';
            require($path);
        }
        else if(file_exists(ROOT.'core/controller/'.$class.'.php')) {
            $path.=ROOT.'core/controller/'.$class.'.php';
            require($path);
        }
        else if(file_exists(ROOT.'app/model/'.$class.'.php')) {
            $path.=ROOT.'app/model/'.$class.'.php';
            require($path);
        }
    }
}