<?php
declare(strict_types=1);

// session_start() = démarre (ou reprend) la session PHP.
// OBLIGATOIRE avant toute utilisation de $_SESSION.
// À faire TOUT EN HAUT, avant le moindre affichage (sinon erreur "headers already sent").
session_start();

// require_once = inclut un fichier UNE SEULE FOIS.
// Si on le réinclut ailleurs, PHP ignore la 2e inclusion (évite "class already declared").
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/config/Router.php';

// __DIR__ = chemin absolu du dossier de CE fichier.
// On l'utilise pour construire des chemins fiables, peu importe d'où on lance le script.

// Inclusion manuelle des classes (autoloading "à la main").
// En projet réel, on utiliserait Composer et l'autoloading PSR-4.
require_once __DIR__ . '/model/Produit.php';
require_once __DIR__ . '/model/Utilisateur.php';
require_once __DIR__ . '/model/Commande.php';
require_once __DIR__ . '/model/DetailCommande.php';

require_once __DIR__ . '/repository/ProduitRepository.php';
require_once __DIR__ . '/repository/UtilisateurRepository.php';
require_once __DIR__ . '/repository/CommandeRepository.php';
require_once __DIR__ . '/repository/DetailCommandeRepository.php';

require_once __DIR__ . '/controller/ProduitController.php';
require_once __DIR__ . '/controller/UtilisateurController.php';
require_once __DIR__ . '/controller/CommandeController.php';
require_once __DIR__ . '/controller/AdminController.php';

// On crée le routeur et on lui demande d'aiguiller la requête.
$router = new Router();
$router->route();