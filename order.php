<?php 
    include_once('templates/common.tpl.php');
    include_once('templates/order.tpl.php');
    output_header();
    output_order($_GET['orderID'], $_SESSION['username']);
    output_footer();
?>