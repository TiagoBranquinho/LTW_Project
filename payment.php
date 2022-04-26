<?php 
    include_once('templates/common.tpl.php');
    output_header();
?>
<main>
    <form class="payment" action="action_payment.php" method="POST">
        <h2>Payment Method</h2>
        <div>
        <h3>Credit Card</h3>
        <label class="switch">
            <input type="checkbox">
             <span class="slider round"></span>
        </label>
        </div>
        <div>
        <label><strong>Titular name:</strong>
            <input type="text" name="titular">
        </label>
        <label id="aa"><strong>Card number:</strong>
            <input type="text" name="number">
        </label>
        </div>
        <div>
        <label id="ab"><strong>Expiry Date:</strong>
            <input type="date" name="date">
        </label>
        <label><strong>CVC:</strong>
            <input type="password" name="cvc">
        </label>
        </div>
        <button type="submit">Login</button>
    </form>
</main>
<?php output_footer();?>