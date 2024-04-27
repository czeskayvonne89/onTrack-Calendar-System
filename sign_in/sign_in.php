<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../reboot.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <div class="header-nav-bar">
        <a href="../index.php">
            <div class="logo">
            </div>
        </a>

        <ul>
            <li><a href="../sign_up/sign_up.php">Sign Up</a></li>
            <li><a class="active" href="#">Login</a></li>
        </ul>
    </div>

    <div class="form-container">
        <form id="signUpForm" action="PHP/Authentication for Sign in.php" method="POST">
            <h2>Sign In</h2>
            <label for="username">Username:</label><br>
            <input type="text" class="icon user" id="username" name="username" required maxlength="50"><br>
            <label for="password">Password:</label><br>
            <div class="input-container">
                <input type="password" class="icon password" id="password" name="password" required>
                <button type="button" class="show-password-btn" onclick="togglePasswordVisibility('password')"><i
                        id="password_eye" class="password icon eye-slash" id="togglePassword"></i></button>
            </div>
            <input type="checkbox" id="rememberMe" name="rememberMe">
            <label for="rememberMe">Remember Me</label><br>
            <input type="submit" value="Sign In">

            <p class="signup-link">Don't have an account? <a href="../Sign_up/Sign up.html">Sign Up</a></p>
        </form>
    </div>


    <script type="text/javascript" src="js/sign_in.js">
    </script>
</body>

</html>