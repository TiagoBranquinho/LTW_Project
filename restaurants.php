<?php 
    include_once('templates/common.tpl.php');
    include_once('templates/restaurants.tpl.php');
    output_header();
    output_restaurant_list($_GET['filter']);
    output_footer();
    ?>