<?php 
    include_once('templates/common.php');
    output_header();
?>
<h1>Login</h1>
        <form action="action_login.php" method="POST">
            <label>Username/Email:
                <input type="text" name="username">
            </label>
            <label>Password:
                <input type="password" name="password">
            </label>
            <button type="submit">Log in</button>
        </form>
        <?php output_footer();?>