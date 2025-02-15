<?php
require 'includes/config.php';
require 'includes/Database.php';
require 'includes/Order.php';
require 'includes/Payment.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$order = new Order($db);
$payment = new Payment(PAYTABS_PROFILE_ID, PAYTABS_SERVER_KEY, PAYTABS_ENDPOINT, BASE_URL, $db);

$customerName = $_POST['customerName'] ?? 'Guest';
$customerEmail = $_POST['customerEmail'] ?? 'guest@example.com';
$items = [];

foreach ($_POST['quantity'] as $productId => $quantity) {
    if ($quantity > 0) {
        $product = $db->query("SELECT * FROM products WHERE id = ?", [$productId])->fetch(PDO::FETCH_ASSOC);
        $items[] = [
            'id' => $productId,
            'quantity' => $quantity,
            'price' => $product['price']
        ];
    }
}

$orderId = $order->createOrder($customerName, $customerEmail, $items);
$amount = array_reduce($items, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
$paymentResponse = $payment->initiatePayment($orderId, $amount, $customerName, $customerEmail, $items);

if (isset($paymentResponse['payment_url'])) {
    echo json_encode(['payment_url' => $paymentResponse['payment_url']]);
} else {
    echo json_encode(['error' => $paymentResponse['message'] ?? 'Payment initiation failed.']);
}
?>