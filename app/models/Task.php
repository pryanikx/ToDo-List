<?php

class Task extends ATask {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTask($id) {
        $sql = "SELECT 
        tasks.id, tasks.description, tasks.deadline, tasks.completed_at, tasks.created_at, categories.name, categories.color, tasks.status 
        FROM tasks
        INNER JOIN categories ON tasks.category_id = categories.id
        WHERE tasks.id = $id";

        $tasks = Database::getInstance()->query($sql);

        return $tasks[0];
    }
    public function create($category_id, $description, $status, $deadline) {
        $sql = "INSERT INTO tasks (category_id, description, status, deadline)
        VALUES ('$category_id', '$description', '$status' , '$deadline')";

        $result = Database::getInstance()->query($sql);
    }

    public function read($completed = null, $time_filter = null, $category_filter = null, $overdue = null, $sort = null, $order = null) {
        $sql = "SELECT 
        tasks.id, tasks.description, tasks.deadline, tasks.completed_at, tasks.created_at, categories.name, categories.color, tasks.status 
        FROM tasks
        INNER JOIN categories ON tasks.category_id = categories.id";

        if ($completed) {
            $sql .= " WHERE tasks.status = 'Completed' OR tasks.status = 'Completed after deadline'"; 
        } else {
            $sql .= " WHERE tasks.status ='Awaiting'";
        }

        // Фильтры
        if ($time_filter) {
            if ($time_filter == "today") 
                $sql .= " AND tasks.created_at >= CURDATE() AND tasks.created_at < CURDATE() + INTERVAL 1 DAY";
            elseif ($time_filter == "this_week")
                $sql .= " AND YEARWEEK(tasks.created_at, 1) = YEARWEEK(CURDATE(), 1)";
            elseif ($time_filter == "this_month")
                $sql .= " AND YEAR(tasks.created_at) = YEAR(CURDATE()) AND MONTH(tasks.created_at) = MONTH(CURDATE())";
        }
        if ($category_filter) {
            $sql .= " AND categories.name = '$category_filter'";
        }
        if ($overdue === "overdue") {
            $sql .= " AND tasks.deadline <= NOW()";
        }

        // Сортировки
        $allowedSortColumns = ["created_at", "deadline"];
        if (in_array($sort, $allowedSortColumns)) {
            $order = ($order === "DESC") ? "DESC" : "ASC";
            $sql .= " ORDER BY $sort $order";
        }        

        $tasks = Database::getInstance()->query($sql);

        return $tasks;
    }

    public function update($id, $category_id, $description, $deadline) {
        $sql = "UPDATE tasks
        SET category_id = $category_id, description = '$description', deadline = '$deadline'
        WHERE id = $id";

        $tasks = Database::getInstance()->query($sql);
    }

    public function changeStatus($id) {
        $task = $this->getTask($id);
        $status = $task["status"];
        $completed = false;

        if ($status === Status::COMPLETED->value || $status === Status::COMPLETED_AFTER_DEADLINE->value) {
            $status = Status::AWAITING->value;
        } elseif (strtotime($task["deadline"]) < (time() + (3*3600)))  {
            $status = Status::COMPLETED_AFTER_DEADLINE->value;
            $completed = true;
        } else {
            $status = Status::COMPLETED->value;
            $completed = true;
        }


        $sql = "UPDATE tasks
        SET status = '$status'";
        $sql .= $completed ? ", completed_at = NOW()" : ", completed_at = NULL";
        $sql .= " WHERE id = $id";

        $changedStatus = Database::getInstance()->query($sql);

        return $changedStatus;
    }

    public function delete($id) {
        $sql = "DELETE FROM tasks WHERE id = $id";

        $deleted = Database::getInstance()->query($sql);
        
        return $deleted;
    }
    
}