<!DOCTYPE html> 
<html lang="en-US">
    <head>
        <title>Food Center</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <section id="logo">
                <img src="https://picsum.photos/80" alt="logopic">
                <h3>Food Center</h3>
            </section>
            <section id="menu">
                <h3>Home</h3>
                <h3>Restaurants</h3>
                <h3>Register</h3>
                <h3>Login</h3>
            </section>
        </header>
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
    </body>
</html>