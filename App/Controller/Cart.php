<?php

namespace App\COntroller;

use App\Mvc\Controller;

class Cart extends Controller {

    public function Index() {
        //echo "Olá Mundo - Carrinho";
        $this->View->Render("Cart");
    }

}
