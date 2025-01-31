<?php

require_once "app/models/Category.php";

class TaskController extends Controller {
    public function __construct($conn) {
        $this->view = new View();
        $this->model = new Task($conn);
        $this->category = new Category($conn);
    }

    
    // TODO: реализовать функции CRUD с классом Category

    public function index() {
        $tasks = $this->model->read();
        $this->view->generate("mainView.php", "indexView.php", $tasks);
    }


    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $category_id = $_POST["category_id"];
            $description = $_POST["description"];
            $status = Status::CREATED;
            $deadline = $_POST["deadline"];

            $this->model->create($category_id, $description, $status, $deadline);

            header("Location: /");
        }

        $this->view->generate("createView.php", "formView.php");
    }

    public function delete($id) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $deleted = $this->model->delete($id);

            if ($deleted) {
                header("Location: /");
                exit;
            } else {
                die("Error while deletion");
            }
        }
    }
}