<?php
    declare(strict_types = 1);
    session_start();
    include_once('templates/common.tpl.php');
    include_once('templates/user.tpl.php');
    output_header();
    $user = User::getUser(getDatabaseConnection(), $_SESSION['username']);  
?>
<main>
    <h1>Change Password</h1>
    <script></script>
    <form class="changepassword" action="action_changepass.php" method="POST">
        <label><strong>Concurrent Password:</strong>
            <input type="password" name="oldPass" required="true">
        </label>
        <label><strong>New Password:</strong>
            <input type="password" name="newPass" required="true">
        </label>
        <label><strong>Confirme New Password:</strong>
            <input type="password" name="newPass2" required="true">
        </label>
        <button type="submit">Save</button>
    </form>
</main>

<?php output_footer();?>