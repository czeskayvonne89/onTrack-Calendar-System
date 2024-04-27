<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sign_up";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to check if the email exists in the database
    $sql = "SELECT * FROM people WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists, fetch the user's password
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verify password
        if (password_verify($password, $stored_password)) {
            // Password matches, authentication successful
            // Set session variables or cookies here
            echo "Authentication successful";
            // Redirect to the homepage or dashboard
            header("Location: ../Landing_Page/landing_page.html");
            exit();
        } else {
            // Password doesn't match
            echo "Invalid password";
        }
    } else {
        // Email doesn't exist, redirect to sign-up page
        header("Location: ../Sign_up/Sign up.html");
        exit();
    }

    // Close connection
    $conn->close();
}
?>
