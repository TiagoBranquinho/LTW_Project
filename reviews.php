<?php
    declare(strict_types = 1);
    session_start();
    include_once('templates/common.tpl.php');
    include_once('templates/reviews.tpl.php');
    output_header();
    echo "Restaurant session ID: ". $_SESSION['restID'];
    echo "   Restaurant get ID: ". $_GET['restID'];
    output_restaurant_reviews(intval($_GET['restID']));
    output_footer();
?>