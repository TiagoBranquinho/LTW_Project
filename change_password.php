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
    <form class="changepassword" action="action_changepass.php" method="POST">
        <label><strong>New Password:</strong>
            <input type="password" id="newPass" name="newPass" required="true" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" title="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number">
        </label>
        <label><strong>Confirm New Password:</strong>
            <input type="password" id="newPass2" name="newPass2" required="true" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" title="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number">
        </label>
        <button type="submit">Save</button>
    </form>
</main>

<?php output_footer();?>