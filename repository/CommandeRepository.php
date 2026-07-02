<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Commande.php';

class CommandeRepository{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo= Database::getConnexion();
    }

    public function createOrder(int $user_id,string $created_at, int $total){
        $sql = "INSERT INTO orders(user_id, created_at, total) VALUES (:user_id, :created_at, :total)";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute([':user_id' => $user_id, ':created_at' => $created_at, ':total' => $total ])){
            return $this->pdo->lastInsertId();
        }

        return false;

    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM orders WHERE id= :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Commande(
            $ligne['id'],
            $ligne['user_id'],
            $ligne['created_at'],
            $ligne['total']

        );
    }

    public function findByUserId(int $user_id)
    {
        $sql = "SELECT * FROM orders WHERE user_id= :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        $lignes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $commandes = [];

        foreach($lignes as $ligne){
            $commandes[] = new Commande(
                $ligne['id'],
                $ligne['user_id'],
                $ligne['created_at'],
                $ligne['total']
            );
        }
        return $commandes;
        
    }

    public function updateTotal(int $id, int $total){
        $sql = "UPDATE orders SET  total = :total WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id, ':total'=> $total]);
    }


}