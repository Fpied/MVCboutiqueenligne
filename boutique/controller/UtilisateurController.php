<?php

require_once __DIR__ . "/../model/Utilisateur.php";
require_once __DIR__ . "/../repository/UtilisateurRepository.php";

class UtilisateurController
{
    private UtilisateurRepository $repository;

    public function __contrct(PDO $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];


            $userModel = new Utilisateur();

            $userModel = new UtilisateurRepository();

            $user = $userModel->getByEmail($email);

            if ($user && password_verify($password, $user['password_hash'])) {
                if ($user['role'] === 'admin') {
                    $_SESSION['admin'] = true;
                }
                $_SESSION['user'] = $user['id'];
                header("Location: index.php");
                exit();
            }
        }

        require __DIR__ . "/../view/login.php";
    }
}
?>