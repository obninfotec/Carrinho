<?php
/**
 * Description of ProductRepositoryPDO
 * @author Osvaldo
 */
namespace App\Model\Product;

class ProductRepositoryPDO implements ProductRepository {
    
    private $Pdo;
    
    public function __construct($Pdo) {
        $this->Pdo = $Pdo;
    }
    
    public function getProducts() {
        $stmt = $this->Pdo->prepare("SELECT * FROM product");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'App\Model\Product\Product');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getProduct($id) {
        $stmt = $this->Pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'App\Model\Product\Producr');
        $stmt->execute();
        return $stmt->fetch();
    }
    
}
