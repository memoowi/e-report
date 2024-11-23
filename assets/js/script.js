function togglePassoword(inputId) {
  let password = document.getElementById(inputId);
  if (password.type === "password") {
    password.type = "text";
    this.classList.remove("fa-eye");
    this.classList.add("fa-eye-slash");
  } else {
    password.type = "password";
    this.classList.remove("fa-eye-slash");
    this.classList.add("fa-eye");
  }
}

function openImage(urlImage) {
  window.open(urlImage, '_blank');
}
