<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../model/Produit.php";
require_once __DIR__ . "/../repository/ProduitRepository.php";

class AdminController
{
    private ProduitRepository $repo;

    public function __construct()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?route=login");
            exit();
        }
        $this->repo = new ProduitRepository(Database::getConnexion());
    }

    public function produits()
    {
        $produits = $this->repo->findAll();
        require __DIR__ . "/../view/admin_produits.php";
    }

    public function ajouterProduit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = (float)$_POST['price'];
            $description = $_POST['description'];

            $produit = new Produit(0, $name, $description, $price);
            $this->repo->create($produit);

            header("Location: index.php?route=admin");
            exit();
        }
        $produits = $this->repo->findAll();
        require __DIR__ . "/../view/admin_produits.php";
    }

    public function suprimmerProduit()
    {
        if (!isset($_GET['id'])) {
            header("Location: index.php?route=admin");
            exit();
        }

        $id = (int) $_GET['id'];
        $this->repo->delete($id);
        header("Location: index.php?route=admin");
        exit();
    }

    public function modifierProduit()
    {
        $id = (int)$_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = (float)$_POST['price'];
            $description = $_POST['description'];

            $produit = new Produit($id, $name, $description, $price);
            $this->repo->update($produit);

            header("Location: index.php?route=admin");
            exit();
        }

        $produit = $this->repo->findById($id);
        $produits = $this->repo->findAll();
        require __DIR__ . "/../view/admin_produits.php";
    }
}
