<?php 
    include_once('templates/common.tpl.php');
    output_header();
?>
<main>
    <form class="payment" action="action_payment.php" method="GET">
        <h1>Payment Method</h1>
        <h3>Credit Card</h3>
        <label class="switch">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>
        <label class="hidden"><strong>Titular name:</strong>
            <input type="text" name="titular" id="aa">
        </label>
        <label class="hidden"><strong>Card number:</strong>
            <input type="text" name="number">
        </label>
        <label class="hidden"><strong>Expiry Date:</strong>
            <input type="date" name="date">
        </label>
        <label class="hidden"><strong>CVC:</strong>
            <input type="password" name="cvc">
        </label>
        <input type="hidden" name = "card" value="false">
        <button type="submit">Pay with Money</button>
    </form>
</main>
<?php output_footer();?>