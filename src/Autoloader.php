<?php

class Autoloader {

    public static function register() {
        spl_autoload_register(array('Autoloader', 'load'));
    }

    public static function load($fileName) {
        if (file_exists("src/".$fileName.".php")) {
            require "src/".$fileName.".php";
        }
    }

}

?>