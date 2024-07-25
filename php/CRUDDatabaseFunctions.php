<?php 
// CRUD (Create, Read, Update, Delete) functions

function connect(string $path, string $user, string $password) {
    //$db = new PDO('mysql:host=127.0.0.1;dbname=elevator', 'bren', 'Jump5Times');
    $db = new PDO($path,$user, $password);
    //$db = new PDO('mysql:host=192.168.1.203;dbname=elevator', 'bren', 'ese');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db; 
}
//$db = new PDO('mysql:host=127.0.0.1;dbname=elevator', 'bren', 'Jump5Times');
// Create
function insert($path, $user, $password, $current_date, $current_time, $status, $currentFloor, $requestedFloor, $otherInfo) {
    $db = connect($path, $user, $password);
    $query = 'INSERT INTO elevatorNetwork(date, time, status, currentFloor, requestedFloor, otherInfo) VALUES
    (:date, :time, :status, :currentFloor, :requestedFloor, :otherInfo)';
    $params = [
        'date' => $current_date['CURRENT_DATE()'],
        'time' => $current_time['CURRENT_TIME()'],
        'status' => $status, 
        'currentFloor' => $currentFloor,
        'requestedFloor' => $requestedFloor, 
        'otherInfo' => $otherInfo
    ];
    $statement = $db->prepare($query);
    $result = $statement->execute($params); 
    echo "worked";
}

function insertHistory($path, $user, $password, $current_date, $current_time, $status, $currentFloor, $requestedFloor, $otherInfo) {
    $db = connect($path, $user, $password);
    $query = 'INSERT INTO elevatorHistory(date, time, status, currentFloor, requestedFloor, otherInfo) VALUES
    (:date, :time, :status, :currentFloor, :requestedFloor, :otherInfo)';
    $params = [
        'date' => $current_date['CURRENT_DATE()'],
        'time' => $current_time['CURRENT_TIME()'],
        'status' => $status, 
        'currentFloor' => $currentFloor,
        'requestedFloor' => $requestedFloor, 
        'otherInfo' => $otherInfo
    ];
    $statement = $db->prepare($query);
    $result = $statement->execute($params); 
    echo "worked";
}

// Read
function showtable(string $path, string $user, string $password, $tablename) {
    $db = connect($path, $user, $password); 
    $query = "SELECT * FROM $tablename GROUP BY nodeID ORDER BY nodeID";  // Note: Risk of SQL injection
    $rows = $db->query($query); 
    echo "DATE|TIME|NODEID|STATUS|CURRENTFLOOR|REQUESTED FLOOR|OTHERINFO <br>";
    foreach ($rows as $row) {
        echo $row['date'] . " | " . $row['time'] . " | " . $row['nodeID'] . " | " . $row['status'] . " | " 
             . $row['currentFloor'] . " | " . $row['requestedFloor'] . " | " . $row['otherInfo'] . "<br>";
    }
}


// Update
function update(string $path, string $user, string $password, string $tablename, int $node_ID, int $new_status, int $new_currentFloor, 
                int $new_requestedFloor, string $new_otherInfo) : void {
    $db = connect($path, $user, $password);
    $query = 'UPDATE ' . $tablename . ' SET status = :stat, currentFloor = :curFloor, requestedFloor = :rqFloor, otherInfo = :oInfo
             WHERE nodeID = :id' ;    // Note: Risks of SQL injection
    $statement = $db->prepare($query); 
    $statement->bindValue('stat', $new_status); 
    $statement->bindValue('curFloor', $new_currentFloor);
    $statement->bindValue('rqFloor', $new_requestedFloor);
    $statement->bindValue('oInfo', $new_otherInfo);
    $statement->bindValue('id', $node_ID); 
    $statement->execute();                      // Execute prepared statement
}
// Delete
function deleteDatabase(string $path, string $user, string $password, string $tablename, int $node_ID) : void {
    $db = connect($path, $user, $password);
    $query = 'DELETE FROM ' . $tablename . ' WHERE nodeID = :id' ;    // Note: Risks of SQL injection
    $statement = $db->prepare($query); 
    $statement->bindValue('id', $node_ID); 
    $statement->execute();                      // Execute prepared statement
}

?>