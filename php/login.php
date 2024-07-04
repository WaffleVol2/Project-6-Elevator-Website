<?php 

session_start();

$user = $_POST['uname'];
$pass = $_POST['pword'];

// Read the JSON file  
$json = file_get_contents('authorizedUsers.json'); 
  
// Decode the JSON file 
$json_data = json_decode($json,TRUE); 

$i = 0;

foreach ($json_data as $item) {
    if ($json_data[$i]['0']['username'] == $user && $json_data[$i]['1']['password'] == $pass) {
		$_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
		header("Location: http://localhost/Project_6/main.html");
exit();
    }
$i ++;
}
?>

<!DOCTYPE html>
<html>
	<body>
		<p>Invalid, go back and try again</p>
        <a href="../index.html">Try Again</a>
	</body>
</html>
