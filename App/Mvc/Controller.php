<?php

namespace App\Mvc;

abstract class Controller {

//	public function Index(){echo 'Ola Mundo';}
    protected $View;

    public function __construct() {
        $this->View = new View();
    }

}
