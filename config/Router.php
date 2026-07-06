<?php

declare(strict_types=1);

class Router
{
    public function route(): void
    {
        // $_GET = tableau des paramètres passés dans l'URL (après le ?).
        // ?? 'accueil' = opérateur "null coalescent" : si 'route' n'existe pas, on utilise 'accueil'.
        $route = $_GET['route'] ?? 'accueil';

        // On aiguille selon la valeur de $route.
        // match = version moderne du switch (PHP 8+), plus stricte et concise.
        match ($route) {
            // 'accueil' => on crée le contrôleur et on appelle sa méthode index().
            'accueil' => (new ProduitController(new ProduitRepository(Database::getConnexion())))->index(),
            'login'          => (new UtilisateurController())->login(),
            'logout'         => (new UtilisateurController())->logout(),
            'panier'         => (new CommandeController())->panier(),
            'ajout-panier'   => (new CommandeController())->ajouter(),
            'valider'        => (new CommandeController())->valider(),
            'historique'     => (new CommandeController())->historique(),
            'plus-panier'   => (new CommandeController())->plusPanier(),
            'moins-panier'  => (new CommandeController())->moinsPanier(),
            'supprimer-panier' => (new CommandeController())->supprimerPanier(),
            'vider-panier' => (new CommandeController())->viderPanier(),
            'admin'          => (new AdminController())->produits(),
            'ajouterProduit' => (new AdminController())->ajouterProduit(),
            'modifierProduit' => (new AdminController())->modifierProduit(),
            'supprimerProduit' => (new AdminController())->supprimerProduit(),

            // default = cas par défaut si aucune route ne correspond → page 404.
            default          => $this->notFound(),
        };
    }

    // Méthode privée : gère le cas "route inconnue".
    private function notFound(): void
    {
        // http_response_code = définit le code HTTP renvoyé (404 = page non trouvée).
        http_response_code(404);
        echo '404 - Page non trouvée';
    }
}
