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

        insertHistory($path, $user, $password, $current_date, $current_time, '0', '0', '0', "entering Sabbath Mode");
        for($i = 0; $i <=9; $i++){
            sleep(2);
            update($path, $user, $password, $tablename, '0', '0', $i % 3 + 1, '0', "Sabbath Mode");
        }
        echo "<br/>Sabbath Mode Over, putting you back in control...";
        header('Refresh: 2; URL = main.php');
        

        } else {
            echo "<p>You are not authorized!!! Go away!!!!!</p>";
        }
?>