<?php
session_start();
if (!isset($_SESSION['valid']))
{
    header("Location: main.php");
    die();
}
?>

<!DOCTYPE html>
<html>
	<body>
		<p>Invalid, go back and try again</p>
        <a href="../index.html">Try Again</a>
	</body>
</html>