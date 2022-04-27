<?php function output_header(){;?>
    <!DOCTYPE html> 
        <html lang="en-US">
            <head>
                <title>Food Center</title>
                <meta charset="UTF-8">
                <link href="../css/style.css" rel="stylesheet">
                <link href="../css/responsive.css" rel="stylesheet">
                <script src="script.js" defer></script>

            </head>
            <body>
                <header>
                    <section id="logo">
                        <img src="https://picsum.photos/80" alt="logopic">
                        <a href="index.php"><h3>Food Center</h3></a>
                    </section>
                    <section id="menu">
                        <a href="index.php"><h3>Home</h3></a>
                        <a href="restaurants.php"><h3>Restaurants</h3></a>
                        <a href="register.php"><h3>Register</h3></a>
                        <a href="login.php"><h3>Login</h3></a>
                    </section>
                </header>
<?php };
function output_footer(){;?>
    <footer><p>&copy; Food Center, 2022</p></footer>
    </body>
</html>
<?php } ;?>