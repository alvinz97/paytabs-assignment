<div class="container">
    <h1>Order Details</h1>
    <?php if ($orderDetails && isset($orderDetails['order'])): ?>
        <h2>Order Information</h2>
        <p><strong>Order ID:</strong> <?= htmlspecialchars($orderDetails['order']['id']) ?></p>
        <p><strong>Customer Name:</strong> <?= htmlspecialchars($orderDetails['order']['customer_name']) ?></p>
        <p><strong>Customer Email:</strong> <?= htmlspecialchars($orderDetails['order']['customer_email']) ?></p>
        <p><strong>Total Amount:</strong> $<?= htmlspecialchars($orderDetails['order']['total_amount']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($orderDetails['order']['status']) ?></p>
        <p><strong>Created At:</strong> <?= htmlspecialchars($orderDetails['order']['created_at']) ?></p>

        <h2>Order Items</h2>
        <?php if (!empty($orderDetails['items'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderDetails['items'] as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td>$<?= htmlspecialchars($item['price']) ?></td>
                            <td>$<?= htmlspecialchars($item['quantity'] * $item['price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No items found for this order.</p>
        <?php endif; ?>

        <h2>Payment Details</h2>
        <?php if (!empty($payments)): ?>
            <?php foreach ($payments as $payment): ?>
                <p><strong>Payment Request:</strong> <?= htmlspecialchars($payment['payment_request']) ?></p>
                <p><strong>Payment Response:</strong> <?= htmlspecialchars($payment['payment_response']) ?></p>
                <p><strong>Created At:</strong> <?= htmlspecialchars($payment['created_at']) ?></p>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No payment details found.</p>
        <?php endif; ?>

        <h2>Refund Details</h2>
        <?php if (!empty($refunds)): ?>
            <?php foreach ($refunds as $refund): ?>
                <p><strong>Refund Request:</strong> <?= htmlspecialchars($refund['refund_request']) ?></p>
                <p><strong>Refund Response:</strong> <?= htmlspecialchars($refund['refund_response']) ?></p>
                <p><strong>Created At:</strong> <?= htmlspecialchars($refund['created_at']) ?></p>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No refund details found.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Order not found.</p>
    <?php endif; ?>
</div>