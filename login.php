<?php 
    session_start();
    include_once('templates/common.tpl.php');
    output_header();
?>
<main>
<h1>Login</h1>

            <form class="login" action="action_login.php" method="POST">
            <label><strong>Username:</strong>
                <input type="text" name="username" placeholder="username">
            </label>
            <label><strong>Password:</strong>
                <input type="password" name="password" placeholder="password">
            </label>
            <h5>Forgotten your password? Click <a>here</a> </h5>
            <button type="submit">Login</button>
        </form>
        <h5> Dont have an account yet? Create one <a href = "register.php">here</a></h5>
</main>

<?php output_footer();?>