<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in/php/authenticate.php");
    exit();
}

include 'connection.php';

$msg = '';
$stmt = null;
$conn = null;

echo $_POST['event_id'];
// Check if POST data is not empty
if (!empty($_POST)) {
    try {
        $conn = connectToDatabase();
        // Insert new record into the contacts table
        $stmt = $conn->prepare('DELETE FROM `events` WHERE event_id='.$_POST['event_id']);
        $stmt->execute();
        $_SESSION['timeline'] = $_POST['timeline'];
        header("Location: ../../user_dashboard/dashboard.php");
    } catch (Exception $ex) {
        echo $ex->getMessage();
    } finally {
        if (null != $stmt)
            $stmt->close();
        if (null !=  $conn)
            $conn->close();
    }

    exit();
}
?>