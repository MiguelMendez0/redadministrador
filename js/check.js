const check = document.getElementById("check");
const passwordInput = document.getElementById("exampleInputPassword");

check.addEventListener("change", function() {
    if (check.checked) {
        passwordInput.type = "text";  // Muestra la contraseña
    } else {
        passwordInput.type = "password";  // Oculta la contraseña
    }
});
