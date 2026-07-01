<?php
class Router{

    public function run(){

        // 1. Récupération des paramètre URL
        $controller = $_GET['controller'] ?? 'user';
        $action = $_GET['action'] ?? 'index';

        // 2. nom du contrôleur
        $controllerName = ucfirst($controller) . "Controller";

        // 3. Chemin du fichier
        $controllerFile = "../controller/" . $controllerName . ".php";

        // 4. Vérifier si le fichier existe
        if(!file_exists($controllerFile)){
            die("Contrôleur introuvable");

        }

        require_once $controllerFile;

        // 5. Instanciation
        $controllerObject = new $controllerName();

        // 6. Vérifier si la méthode existe
        if(!method_exists($controllerObject, $action)){
            die("Action inexistante");
        }

        // 7. Appel de la méthode
        $controllerObject->$action();
    }
}