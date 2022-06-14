<?php
    declare(strict_types = 1);
    session_start();
    include_once('templates/common.tpl.php');
    include_once('templates/reviews.tpl.php');
    output_header();
    output_restaurant_reviews(intval($_GET['restID']));
    output_footer();
?>