document.getElementById("signUpForm").onsubmit = function(event) {
  event.preventDefault(); // Prevent the form from submitting the default way

  var password = document.getElementById("password").value;
  var confirm_password = document.getElementById("confirm_password").value;

  if (password !== confirm_password) {
    var modal = document.getElementById("sign-up-password-does-not-match-modal");
    modal.style.display = "block";
    return false;
  }

  if (password.length < 8) {
    var modal = document.getElementById("sign-up-password-password-length-incorrect-modal");
    modal.style.display = "block";
    return false;
  }

  var formData = new FormData(this);

  fetch('PHP/register.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    console.log('Response from PHP:', data); // Add this line for debugging
    if (data.trim() === 'success') {
      var successModal = document.getElementById("sign-up-success-modal");
      successModal.style.display = "block";
    } else {
      alert("An error occurred: " + data);
    }
  })
  .catch(error => console.error('Error:', error));

  return false;
};

function closeModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";
  if (modalId === "sign-up-success-modal") {
    window.location.href = "../user_dashboard/dashboard.php";
  }
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
