<?php

require_once 'app.php';


class DB
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    public $pdo = null;

    public function con()
    {
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try {
            $this->pdo = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password, $options);
        } catch (PDOException $e) {
            http_response_code(500);
            (json_encode($e->getMessage()));
        }
        return $this->pdo;
    }
}