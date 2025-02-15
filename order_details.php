<?php
require 'includes/config.php';
require 'includes/Database.php';
require 'includes/Order.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$order = new Order($db);

$orderId = $_GET['id'] ?? null;
$orderDetails = $orderId ? $order->getOrderDetails($orderId) : null;

include 'components/header.php';
include 'components/nav.php';
include 'components/order_details.php';
include 'components/footer.php';
?>