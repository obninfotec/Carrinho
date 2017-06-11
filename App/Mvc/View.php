<?php

namespace App\Mvc;

class View {

    private $Data = [];
    private $Folder;
    private $Extrair = [];

    public function __construct() {
        $this->Folder = DIR . DS . 'App' . DS . 'View' . DS;
    }

    public function Set($Key, $Value) {
        $Dados = $this->Data[$Key] = $Value;
	echo '<pre>Antes de : ';
	print_r($Dados);
	echo '</pre>';
    }

    public function Render($File) {
        $Filename = $this->Folder . $File . '.php';
	echo 'Valor de Filename : '.$Filename;
        if (file_exists($Filename)) {
            $this->Extrair = extract($this->Data);
	    echo '<pre>Após : ';
	    print_r($Products);
	    echo '</pre>';
            include $Filename;
        }
    }

}
