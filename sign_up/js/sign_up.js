// Function to toggle password visibility

function signUp() {
  var first_name = document.getElementById("first_name").value;
  var last_name = document.getElementById("last_name").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var confirm_password = document.getElementById("confirm_password").value;

  if (password !== confirm_password) {
    alert("Passwords do not match.");
    return false;
  }

  if (password.length !== 8) {
    alert("Password must be exactly 8 characters long.");
    return false;
  }

  // Perform further validation or send the form data to the server
  alert("Sign up successful!\nFirst Name: " + first_name + "\nLast Name: " + last_name + "\nEmail: " + email);
  return true;
}

function togglePasswordVisibility(inputId) {
  var passwordInput = document.getElementById(inputId);
  var eyeIcon = document.getElementById(inputId + "_eye");

  if (passwordInput.type === "password") {
    eyeIcon.classList.add("eye");
    eyeIcon.classList.remove("eye-slash");
    passwordInput.type = "text";
  } else {
    eyeIcon.classList.remove("eye");
    eyeIcon.classList.add("eye-slash");
    passwordInput.type = "password";
  }
}
//Email is max 50 characters
//First Name (Max 50 characters)
//Last Name (Max 50 characters)