<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../model/Produit.php";
// réutilisable pour la page d'accueil, panier, administration, commandes

class ProduitRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo) // on construit une connexion à la base
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    { // on récupère tous les produits
        //sous forme d'un tableau associatif  
        $stmt = $this->pdo->query("SELECT * FROM products");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $produits = [];
        foreach ($rows as $row) {
            $produits[] = new Produit(
                (int)$row["id"],
                $row["name"],
                $row["description"],
                (float)$row["price"]
            );
        }
        return $produits; //on retourne le tableau d'ojbjet produit après avoir transforméchaque ligne sql en objet produit
    }

    public function findById(int $id): ?Produit
    { // on récupère un produit par son id

        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC); // on prépare, exécute, récupère 

        if (!$row) return null;

        return new Produit(
            (int)$row["id"],
            $row["name"],
            $row["description"],
            (float)$row["price"]
        );
    }

    public function create(Produit $p): void
    { // on met à jour le produit
        $stmt = $this->pdo->prepare("INSERT INTO products (name, description, price) VALUES (?, ? , ?)");

        $stmt->execute([ //on met les valeurs à jour
            $p->getName(),
            $p->getDescription(),
            $p->getPrice(),
        ]);
    }
    public function delete(int $id): void
    { // on supprime grâce à l'id
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function supprimer(int $id): void
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}
