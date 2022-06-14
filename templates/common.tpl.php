<?php
if(!isset($_SESSION)) { session_start(); };
?>
<?php function output_header(){;?>
    <!DOCTYPE html> 
        <html lang="en-US">
            <head>
                <title>Food Center</title>
                <meta charset="UTF-8">
                <link href="../css/style.css" rel="stylesheet">
                <link href="../css/restaurant.css" rel="stylesheet">
                <link href="../css/responsive.css" rel="stylesheet">
                <link href="../css/order.css" rel="stylesheet">
                <link href="../css/index.css" rel="stylesheet">
                <link href="../css/reviews.css" rel="stylesheet">
                <link rel="icon" type="image/x-icon" href="../img/assets/favicon.ico">
                <script src="../scripts/script.js" defer></script>
                <script src="../scripts/registerCheckboxResponsive.js" defer></script>
                <script src="../scripts/script.js" defer></script>
                <script src="../scripts/changePass.js" defer></script>
                <script src="../scripts/updateOrderForm.js" defer></script>
                <script src="../scripts/updateOrderQuantity.js" defer></script>
                <script src="../scripts/checkFavouriteRestaurantFilter.js" defer></script>
                <script src="../scripts/indexScript.js" defer></script>
                <script src="../scripts/checkFavouriteRestaurantOrderFilter.js" defer></script>


            </head>
            <body>
                <header>
                    <section id="logo">
                        <a href="../index.php">
                            <img src="../img/assets/food-center-logo-horizontal.svg" alt="logopic">
                        </a>
                    </section>
                    <section id="menu">
                        <a href="index.php"><h3>Home</h3></a>
                        <a href="restaurants.php?filter=All&fav=off"><h3>Restaurants</h3></a>
                        <?php if(isset($_SESSION['username'])){?>
                        <a href="user.php"><h3><?php echo $_SESSION['username'];?></h3></a>
                        <a href="action_logout.php"><h3>Logout</h3></a>
                        <?php }
                        else{?>
                        <a href="register.php"><h3>Register</h3></a>
                        <a href="login.php"><h3>Login</h3></a>
                        <?php };?>
                    </section>
                </header>
<?php };
function output_footer(){;?>
    <footer><p>&copy; Food Center, 2022</p></footer>
    </body>
</html>
<?php } ;?>