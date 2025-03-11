<?php

class DbConn{
    protected $pdo;
    public function __construct(){
        //$server = 'localhost';
        //$username = 'root';
        //$password = '';
        //$database = 'grupoas1';
        try {
            $this->pdo = new \PDO("mysql:host=localhost;dbname=inmobiliaria;charset=utf8mb4", "root","8988", [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_EMULATE_PREPARES => false
            ]);
            
        } catch (PDOException $e) {
            die('La conexión fallo: '.$e->getMessage());
        }
    }
    
           // Método para obtener el objeto PDO
    public function getPdo() {
        return $this->pdo;
    }
}

$db = new DbConn();
$pdo = $db->getPdo();