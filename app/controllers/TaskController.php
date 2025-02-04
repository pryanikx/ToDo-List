<?php

require_once "app/models/Category.php";

class TaskController extends Controller {
    public function __construct($conn) {
        $this->view = new View();
        $this->model = new Task($conn);
        $this->category = new Category($conn);
    }

    public function index() {
        /* $filter = $_GET["filter"] ?? null;
        $sort =  $_GET["sort"] ?? null; */
        $tasks = $this->model->read();

        $this->view->generate("mainView.php", "tasksListView.php", $tasks);
    }

    public function formValidate($post) {
        $category_id = isset($post["category"]) ? (int)$post["category"] : null;
        $new_category = trim($post["new_category"]);
        $new_category_color = trim($post["new_category_color"]);

        if ($category_id) {
            if ($new_category) {
                die("Указаны две категории");
            }
            return $category_id;
        } elseif($new_category) {
            $this->category->create($new_category, $new_category_color);
            $category = $this->category->getCategory($new_category, false);
            return $category[0]['id'];
        }
    }


    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $post_category = [
                "category" => $_POST["category"],
                "new_category" => $_POST["new_category"],
                "new_category_color" => $_POST["new_category_color"]];
            $category_id = $this->formValidate($post_category);
            $description = $_POST["description"];
            $status = Status::AWAITING->value;
            $deadline = $_POST["deadline"];

            $this->model->create($category_id, $description, $status, $deadline);

            header("Location: /");
        }

        $categories = $this->category->read();

        $this->view->generate("createView.php", "formView.php", $categories);
    }

    public function update($id) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $post_category = [
                "category" => $_POST["category"],
                "new_category" => $_POST["new_category"],
                "new_category_color" => $_POST["new_category_color"]];
            $category_id = $this->formValidate($post_category);
            $description = $_POST["description"];
            $deadline = $_POST["deadline"];

            $this->model->update($id, $category_id, $description, $deadline);

            header("Location: /");
        }

        $task = $this->model->getTask($id);
        $categories = $this->category->read();
        $data = ["task" => $task, "categories" => $categories]; 

        $this->view->generate("updateView.php", "formView.php", $data);
    }

    public function changeStatus($id) {
            $changedStatus = $this->model->changeStatus($id);

            if ($changedStatus) {
                header("Location: /");
                exit;
            } else {
                die("Eror while changing status");
            }
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