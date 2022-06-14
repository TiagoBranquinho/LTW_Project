<?php 
    declare(strict_types = 1);
    session_start();
    include_once('templates/common.tpl.php');
    include_once('templates/user.tpl.php');
    output_header();
    output_user_data();
    output_user_nav();
    output_footer();
?>