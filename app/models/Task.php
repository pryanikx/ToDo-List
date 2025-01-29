<?php

class Task extends Model {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTask($id) {}
    public function create($category, $description, $deadline) {}

    public function read() {
        // TODO: create tables in the database
        $sql = "SELECT * FROM tasks";
        $tasks = Database::getInstance()->query($sql);

        return $tasks;
    }

    public function update($id, $category, $description, $deadline, $status) {}

    public function delete($id) {}
    
}