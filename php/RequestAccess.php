<?php 
  
// Read the JSON file  
$json = file_get_contents('myfile.json'); 
  
// Decode the JSON file 
$json_data = json_decode($json,TRUE); 
  
// Display data 
//print_r($json_data); 
echo $username = $json_data['0']['username'];
echo $password = $json_data['1']['password'];

$submitted = !empty($_POST);
?>
<!DOCTYPE html>
<html>
	<head><title>Form Handler Page</title></head>
	<body>
		<p>Form submitted? <?php echo (int) $submitted; ?> </p>
		<p>Your Submitted info is</p>
		<ul>
			<li><b>First Name</b>: <?php echo $_POST['firstname']; ?></li>
			<li><b>Last name</b>: <?php echo $_POST['lastname']; ?></li>
			<li><b>Email</b>: <?php echo $_POST['email']; ?></li>
			<li><b>Website</b>: <?php echo $_POST['website']; ?></li>
			<li><b>Birth date</b>: <?php echo $_POST['birthdate']; ?></li>
			<li><b>Faculty / Student</b>: <?php echo $_POST['fac_or_student']; ?></li>
			<li><b>Involvement</b>: <?php echo $_POST['involvement']; ?></li>
			<li><b>Other comments</b>: <?php echo $_POST['comments']; ?></li>

			<li><b>Username</b>: <?php echo $username; ?></li>
			<li><b>Password</b>: <?php echo $password; ?></li>
		</ul>
	</body>
</html>