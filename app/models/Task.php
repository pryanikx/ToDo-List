<?php

class Task extends Model {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTask($id) {}
    public function create($category, $description, $status, $deadline) {
        $sql = "INSERT INTO tasks (category, description, status, deadline)
        VALUES ('$category', '$description', '$status' , '$deadline')";

        $result = Database::getInstance()->query($sql);
    }

    public function read() {
        $sql = "SELECT * FROM tasks";
        $tasks = Database::getInstance()->query($sql);

        return $tasks;
    }

    public function update($id, $category, $description, $deadline, $status) {}

    public function delete($id) {}
    
}