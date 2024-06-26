function changePw() {
  var password = document.getElementById("password").value;
  var confirm_password = document.getElementById("confirm_password").value;

  if (password !== confirm_password) {
    var modal = document.getElementById("change-password-does-not-match-modal");
    modal.style.display = "block";
    return false;
  }

  if (password.length !== 8) {
    var modal = document.getElementById("change-password-password-length-incorrect-modal");
    modal.style.display = "block";
    return false;
  }

  // Perform further validation or send the form data to the server
  var modal = document.getElementById("change-password-success-modal");
  modal.style.display = "block";
  return false;
}

function closeModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";
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