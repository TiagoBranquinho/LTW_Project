<?php 
    session_start();
    include_once('templates/common.tpl.php');
    output_header();
?>
<main>
    <h1>Registration</h1>
    <a href="payment.php"><h1>PAYMENT METHOD</h1></a>
    <form class="register" action="action_register.php" method="POST">
        <input type="text" name="username" placeholder="username" pattern="^[A-Za-z][A-Za-z0-9_]{2,}$" title="Minimum 3 characters, start with an alphabet and all other characters can be alphabets, numbers or an underscore">
        <input type="password" name="password" placeholder="password" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" title="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number">
        <input type="email" name="email" placeholder="email">
        <input type="text" name="address" placeholder="address">
        <input type="text" name="phoneNumber" placeholder="phone number">
        <input type="checkbox" id="option1" name="restOwner" value=1>
        <label for="option1">Restaurant Owner</label>
        <input type="checkbox" id="option2" name="costumer" value=1>
        <label for="option2">Costumer</label>
        <button type="submit">Register</button>
    </form>
</main>
<?php output_footer();?>