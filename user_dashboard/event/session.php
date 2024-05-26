<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in/sign_in.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "sign_up";

    $conn = new mysqli($servername, $username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $event_name = $conn->real_escape_string(trim($_POST['eventName']));
    $start_date = $conn->real_escape_string(trim($_POST['startDate']));
    $start_time = $conn->real_escape_string(trim($_POST['startTime']));
    $end_date = $conn->real_escape_string(trim($_POST['endDate']));
    $end_time = $conn->real_escape_string(trim($_POST['endTime']));
    $repeating = $conn->real_escape_string(trim($_POST['repeating']));
    $details = $conn->real_escape_string(trim($_POST['details']));

    $stmt = $conn->prepare("INSERT INTO `events` (user_id, eventName, startDate, startTime, endDate, endTime, repeating, details) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $user_id, $event_name, $start_date, $start_time, $end_date, $end_time, $repeating, $details);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
