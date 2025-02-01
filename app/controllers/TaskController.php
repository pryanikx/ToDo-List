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

    public function formValidate($post) {
        $category_id = isset($post["category"]) ? (int)$post["category"] : null;
        $new_category = trim($post["new_category"]);

        if ($category_id) {
            if ($new_category) {
                die("Указаны две категории");
            }
            return $category_id;
        } elseif($new_category) {
            $this->category->create($new_category);
            $category = $this->category->getCategory($new_category, false);
            return $category[0]['id'];
        }
    }


    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $category_id = $this->formValidate(["category" => $_POST["category"], "new_category" => $_POST["new_category"]]);
            $description = $_POST["description"];
            $status = Status::AWAITING->value;
            $deadline = $_POST["deadline"];

            $this->model->create($category_id, $description, $status, $deadline);

            header("Location: /");
        }

        $categories = $this->category->read();

        $this->view->generate("createView.php", "formView.php", $categories);
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