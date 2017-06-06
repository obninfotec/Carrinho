<?php

namespace App;

class Loader {

    public function Register() {
        spl_autoload_register(array($this, 'Autoload'));
    }

    public function Autoload($Class) {
        $Class = DIR . DS . str_replace("\\", DS, $Class) . '.php';
        include_once $Class;
    }

}
