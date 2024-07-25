<?php 
    // member.php
    session_start(); 

    // Members only section
    if(isset($_SESSION['username'])) {
        // Include the database functions file
        require 'php/CRUDDatabaseFunctions.php';

        // Initialize variables
        $host = '127.0.0.1'; //for local testing
        $password = 'Jump5Times'; 
        //$host = '192.168.1.203'; //for wireless testing
        //$password = 'ese'; 
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
            insertHistory($path, $user, $password, $current_date, $current_time, '1', '1', '1', "floor Requested 1");
            $currentFloor = '1';
            //echo $currentFloor;
			
        } elseif(isset($_POST['floor2'])) {
            echo "You pressed Floor 2 <br>";
            update($path, $user, $password, $tablename, '1', '1', '2', '2', "floor Requested 2");
            insertHistory($path, $user, $password, $current_date, $current_time, '1', '2', '2', "floor Requested 2");
            $currentFloor = '2';
            //echo $currentFloor;
        
        } elseif(isset($_POST['floor3'])) {
            echo "You pressed Floor 3 <br>";
            update($path, $user, $password, $tablename, '1', '1', '3', '3', "floor Requested 3");
            insertHistory($path, $user, $password, $current_date, $current_time, '1', '3', '3', "floor Requested 3");
            $currentFloor = '3';
            //echo $currentFloor;

        } elseif(isset($_POST['sabMode'])) {
            echo "You pressed sabMode <br>";
            header('Refresh: 2; URL = sabbathMode.php');

        } elseif(isset($_POST['delete'])) {
            echo 'You pressed DELETE <br>';
            deleteDatabase($path, $user, $password, $tablename, $nodeID);
        } 
        // Display content of database
        //showtable($path, $user, $password, $tablename);
        echo $currentFloor;
        } else {
            echo "<p>You are not authorized!!! Go away!!!!!</p>";
        }
?>


<html>
  <script>
    currentFlr = "<?php echo "$currentFloor"?>";

    const floor1Audio = new Audio('floor1.wav');
    const floor2Audio = new Audio('floor2.wav');
    const floor3Audio = new Audio('floor3.wav');

    if(currentFlr == '1'){
        floor1Audio.play();
    }
    else if(currentFlr == '2'){
        floor2Audio.play();
    }
    else if(currentFlr == '3'){
        floor3Audio.play();
    }
  </script>

</html>