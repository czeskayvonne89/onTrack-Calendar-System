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