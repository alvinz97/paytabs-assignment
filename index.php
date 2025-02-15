<?php
require 'includes/config.php';
require 'includes/Database.php';
require 'includes/Product.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$product = new Product($db);
$products = $product->getAllProducts();

include 'components/header.php';
include 'components/nav.php';
include 'components/product_list.php';
include 'components/footer.php';
?>