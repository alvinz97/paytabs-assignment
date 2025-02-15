<?php
class Product {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllProducts() {
        return $this->db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        return $this->db->query("SELECT * FROM products WHERE id = ?", [$id])->fetch(PDO::FETCH_ASSOC);
    }
}
?>