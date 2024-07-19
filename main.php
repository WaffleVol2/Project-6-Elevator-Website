<?php
        // Include the database functions file
        require 'php/CRUDDatabaseFunctions.php';

        // Initialize variables
        //$host = '127.0.0.1'; //for local testing
        //$password = 'Jump5Times'; 
        $host = '192.168.1.203'; //for wireless testing
        $password = 'ese'; 
        $database = 'elevator'; 
        $tablename = 'elevatorNetwork'; 
        $path = 'mysql:host=' . $host . ';dbname=' . $database; 
        $user = 'bren';  // Could be a variable from $_SESSION['username'] if the database has been set up with permissions for another user
        

        // Connect to database and make changes
        $db = connect($path, $user, $password);
        //$db = new PDO('mysql:host=127.0.0.1;dbname=elevator', 'bren', 'Jump5Times');
        //$db = new PDO('mysql:host=192.168.1.203;dbname=elevator', 'bren', 'ese');
        
        // Get data from db and/or form       
        $curr_date_query = $db->query('SELECT CURRENT_DATE()'); 
        $current_date = $curr_date_query->fetch(PDO::FETCH_ASSOC);
        $current_time_query = $db->query('SELECT CURRENT_TIME()');
        $current_time = $current_time_query->fetch(PDO::FETCH_ASSOC);
        if(isset($_POST['nodeID'])) { $nodeID = $_POST['nodeID']; }
        if(isset($_POST['status'])) { $status = $_POST['status']; }
        if(isset($_POST['currentFloor'])) { $currentFloor = $_POST['currentFloor']; }
        if(isset($_POST['requestedFloor'])) { $requestedFloor = $_POST['requestedFloor']; }
        if(isset($_POST['otherInfo'])) { $otherInfo = $_POST['otherInfo']; }
        
        // Display welcome and form
        require 'elevatorNetworkForm.html'; 
        if(isset($_POST['insert'])) {
            echo "You pressed INSERT <br>"; 
            insert($path, $user, $password, $current_date, $current_time, $status, $currentFloor, $requestedFloor, $otherInfo);
			
        } elseif(isset($_POST['update'])) {
            echo "You pressed UPDATE <br>";
            update($path, $user, $password, $tablename, $nodeID, $status, $currentFloor, $requestedFloor, $otherInfo);
			
        } elseif(isset($_POST['floor1'])) {
            echo "You pressed Floor1 <br>";
            update($path, $user, $password, $tablename, '1', '1', '1', '1', "floor Requested 1");
			
        } elseif(isset($_POST['floor2'])) {
            echo "You pressed Floor 2 <br>";
            update($path, $user, $password, $tablename, '1', '1', '2', '1', "floor Requested 2");
        
        } elseif(isset($_POST['floor3'])) {
            echo "You pressed Floor 3 <br>";
            update($path, $user, $password, $tablename, '1', '1', '3', '1', "floor Requested 3");

        } elseif(isset($_POST['delete'])) {
            echo 'You pressed DELETE <br>';
            delete($path, $user, $password, $tablename, $nodeID);
        } 
        // Display content of database
        showtable($path, $user, $password, $tablename);
        
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="author" content="Brendan Burdett">
    <meta name="description" content="Home Page for elevator operation and all sub pages">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 6</title>

    <link rel="stylesheet" href="CSS/Index.css">
</head>
<body>

    <div class="center">
    <h1>ELEVATOR PROJECT</h1>
    <h2>FLOOR</h2>
    
    <script>
        function changeImage(button_num) {
            document.getElementById("button1").src = "Images/ButtonRed.png";
            document.getElementById("button2").src = "Images/ButtonRed.png";
            document.getElementById("button3").src = "Images/ButtonRed.png";

            document.getElementById("button"+button_num).src = "Images/ButtonGreen.png";
        }
    </script>
    <div class="container">
        <img id="button1" src="Images/ButtonGreen.png" width="100" onclick="changeImage(1)">
        <img id="button2" src="Images/ButtonRed.png" width="100" onclick="changeImage(2)">
        <img id="button3" src="Images/ButtonRed.png" width="100" onclick="changeImage(3)">
    </div>

    <script src="Js/IndexStart.js"></script>
    <br />
    <script src="Js/eventListenersIndex.js"></script>
    <br />

	<ul>
        <li><a href="Logbook Brendan/LBBBIndex.html">LogBook Brendan</a></li>
		<li><a href="Gantt/Gantt.html">Gantt chart</a></li>
        <li><a href="Logbook Brendan/LBBBIndex.html">Brendan's Logbook</a>
		<li><a href="MDunk/Index.html">Mdunk's Page</a> </li>
        <li><a href="TestPlan/TestPlan.html">Test Plan</a></li>
        <li><a href="About.html">About</a></li>
        <li><a href="php/logout.php">Logout</a></li>
	</ul>
    <h3>Elevator Music</h3>
    
    <embed src="Music/himb.mp3" autoplay="true" src="Music/himb.mp3">
    
    <p id="datetime"></p>

    <script>    
    // Get current date and time
     var now = new Date();
    var datetime = now.toLocaleString();

    // Insert date and time into HTML
    document.getElementById("datetime").innerHTML = datetime;
    </script>
    <p>&copy; Brendan Burdett</p>
</div>

</body>
</html>