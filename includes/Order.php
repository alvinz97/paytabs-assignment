<?php
class Order {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function createOrder($customerName, $customerEmail, $items) {
        $totalAmount = array_reduce($items, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);

        $this->db->query(
            "INSERT INTO orders (customer_name, customer_email, total_amount) VALUES (?, ?, ?)",
            [$customerName, $customerEmail, $totalAmount]
        );

        $orderId = $this->db->getLastInsertId();

        foreach ($items as $item) {
            $this->db->query(
                "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)",
                [$orderId, $item['id'], $item['quantity'], $item['price']]
            );
        }

        return $orderId;
    }

    public function getAllOrders() {
        return $this->db->query("SELECT * FROM orders ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($orderId) {
        $order = $this->db->query("SELECT * FROM orders WHERE id = ?", [$orderId])->fetch(PDO::FETCH_ASSOC);
        $orderItems = $this->db->query("
            SELECT oi.*, p.name AS product_name 
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
        ", [$orderId])->fetchAll(PDO::FETCH_ASSOC);

        return ['order' => $order, 'items' => $orderItems];
    }
}
?>