<?php
require_once 'vscode/app/models/ProductModel.php';
require_once 'vscode/app/models/CategoryModel.php';
require_once 'vscode/app/config/database.php';

class ProductController {
    private $db;
    private $product;
    private $category;

    public function __construct() {
      
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new ProductModel($this->db);
        $this->category = new CategoryModel($this->db);
    }

    public function list() {
        $stmt = $this->product->getAll();
        require_once 'vscode/app/views/product/list.php';
    }

    public function add() {
        $categories = $this->category->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->product->name = $_POST['name'];
            $this->product->description = $_POST['description'];
            $this->product->price = $_POST['price'];
            $this->product->category_id = $_POST['category_id'];
            
            if ($this->product->create()) {
                header("Location: index.php?controller=product&action=list");
                exit();
            }
        }
        require_once 'vscode/app/views/product/add.php';
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=product&action=list");
            exit();
        }

        $categories = $this->category->getAll();
        $this->product->id = $_GET['id'];
        $this->product->getById();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->product->name = $_POST['name'];
            $this->product->description = $_POST['description'];
            $this->product->price = $_POST['price'];
            $this->product->category_id = $_POST['category_id'];
            
            if ($this->product->update()) {
                header("Location: index.php?controller=product&action=list");
                exit();
            }
        }
        require_once 'vscode/app/views/product/edit.php';
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=product&action=list");
            exit();
        }

        $this->product->id = $_GET['id'];
        if ($this->product->delete()) {
            header("Location: index.php?controller=product&action=list");
            exit();
        }
    }

    public function show() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=product&action=list");
            exit();
        }

        $this->product->id = $_GET['id'];
        $this->product->getById();
        require_once 'vscode/app/views/product/show.php';
    }
}
?>