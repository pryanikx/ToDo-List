<?php

abstract class Controller {
    public $model;
    public $view;

    public function __construct() {
        $this->view = new View();
    }

    abstract public function index();
}