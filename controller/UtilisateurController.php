<?php
require_once __DIR__ . "/../model/Utilisateur.php";
require_once __DIR__ . "/../repository/UtilisateurRepository.php";

class UtilisateurController
{
    private UtilisateurRepository $repository;

    public function __contrct(PDO $pdo)
    {
        $this->repository = new UtilisateurRepository($pdo);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function login()
    {
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->repository->getByEmail($email);


            if ($user && password_verify($password, $user->getPassword_hash())) {

                if ($user->getRole() === 'admin') {
                    $_SESSION['admin'] = true;
                }

                $_SESSION['user'] = $user->getId();
                header("Location: index.php");
                exit();
            }
            require __DIR__ . "/../view/login.php";
        }
    }
    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}

?>
