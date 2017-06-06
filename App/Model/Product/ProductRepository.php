<?php
/**
 * @author Osvaldo
 */
namespace App\Model\Product;

interface ProductRepository {
    
    public function getProducts();
    public function getProduct($id);
    
}
