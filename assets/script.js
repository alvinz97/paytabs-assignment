document.getElementById('orderForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    const processingText = document.createElement('div');
    processingText.id = 'processing-text';
    processingText.textContent = 'Processing';
    submitButton.insertAdjacentElement('afterend', processingText);

    let dotCount = 0;
    const ellipsisInterval = setInterval(() => {
        dotCount = (dotCount + 1) % 4;
        processingText.textContent = 'Processing' + '.'.repeat(dotCount);
    }, 500);

    const formData = new FormData(this);
    fetch('checkout.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        clearInterval(ellipsisInterval);

        if (data.payment_url) {
            const iframe = document.createElement('iframe');
            iframe.src = data.payment_url;
            iframe.style.width = '100%';
            iframe.style.height = '500px';
            iframe.style.border = 'none';

            const paymentContainer = document.getElementById('payment-container');
            paymentContainer.innerHTML = '';
            paymentContainer.appendChild(iframe);

            processingText.remove();
        } else {
            alert(data.error || 'Payment initiation failed. Please try again.');
            submitButton.disabled = false;
            processingText.remove();
        }
    })
    .catch(error => {
        clearInterval(ellipsisInterval);
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
        submitButton.disabled = false;
        processingText.remove();
    });
});