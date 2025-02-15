<div class="container">
    <h1>Products</h1>

    <form id="orderForm">
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <label><?= htmlspecialchars($product['name']) ?> - $<?= htmlspecialchars($product['price']) ?></label>
                    <input type="number" name="quantity[<?= $product['id'] ?>]" min="1" value="1">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="customer-info">
            <h2>Customer Information</h2>
            <label for="customerName">Name:</label>
            <input type="text" name="customerName" required>

            <label for="customerEmail">Email:</label>
            <input type="email" name="customerEmail" required>
        </div>

        <div class="shipping-options">
            <h2>Shipping/Pickup Options</h2>
            <label>
                <input type="radio" name="pickupOption" value="ship" checked> Ship to Address
            </label>
            <label>
                <input type="radio" name="pickupOption" value="pickup"> Pickup
            </label>

            <label for="shippingAddress">Shipping Address (if applicable):</label>
            <textarea name="shippingAddress"></textarea>
        </div>

        <button type="submit">Proceed to Checkout</button>
    </form>

    <div id="payment-container"></div>
</div>