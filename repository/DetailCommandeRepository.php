<?php

require_once __DIR__. '/../config/Database.php';
require_once __DIR__. '/../model/DetailCommande.php';

class DetailCommandeRepository{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo= Database::getConnexion();
    }

    public function create(int $order_id, int $product_id, int $quantity, int $unit_price){
        $sql = "INSERT INTO order_items(order_id, product_id, quantity, unit_price) VALUES (:order_id, :product_id, :quantity, :unit_price)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':order_id' => $order_id, ':product_id' => $product_id, ':quantity' => $quantity, ':unit_price' => $unit_price]);
    }

    public function findByOrderId()

    
}