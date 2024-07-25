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
        
            //////////////////////////HISTORY TABLE///////////////////
        // Initialize variables
        //$host = '192.168.1.203'; //for wireless testing
        //$password = 'ese'; 
        $tablenameHis = 'elevatorHistory'; 
        

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
        require 'debug.html'; 
        if(isset($_POST['insert'])) {
            echo "You pressed INSERT <br>"; 
            insert($path, $user, $password, $current_date, $current_time, $status, $currentFloor, $requestedFloor, $otherInfo);
			
        } elseif(isset($_POST['update'])) {
            echo "You pressed UPDATE <br>";
            update($path, $user, $password, $tablename, $nodeID, $status, $currentFloor, $requestedFloor, $otherInfo);

        } elseif(isset($_POST['delete'])) {
            echo 'You pressed DELETE <br>';
            deleteDatabase($path, $user, $password, $tablename, $nodeID);
        } 
        // Display content of database
        echo "<h3>Content of ElevatorNetwork table</h3>";
        showtable($path, $user, $password, $tablename);
        
        echo "<h3>Content of ElevatorHistory table</h3>";
        showtable($path, $user, $password, $tablenameHis);

        //require 'chartJS.html';
        // Read
        $query = "SELECT * FROM $tablenameHis GROUP BY nodeID ORDER BY nodeID";  // Note: Risk of SQL injection
        $rows = $db->query($query); 
        foreach ($rows as $row) {
            //echo $row['requestedFloor'] . "<br/>";
            if($row['requestedFloor'] == '1'){
                $requestFloor1++;
            }
            else if($row['requestedFloor'] == '2'){
                $requestFloor2++;
            }
            else if($row['requestedFloor'] == '3'){
                $requestFloor3++;
            }
        }  
echo $requestFloor1 . 'floor::' . $requestFloor2 . 'Floor:::' . $requestFloor3;
        
        } else {
            echo "<p>You are not authorized!!! Go away!!!!!</p>";
        }
?>

<html>

<div>
    <canvas id="myChart"></canvas>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
    flr1 = "<?php echo "$requestFloor1"?>";
    flr2 = "<?php echo "$requestFloor2"?>";
    flr3 = "<?php echo "$requestFloor3"?>";
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Floor 1', 'Floor 2', 'Floor 3'],
        datasets: [{
          label: 'Times Floor Was Requested',
          data: [flr1, flr2, flr3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

</html>