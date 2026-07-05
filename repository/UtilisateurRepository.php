<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../model/Utilisateur.php";

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

    public function getByEmail(string $email): ?Utilisateur
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userRow) {
            return null;
        }

        return new Utilisateur(
            (int)$userRow['id'],
            $userRow['name'],
            $userRow['email'],
            $userRow['password_hash'],
            $userRow['role']
        );
    }


    public function create(string $name, string $email, string $password_hash): bool
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password_hash)
        VALUES (:name, :email, :password_hash)");

        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password_hash' => $password_hash
        ]);
    }
}
?>