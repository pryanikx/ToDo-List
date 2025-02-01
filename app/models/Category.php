<?php

class Category extends ACategory {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCategory($value, $id = true) {

        if ($id) {
            $sql = "SELECT * FROM categories WHERE id = $value";
        } else {
            $sql = "SELECT * FROM categories WHERE name = '$value'";
        }

        $category = Database::getInstance()->query($sql);

        return $category;
    }

    public function read() {
        $sql = "SELECT * FROM categories";

        $categories = Database::getInstance()->query($sql);

        return $categories;
    }

    public function create($name) {
        $sql = "INSERT INTO categories (name) VALUES ('$name')";

        $categories = Database::getInstance()->query($sql);
    }

    public function update($id, $name) {}

    public function delete($id) {}
}