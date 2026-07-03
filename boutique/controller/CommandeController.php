<?php 

require_once __DIR__ ."/../repository/CommandeRepository.php";
require_once __DIR__ ."/../repository/DetailCommandeRepository.php";
require_once __DIR__ ."/../repository/ProduitRepository.php";
require_once __DIR__ ."/../config/Database.php";

class CommandeController
{
    public function historique(){

        if (!isset($_SESSION['user_id'])){
            header('Location: index.php?route=login');
            exit;
        }

        $commandeRepository = new CommandeRepository();
        $user_id = $_SESSION['user_id'];
        $commandes = $commandeRepository->findByUserId($user_id);

        $detailCommandeRepository = new DetailCommandeRepository();

        $detailsParCommande = [];

        foreach ($commandes as $commande) {
            $detailsParCommande[$commande->getId()] =
                $detailCommandeRepository->findDetailsWithProductNameByOrderId($commande->getId());
        }

        require_once __DIR__ . "/../view/historique.php";

        
    }

    public function panier(){

        // session_start();
        $pdo = Database::getConnexion();

        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = [];
        }

        $panier = $_SESSION['panier'];
        $repositoryProduit = new ProduitRepository($pdo);
        $lignes = [];
        $total = 0;
        foreach($panier as $product_id => $quantity){
            $produit = $repositoryProduit->findById($product_id);
            if($produit !== null){
                    $totalLigne = $produit->getPrice() * $quantity;

                    $lignes[] = [
                        'id'=> $product_id,
                    'nom' => $produit->getName(),
                    'quantite' => $quantity,
                    'prix' => $produit->getPrice(),
                    'total_ligne' => $totalLigne
                ];

                $total += $totalLigne;
                

            }
            


        }



        require_once __DIR__ ."/../view/panier.php";


    }

    public function plusPanier()
    {
        $id = $_GET['id'];

        $_SESSION['panier'][$id]++;

        header('Location: index.php?route=panier');
        exit;
    }

    public function moinsPanier()
    {
        $id = $_GET['id'];

        $_SESSION['panier'][$id]--;

        if ($_SESSION['panier'][$id] <= 0) {
            unset($_SESSION['panier'][$id]);
        }

        header('Location: index.php?route=panier');
        exit;
    }

    public function supprimerPanier()
    {
        $id = $_GET['id'];
        unset($_SESSION['panier'][$id]);

        header('Location: index.php?route=panier');
        exit;
    }

    public function viderPanier()
    {
        $_SESSION['panier'] = [];

        header('Location: index.php?route=panier');
        exit;
    }





    public function ajouter(){
        // session_start();

        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = [];

        }

        if(!isset($_POST['id'])){
            header('Location: index.php?page=accueil');
            exit;

        }

        $product_id = $_POST['id'];

        if(array_key_exists($product_id, $_SESSION['panier'])){

            $_SESSION['panier'][$product_id]++;

        } else{
            $_SESSION['panier'][$product_id] = 1;
            
        }

        header('Location: index.php?route=panier');
        exit;



    }

    public function valider(){
        // session_start();

        if (!isset($_SESSION['user_id'])){
            header('Location: index.php?controller=utilisateur&action=login');
            exit;
        }
        
        if(!isset($_SESSION['panier']) || empty($_SESSION['panier'])){
                header('Location: index.php?page=panier');
                exit;

        }

        $panier = $_SESSION['panier'];

        $total = 0;

        $pdo = Database::getConnexion();
        $produitRepository = new ProduitRepository($pdo);

        foreach($panier as $product_id => $quantity){
            $produit = $produitRepository->findById($product_id);

            if($produit !== null){
                $total += $produit->getPrice() * $quantity;
                
            }
        }
        $commandeRepository = new CommandeRepository();
        $user_id = $_SESSION['user_id'];
        $created_at = date('Y-m-d H:i:s');
        $order_id = $commandeRepository->createOrder($user_id, $created_at, $total);

        if($order_id === false){
            header('Location: index.php?page=panier');
            exit;
        }

        $detailCommandeRepository = new DetailCommandeRepository();

        foreach($panier as $product_id => $quantity){
            $produit = $produitRepository->findById($product_id);
            if($produit !== null){
                $detailCommandeRepository->create(
                    $order_id,
                    $product_id,
                    $quantity,
                    $produit->getPrice()

                );
            }
            
            
        }

        $_SESSION['panier'] = [];

        header('Location: index.php?route=historique');
        exit;

        

        
        
            

        



    }
}