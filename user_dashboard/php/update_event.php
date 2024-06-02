<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../sign_in/php/authenticate.php");
    exit();
}

include 'connection.php';

$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $event_name = isset($_POST['event_name']) ? $_POST['event_name'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d H:i:s');
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d H:i:s');
    $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';
    $details = isset($_POST['details']) ? $_POST['details'] : '';

    try {
        $conn = connectToDatabase();
        // Insert new record into the contacts table
        $stmt = $conn->prepare('UPDATE `events` SET `user_id`=?,`event_name`=?,`start_date`=?,`start_time`=?,`end_date`=?,`end_time`=?,`details`=? WHERE event_id='.$_POST['event_id']);
        $stmt->execute([$_SESSION['user_id'], $event_name, $start_date, $start_time, $end_date, $end_time, $details]);
        $_SESSION['timeline'] = $_POST['timeline'];
        header("Location: ../../user_dashboard/dashboard.php");
    } catch (Exception $ex) {
        echo $ex->getMessage();
    } finally {
        if (null != $stmt)
            $stmt->close();
        if (null != $stmt)
            $conn->close();
    }

    exit();
}
?>