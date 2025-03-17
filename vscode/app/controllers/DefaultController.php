<?php
class DefaultController {
    public function index() {
        // Redirect to product list
        header("Location: index.php?controller=product&action=list");
        exit();
    }
}
?>