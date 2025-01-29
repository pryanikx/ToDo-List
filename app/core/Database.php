<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
    }

    protected function __clone() {
    }

    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        
        }
        return self::$instance; 
    }

    public function getConnection($db_config) {
        $servername = $db_config["servername"];
        $username = $db_config["username"];
        $password = $db_config["password"];
        $dbname = $db_config["dbname"];

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Ошибка подключения: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function query(string $sql) {
        $result = $this->conn->query($sql);

        if ($this->conn->error) {
            throw new Exception("Запрос не выполнен: " . $this->conn->error);
        }
        return $result;
    }
}