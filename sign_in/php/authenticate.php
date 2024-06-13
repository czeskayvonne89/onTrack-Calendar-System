<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>

<body>
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $servername = "localhost";
        $username = "root";
        $db_password = ""; // Database password
        $dbname = "sign_up";

        $conn = new mysqli($servername, $username, $db_password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        try {

            $stmt = $conn->prepare("SELECT user_id, password FROM `people` WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user_id, $stored_password);
                $stmt->fetch();

                if (password_verify($password, $stored_password)) {
                    $_SESSION['user_id'] = $user_id;
                    header("Location: ../../user_dashboard/dashboard.php");
                    exit();
                } else {
                    echo "Invalid password";
                }
            } else {
                header("Location: ../sign_in.php");
                exit();
            }

        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            $stmt->close();
            $conn->close();
        }

    }
    ?>
</body>

</html>