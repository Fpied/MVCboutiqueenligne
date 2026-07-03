<?php

require_once __DIR__ . "/../model/Utilisateur.php";
require_once __DIR__ . "/../repository/UtilisateurRepository.php";

class UtilisateurController
{
    public function login()
    {
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UtilisateurRepository();
            $user = $userModel->getByEmail($email);

            if ($user && password_verify($password, $user['password_hash'])) {
                if ($user['role'] === 'admin') {
                    $_SESSION['admin'] = true;
                }

                $_SESSION['user_id'] = $user['id'];

                header("Location: index.php");
                exit();
            }

            $error = "Email ou mot de passe incorrect";
        }

        require __DIR__ . "/../view/login.php";
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}