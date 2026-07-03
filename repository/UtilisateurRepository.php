<?php
require_once __DIR__ . "/../model/Utilisateur.php";

class UtilisateurRepository
{
    private $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT id, email, password_hash, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmail(string $email): ?Utilisateur
    {
        $stmt = $this->db->prepare("SELECT id, email, password_hash, role FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userRow) {
            return null;
        }

        return new Utilisateur(
            (int)$userRow['id'],
            (int)$userRow['name'],
            $userRow['email'],
            $userRow['password_hash'],
            $userRow['role']
        );
    }

    public function create($email, $password_hash)
    {
        $stmt = $this->db->prepare("INSERT INTO users (email, password_hash, role) VALUES (:email, :password_hash, 'client' )");
        return $stmt->execute(['email' => $email,
        'password_hash' => $password_hash]);
    }
}