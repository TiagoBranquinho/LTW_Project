<?php 
    include_once('templates/common.tpl.php');
    output_header();
?>
<main>
    <form class="payment" action="action_payment.php" method="POST">
        <h2>Payment Method</h2>
        <h3>Monetary<small> (default)</small></h3>
        <input type="checkbox" name="payment" value="money" checked>
        <h3>Credit Card</h3>
        <input type="checkbox" name="payment" value="card">
        <label><strong>Titular name:</strong>
            <input type="text" name="titular">
        </label>
        <label><strong>Card number:</strong>
            <input type="text" name="number">
        </label>
        <label><strong>Expiry Date:</strong>
            <input type="date" name="date">
        </label>
        <label><strong>CVC:</strong>
            <input type="password" name="cvc">
        </label>
        <button type="submit">Pay with</button>
    </form>
</main>
<?php output_footer();?>