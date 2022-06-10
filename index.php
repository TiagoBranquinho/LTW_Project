<?php
    session_start();
    include_once('templates/common.tpl.php');
    include_once('database/image.class.php');
    output_header();
?>
<main>
    <div id="welcome">
        <div id="bigLogo">
            <img src="img/assets/food-center-logo.svg" alt="logopic">
        </div>
        <div id="search">
            <h1>Welcome!</h1>
            <form>
                <input type="text" name="restaurant" placeholder=" Search Restaurants here..." required="false" size="35" list="restaurants">
                <datalist id="restaurants">
                    <!--Use AJAX-->
                    <option>Tasca</option>
                    <option>KFC</option>
                    <option>Sabor Gaúcho</option>
                </datalist>
            </form>
        </div>
    </div>
</main>

<?php output_footer();?>