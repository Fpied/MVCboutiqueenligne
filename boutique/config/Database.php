<?php

class Database{
    private static ?PDO $instance = null;

    public static function getConnexion() : PDO{
        if(self::$instance === null){
            self::$instance = new PDO(
                'mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8mb4',
                'root',
                '',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$instance;
    }
}