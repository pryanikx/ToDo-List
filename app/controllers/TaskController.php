<?php

class TaskController extends Controller {
    public function __construct($conn) {
        $this->view = new View();
        $this->model = new Task($conn);
    }

    public function index() {
        $tasks = $this->model->read();
        $this->view->generate("mainView.php", "templateView.php", $tasks);
    }
}