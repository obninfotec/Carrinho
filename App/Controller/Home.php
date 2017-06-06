<?php

namespace App\Controller;

use App\Mvc\Controller;
use App\Model\Product\ProductRepository;

class Home extends Controller {
    
    private $Product;
    
    public function __construct(ProductRepository $Product) {
        parent::__construct();
        $this->Product = $Product;
    }

    public function Index() {
        //echo 'Olá Mundo - Home';
        $this->View->set('Products', $this->Product->getProducts());
        $this->View->Render("Home");
    }

}
