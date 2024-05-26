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
        $servername = "localhost";
        $username = "root";
        $db_password = ""; // Database password
        $dbname = "sign_up";

        $conn = new mysqli($servername, $username, $db_password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $first_name = $conn->real_escape_string(trim($_POST['first_name']));
        $last_name = $conn->real_escape_string(trim($_POST['last_name']));
        $email = $conn->real_escape_string(trim($_POST['email']));
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format");
        }
        if ($password !== $confirm_password) {
            die("Passwords do not match");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            // Insert user data into the database
            $stmt = $conn->prepare("INSERT INTO `people` (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);
    
            if ($stmt->execute()) {
                header("Location: ../../sign_in/sign_in.php");
            } else {
                echo "Error: " . $stmt->error;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
