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

    public function create($name, $color) {
        $sql = "INSERT INTO categories (name, color) VALUES ('$name', '$color')";

        $categories = Database::getInstance()->query($sql);
    }

    public function update($id, $name, $color) {
        $sql = "UPDATE categories 
        SET name = '$name', color = '$color'
        WHERE id = $id";

        $categories = Database::getInstance()->query($sql);
        }

    public function delete($id) {}
}