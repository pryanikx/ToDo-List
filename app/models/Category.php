<?php

class Category extends ACategory {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCategory($id) {}

    public function read() {
        $sql = "SELECT * FROM categories";

        $categories = Database::getInstance()->query($sql);
    }

    public function create($name) {
        $sql = "INSERT INTO categories (name) VALUES ($name)";

        $categories = Database::getInstance()->query($sql);
    }

    public function update($id, $name) {}

    public function delete($id) {}
}