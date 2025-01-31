<?php

abstract class ATask {
    abstract public function getTask($id);

    abstract public function create($category_id, $description, $status, $deadline);

    abstract public function read();

    abstract public function update($id, $category_id, $description, $deadline, $status);

    abstract public function delete($id);
}