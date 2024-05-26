<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in/sign_in.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "sign_up";

    $conn = new mysqli($servername, $username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $event_id = $_POST['eventID'];
    $stmt = $conn->prepare("DELETE FROM events WHERE eventID = ?");
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
