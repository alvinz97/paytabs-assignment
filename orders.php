<?php
require 'includes/config.php';
require 'includes/Database.php';
require 'includes/Order.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$order = new Order($db);
$orders = $order->getAllOrders();

include 'components/header.php';
include 'components/nav.php';
include 'components/order_list.php';
include 'components/footer.php';
?>