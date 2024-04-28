<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="../reboot.css" />
  <link rel="stylesheet" href="styles/styles.css" />
</head>

<body>
  <div class="header-nav-bar">
    <a href="../index.php">
      <div class="logo">
      </div>
    </a>

    <ul>
      <li><a href="#">&nbsp;</a></li>
    </ul>
  </div>

  <div class="form-container">
    <form id="signUpForm" action="" method="POST" id="form">
      <h2>Change Password</h2>
      <label for="email">Email</label>
      <input type="text" class="icon email" id="email" placeholder="Enter email" required><br>
      <label for="password">Password (Password must be 8 characters long)</label>
      <div class="input-container">
        <input type="password" class="icon password" id="password" name="password" required>
        <button type="button" class="show-password-btn" onclick="togglePasswordVisibility('password')"><i
            id="password_eye" class="password icon eye-slash" id="togglePassword"></i></button>
      </div>
      <label for="confirm_password">Confirm Password</label>
      <div class="input-container">
        <input type="password" class="icon password" id="confirm_password" name="confirm_password" required>
        <button type="button" class="show-password-btn" onclick="togglePasswordVisibility('confirm_password')">
          <i id="confirm_password_eye" class="icon eye-slash" id="togglePassword"></i></button>
      </div>
      <input type="submit" value="Change Password"></input>
      <p style="text-align:center;"><a href="../sign_in/sign_in.php">Back</a></p>
    </form>

  </div>
</body>

<script type="text/javascript" src="js/password_reset.js">
</script>

</html>