<?php
    declare(strict_types = 1);
    session_start();
    include_once('templates/common.tpl.php');
    include_once('templates/user.tpl.php');
    output_header();
    $user = User::getUser(getDatabaseConnection(), $_SESSION['username']);  
?>
<main>
<form class="edituser" action="action_edit_user.php" method="POST">
            <h1>Edit user</h1>
            <label><strong>Username:</strong>
            <?php echo '<input type="text" name="username" value=" '. $user->username . '">';?>
        </label>
            <label><strong>Password:</strong>
                <input type="password" name="password" placeholder="password(cant acess)">
            </label>
            <label><strong>Email:</strong>
                <?php echo '<input type="email" name="email" value=" ' . $user->email . '">';?>
            </label>
            <label><strong>Phone number:</strong>
                <?php echo '<input type="tel" name="tel" value=" ' . $user->phoneNumber . '" pattern="[0-9]{9}">';?>
            </label>
            <label><strong>Address:</strong>
                <?php echo '<input type="text" name="address" value=" ' . $user->address . '">';?>
            </label>
            <button type="submit">Save</button>
        </form>
</main>

<?php output_footer();?>