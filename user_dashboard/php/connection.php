<?php 
 function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $db_password = ""; // Database password
    $dbname = "sign_up";

    $conn = new mysqli($servername, $username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
 }
?>
