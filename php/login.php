<?php
$submitted = !empty($_POST);
?>
<!DOCTYPE html>
<html> 
    <head><title>Form Handler Page</title></head>
    <body>
        <p>Form Submitted? <?php echo (int) $submitted; ?></p>
        <p>Your Login Info Is</p>
        <li><b>Username</b>: <?php echo $_POST['Username']; ?></li>
        <li><b>Password</b>: <?php echo $_POST['Password']; ?></li>
    </body>
</html>