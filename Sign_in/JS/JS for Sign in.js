// Function to toggle password visibility
document.getElementById("showPassword").addEventListener("change", function() {
  var passwordInput = document.getElementById("password");
  if (this.checked) {
      passwordInput.type = "text";
  } else {
      passwordInput.type = "password";
  }
});

