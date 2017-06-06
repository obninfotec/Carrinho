<?php

namespace App\Controller;

use App\Mvc\Controller;

class Login extends Controller {

    protected $Loginsert;

    public function __construct() {
        $this->Loginsert = "Nome de Usuário";
    }

    public function Index() {

        echo '<script>alert("' . $this->Loginsert . '");</script>';
        echo '<p><a href="' . LOCAL . '">Voltar ao início</a></p>';
    }

    public function Login(){
    	echo "you're in, i'm out, bye!!!";
    	//sleep(5);
    	//header("location:".LOCAL );
    }

    public function Logout(){
    	echo "You're out!!";
    }


}
