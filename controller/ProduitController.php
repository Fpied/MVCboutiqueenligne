<?php
//
class ProduitController { // création d'un classe pour la gestion des produits
    private ProduitRepository $repository;

    public function __construct(ProduitRepository $repository)//récupération des données
    {
        $this->repository = $repository;
    }
    public function index(): void {// on récupère les produits et on envoie à "view"
        $produits = $this->repository->findAll();
        require "view/accueil.php";
    }
}






?>