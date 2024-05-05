function signUp() {
  var password = document.getElementById("password").value;
  var confirm_password = document.getElementById("confirm_password").value;

  if (password !== confirm_password) {
    var modal = document.getElementById("sign-up-password-does-not-match-modal");
    modal.style.display = "block";
    return false;
  }

  if (password.length !== 8) {
    var modal = document.getElementById("sign-up-password-password-length-incorrect-modal");
    modal.style.display = "block";
    return false;
  }

  // If validation passes, the form will be submitted
  return true;
}


function closeModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";
}
// Function to toggle password visibility
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