<?php function output_login_form(){ ;?>
    <main>
        <h1>Login</h1>
            <form class="login" action="action_login.php" method="POST">
            <label for="username"><strong>Username:</strong>
                <input type="text" name="username" placeholder="username">
            </label>
            <label for="password"><strong>Password:</strong>
                <input type="password" name="password" placeholder="password">
            </label>
            <h5>Forgotten your password? Click <a>here</a> </h5>
            <button type="submit">Login</button>
        </form>
        <h5> Dont have an account yet? Create one <a href = "register.php">here</a></h5>
    </main>
<?php };?>