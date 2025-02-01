<?php

class Task extends ATask {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTask($id) {}
    public function create($category_id, $description, $status, $deadline) {
        $sql = "INSERT INTO tasks (category_id, description, status, deadline)
        VALUES ('$category_id', '$description', '$status' , '$deadline')";

        $result = Database::getInstance()->query($sql);
    }

    public function read() {
        $sql = "SELECT 
        tasks.id, tasks.description, tasks.deadline, tasks.completed_at, tasks.created_at, categories.name, categories.color, tasks.status 
        FROM tasks
        INNER JOIN categories ON tasks.category_id = categories.id";
        $tasks = Database::getInstance()->query($sql);

        return $tasks;
    }

    public function update($id, $category_id, $description, $deadline, $status) {}

    public function delete($id) {
        $sql = "DELETE FROM tasks WHERE id = $id";

        $deleted = Database::getInstance()->query($sql);
        
        return $deleted;
    }
    
}