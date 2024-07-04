<?php

$inp = file_get_contents('authorizedUsers.json');
$tempArray = json_decode($inp);
 
$user = $_POST['uname'];
$pass = $_POST['pword'];

// data stored in an array called posts
$posts = Array (
    "0" => Array (
        "username" => $user,
    ),
    "1" => Array (
        "password" => $pass,
    ),
);
// encode array to json

array_push($tempArray, $posts);
$json = json_encode($tempArray);
$bytes = file_put_contents("authorizedUsers.json", $json); //generate json file
echo "Here is the myfile data $bytes.";

$submitted = !empty($_POST);
?>
<!DOCTYPE html>
<html>
	<head><title>Form Handler Page</title></head>
	<body>
		<p>Form submitted? <?php echo (int) $submitted; ?> </p>
		<p>Your login info is</p>
		<ul>
			<li><b>username</b>: <?php echo $_POST['uname']; ?></li>
			<li><b>password</b>: <?php echo $_POST['pword']; ?></li>
		</ul>
	</body>
</html>