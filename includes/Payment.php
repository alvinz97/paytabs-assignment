<?php
class Payment
{
    private $profileId;
    private $serverKey;
    private $endpoint;
    private $baseUrl;
    private $db;

    public function __construct(
        string $profileId,
        string $serverKey,
        string $endpoint,
        string $baseUrl,
        Database $db
    ) {
        $this->profileId = $profileId;
        $this->serverKey = $serverKey;
        $this->endpoint = $endpoint;
        $this->baseUrl = $baseUrl;
        $this->db = $db;
    }

    public function initiatePayment($orderId, $amount, $customerName, $customerEmail, $items)
    {
        $cartDescription = "Order #$orderId with " . count($items) . " items";

        $data = [
            'profile_id' => $this->profileId,
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_id' => $orderId,
            'cart_amount' => $amount,
            'cart_currency' => 'EGP',
            'cart_description' => $cartDescription,
            'customer_details' => [
                'name' => $customerName,
                'email' => $customerEmail,
            ],
            'hide_shipping' => true,
            'return_url' => $this->baseUrl . '/success.php',
        ];

        $ch = curl_init($this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: ' . $this->serverKey]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getAllPayments()
    {
        return $this->db->query("SELECT * FROM payments")->fetchAll(PDO::FETCH_ASSOC);
    }
}
