<?php
class Autoloader{
    static function register() {
        spl_autoload_register(array('Autoloader', 'autoload'));
    }

    static function autoload($class) {
        if(preg_match('/\\\/', $class)) {
            $class=preg_replace("#.*\\\#",'', $class);
        }
        $path='';
        $pathReturn=substr_count($_SERVER['SCRIPT_NAME'] , '/')-2;
        while ($pathReturn > 0) {
            $path.='../';
            --$pathReturn;
        }
        if( file_exists ($path.'app/controller/'.$class.'.php')) {
            $path.='app/controller/'.$class.'.php';
            require($path);
        }
        else if(file_exists($path.'core/controller/'.$class.'.php')) {
            $path.='core/controller/'.$class.'.php';
            require($path);
        }
        else if(file_exists($path.'app/model/'.$class.'.php')) {
            $path.='app/model/'.$class.'.php';
            require($path);
        }
    }
}