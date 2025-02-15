<?php
require 'includes/config.php';
require 'includes/Database.php';
require 'includes/Payment.php';

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$payment = new Payment(PAYTABS_PROFILE_ID, PAYTABS_SERVER_KEY, PAYTABS_ENDPOINT, BASE_URL, $db);

$payments = $payment->getAllPayments();

include 'components/header.php';
include 'components/nav.php';
include 'components/payment_list.php';
include 'components/footer.php';
?>