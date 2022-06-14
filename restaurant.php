<?php 
    include_once('templates/common.tpl.php');
    include_once('templates/restaurant.tpl.php');
    output_header();
    output_restaurant_info((int)$_GET['id']);
    output_restaurant_dishes((int)$_GET['id'], $_GET['filter']);
    output_footer();?>