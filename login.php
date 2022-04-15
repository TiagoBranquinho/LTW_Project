<?php 
    include_once('templates/common.php');
    output_header();
?>
<h1>Login</h1>
<main>
            <form action="action_login.php" method="POST">
            <label><strong>Username:</strong>
                <input type="text" name="username">
            </label>
            <label><strong>Password:</strong>
                <input type="password" name="password">
            </label>
            <input type="checkbox" id="hamburger"> 
            <label class="hamburger" for="hamburger">Forgot your password</label>
            <button type="submit">Login</button>
        </form>
</main>
        <?php output_footer();?>