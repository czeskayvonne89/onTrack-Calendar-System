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
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sign_up";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } elseif (strlen($password) !== 8) {
        echo "<script>alert('Password must be exactly 8 characters long.');</script>";
    } else {
        // Hash the password before storing it in the database for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `people` (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Sign up successful!');</script>";
            echo "<a href='../Sign_in/Sign in.php'>Go to Sign in Page</a>"; // Link to sign-in page
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

</body>
</html>
