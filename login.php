<?php 
    session_start();
    include_once('templates/common.tpl.php');
    include_once('templates/login.tpl.php');
    output_header();
    output_login_form();
    output_footer();?>