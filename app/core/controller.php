<?php
abstract class Controller {

    protected $category;
    protected $model;
    protected $view;

    public function __construct() {
        $this->view = new View();
    }

    abstract public function index();
}