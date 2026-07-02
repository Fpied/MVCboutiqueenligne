<?php
require_once __DIR__ . "/../config/Database.php";

class UtilisateurRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnexion();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($email, $password_hash)
    {
        $stmt = $this->db->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
        return $stmt->execute([$email, $password_hash]);
    }
}