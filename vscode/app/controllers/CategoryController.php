<?php
require_once 'vscode/app/models/CategoryModel.php';
require_once 'vscode/app/config/database.php';

class CategoryController {
    private $db;
    private $category;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->category = new CategoryModel($this->db);
    }

    public function list() {
        $stmt = $this->category->getAll();
        require_once 'vscode/app/views/category/list.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->category->name = $_POST['name'];
            $this->category->description = $_POST['description'];
            
            if ($this->category->create()) {
                header("Location: index.php?controller=category&action=list");
                exit();
            }
        }
        require_once 'vscode/app/views/category/add.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=category&action=list");
            exit();
        }

        $this->category->id = $_GET['id'];
        $this->category->getById();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->category->name = $_POST['name'];
            $this->category->description = $_POST['description'];
            
            if ($this->category->update()) {
                header("Location: index.php?controller=category&action=list");
                exit();
            }
        }
        require_once 'vscode/app/views/category/edit.php';
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=category&action=list");
            exit();
        }

        $this->category->id = $_GET['id'];
        if ($this->category->delete()) {
            header("Location: index.php?controller=category&action=list");
            exit();
        }
    }
}
?>