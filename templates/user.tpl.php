<?php include_once('database/user.class.php');
        include_once('database/connection.db.php');
    function output_user_data(){
    $user = User::getUser(getDatabaseConnection(), $_SESSION['username']);   
?>
    <main>
    <div class="userdata">
        <h1>My Data</h1>
        <?php echo '<h4>Username: ' . $user->username . '</h4>';?>
        <?php echo '<h4>Password: ' . 'user nao tem pass na classe, so na database' . '</h4>';?>
        <?php echo '<h4>Email: ' . $user->email . '</h4>';?>
        <?php echo '<h4>Phone number: ' . $user->phoneNumber . '</h4>';?>
        <?php echo '<h4>Address: ' . $user->address . '</h4>';?>
        <a href="edit_user.php">Edit</a>
    </div>
</main>
<?php } ;?>