<?php

abstract class Model {
    abstract public function getTask($id);

    abstract public function create($category, $description, $status, $deadline);

    abstract public function read();

    abstract public function update($id, $category, $description, $deadline, $status);

    abstract public function delete($id);
}