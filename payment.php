<?php 
    include_once('templates/common.tpl.php');
    output_header();
?>
<main>
    <form class="payment" action="action_payment.php" method="POST">
        <h2>Payment Method</h2>
        <ul>
            <li><input type="radio" name="type" value="card" checked="checked">Cartão de Crédito</li>
            <li><input type="radio" name="type" value="money" checked="checked">Monetário</li>
        </ul>
        <label><strong>Username:</strong>
                    <input type="text" name="username">
                </label>
                <label><strong>Password:</strong>
                    <input type="password" name="password">
                </label>
                <h5>Forgotten your password? Click <a>here</a> </h5>
                <button type="submit">Login</button>
    </form>
</main>
<?php output_footer();?>