const togglePassword = document.querySelector("#togglePassword");
const passwordInput = document.querySelector("#passw");

togglePassword.addEventListener("click", function() {
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    // Cambia el ícono del botón según el estado de la contraseña
    togglePassword.querySelector("i").classList.toggle("fa-eye-slash");
});