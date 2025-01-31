<?php

class TaskController extends Controller {
    public function __construct($conn) {
        $this->view = new View();
        $this->model = new Task($conn);
    }

    public function index() {
        $tasks = $this->model->read();
        $this->view->generate("mainView.php", "indexView.php", $tasks);
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $category = $_POST["category"];
            $description = $_POST["description"];
            $status = "Awaiting";
            $deadline = $_POST["deadline"];

            $this->model->create($category, $description, $status, $deadline);

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