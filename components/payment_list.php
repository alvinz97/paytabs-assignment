<div class="container">
    <h1>Payments</h1>

    <table>
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Order ID</th>
                <th>Payment Request</th>
                <th>Payment Response</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?= htmlspecialchars($payment['id']) ?></td>
                    <td><?= htmlspecialchars($payment['order_id']) ?></td>
                    <td><?= htmlspecialchars(substr($payment['payment_request'], 0, 50)) ?>...</td>
                    <td><?= htmlspecialchars(substr($payment['payment_response'], 0, 50)) ?>...</td>
                    <td><?= htmlspecialchars($payment['created_at']) ?></td>
                    <td>
                        <a href="order_details.php?id=<?= $payment['order_id'] ?>" class="action-button">
                            View Details
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>