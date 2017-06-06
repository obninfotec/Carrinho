<?php

namespace App\Mvc;

class View {

    private $Data = [];
    private $Folder;

    public function __construct() {
        $this->Folder = DIR . DS . 'App' . DS . 'View' . DS;
    }

    public function Set($Key, $Value) {
        $this->Data[$Key] = $Value;
    }

    public function Render($File) {
        $Filename = $this->Folder . $File . '.php';
        if (file_exists($Filename)) {
            extract($this->Data);
            include $Filename;
        }
    }

}
