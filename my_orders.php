<?php 
    declare (strict_types = 1);
    session_start();
    include_once('templates/common.tpl.php');
    include_once('templates/my_orders.tpl.php');
    output_header();
    output_my_orders_list($_SESSION['username']);
    output_footer();?>
