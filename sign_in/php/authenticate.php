<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $db_password = ""; // Changed variable name to avoid conflict
    $dbname = "sign_up";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to check if the email exists in the database
    $sql = "SELECT * FROM `people` WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists, fetch the user's password
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        echo($password);
        echo($stored_password);
        echo($password == $stored_password ? "true" : "false");

        // Verify password
        if (password_verify($password, $stored_password)) {
            // Authentication successful, redirect to the dashboard
            header("Location: ../../user_dashboard/index.php");
            exit();
        } else {
            // Password doesn't match
            echo "Invalid password";
        }
    } else {
        // Email doesn't exist, redirect to the sign-up form
        // header("Location: ../../sign_up/sign_up.php");
        // Password doesn't match
        echo "Invalid credential";
        exit();
    }
    $conn->close();
}
?>

</body>
</html>
