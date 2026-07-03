<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../model/Commande.php";
require_once __DIR__ . "/../model/DetailCommande.php";
require_once __DIR__ . "/../model/Produit.php";
require_once __DIR__ . "/../model/Utilisateur.php";

class AdminController
{
    public function __construct()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?route=login");
            exit();
        }
    }

    public function commande()
    {
        $cmd = new Commande();
        $commandes = $cmd->getAll();
        require __DIR__ . "/../view/historique.php";
    }

    public function produits()
    {
        $prod = new Produit();
        $produits = $prod->getAll();
        require __DIR__ . "/../view/admin_produits.php";
    }

    public function ajouterProduit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['Price'];
            $description = $_POST['description'];
            $prod = new Produit();
            $prod->insert($name, $price, $description);
            header("Location: index.php");
            exit();
        }
        require __DIR__ . "/../view/admin_produits.php";
    }

    public function suprimmerProduit()
    {
        $id = (int)$_GET['id'];
        $prod = new Produit();
        $prod->delete($id);
        header("Location: index.php");
        exit();
    }

    public function modifierProduit()
    {
        $id = (int)$_GET['id'];
        $prod = new Produit();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $prod->update($id, $name, $price, $description);
            header("Location: index.php");
            exit();
        }
        $produit = $prod->getById($id);
        require __DIR__ . "/../view/admin_produits.php";
    }

    public function utilisateur()
    {
        $user = new Utilisateur();
        $users = $user->getAll();
        require __DIR__ . "/../view/admin_utilisateurs.php";
    }
}

// $admin = new AdminController();
// $action = $_GET['action'] ?? 'produits';
// if (method_exists($admin, $action)) {
//     $admin->$action();
// } else {
//     $admin->produits();
// }
// exit();

?>