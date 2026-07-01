<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Commande.php';

class CommandeRepository{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo= Database::getConnexion();
    }
}