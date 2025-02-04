<?php

abstract class ATask {
    abstract public function getTask($id);

    abstract public function create($category_id, $description, $status, $deadline);

    abstract public function read($time_filter, $category_filter, $overdue, $sort, $order);

    abstract public function update($id, $category_id, $description, $deadline);

    abstract public function changeStatus($id);

    abstract public function delete($id);
}