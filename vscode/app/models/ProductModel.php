<?php
class ProductModel {
    private $conn;
    private $table_name = "product";

    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $category_id;
    public $category_name;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả sản phẩm
    public function getAll() {
        $query = "SELECT p.id, p.name, p.description, p.price, p.category_id, c.name as category_name 
                  FROM " . $this->table_name . " p
                  LEFT JOIN category c ON p.category_id = c.id
                  ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy sản phẩm theo ID
    public function getById() {
        $query = "SELECT p.id, p.name, p.description, p.price, p.category_id, c.name as category_name 
                  FROM " . $this->table_name . " p
                  LEFT JOIN category c ON p.category_id = c.id
                  WHERE p.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
            return true;
        }
        return false;
    }

    // Tạo sản phẩm mới
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET name = :name, description = :description, 
                      price = :price, category_id = :category_id";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Cập nhật sản phẩm
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET name = :name, description = :description, 
                      price = :price, category_id = :category_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Xóa sản phẩm
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>