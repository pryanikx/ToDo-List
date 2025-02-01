<?php

abstract class ACategory {
    abstract public function getCategory($id);

    abstract public function create($name, $color);

    abstract public function read();

    abstract public function update($id, $name);

    abstract public function delete($id);
}