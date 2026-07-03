<?php

require_once __DIR__ . "/../model/Utilisateur.php";
require_once __DIR__ . "/../repository/UtilisateurRepository.php";

class UtilisateurController
{
    private UtilisateurRepository $repo;

    public function __construct()
    {
        $this->repo = new UtilisateurRepository();
    }

    public function login()
    {
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->repo->getByEmail($email);

            if ($user && password_verify($password, $user->password_hash)) {


                if ($user->role === 'admin') {
                    $_SESSION['admin'] = true;
                }

                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;
                $_SESSION['user_email'] = $user->email;

                header("Location: index.php");
                exit();
            }
            $error = "Email Ou Mot de pass Incorrect !";
        }
        require_once __DIR__ . "/../view/login.php";
    }


    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
