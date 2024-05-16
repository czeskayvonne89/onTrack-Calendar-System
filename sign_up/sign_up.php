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
      <li><a class="active" href="#">Sign Up</a></li>
      <li><a href="../sign_in/sign_in.php">Sign In</a></li>
    </ul>
  </div>

  <div class="form-container">
    <form id="signUpForm" action="PHP/register.php" method="post" onsubmit="return signUp()">
      <h2>Sign Up</h2>
      <label for="first_name">First Name</label>
      <input type="text" class="icon user" id="first_name" name="first_name" required maxlength="50"><br>
      <label for="last_name">Last Name</label>
      <input type="text" class="icon user" id="last_name" name="last_name" required maxlength="50"><br>
      <label for="email">Email </label>
      <input type="email" class="icon email" id="email" name="email" required maxlength="50"><br>
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
      <input type="submit" value="Sign Up"> <br> <br>
      <sub>Already have an account? <a href="../sign_in/sign_in.php">Log In</a></sub>
    </form>
  </div>
</body>

<!-- The Modal -->
<div id="sign-up-success-modal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" onclick="closeModal('sign-up-success-modal')">&times;</span>
      <h2>Sign Up Successful</h2>
    </div>
  </div>
</div>

<div id="sign-up-password-does-not-match-modal" class="modal">
  <div class="modal-content">
    <div class="modal-header" style="background-color: orange ">
      <span class="close" onclick="closeModal('sign-up-password-does-not-match-modal')">&times;</span>
      <h2>Sign Up Not Successful</h2>
    </div>
    <div class="modal-body">
      <p>PASSWORD DOES NOT MATCH!</p>
    </div>
  </div>
</div>

<div id="sign-up-password-password-length-incorrect-modal" class="modal">
  <div class="modal-content">
    <div class="modal-header" style="background-color: orange ">
      <span class="close" onclick="closeModal('sign-up-password-password-length-incorrect-modal')">&times;</span>
      <h2>Sign Up Not Successful</h2>
    </div>
    <div class="modal-body">
      <p>PASSWORD LENGTH MUST BE AT LEAST 8 CHARACTERS!</p>
    </div>
  </div>
</div>

<script type="text/javascript" src="js/sign_up.js"></script>
</script>

</html>