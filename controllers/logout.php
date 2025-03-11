<?php
function CerrarSesion() {


session_unset(); // Destruye las variables de sesión
session_destroy(); // Destruye la sesión


return true;

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cerrarSesion'])) {

    if (CerrarSesion()) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                  title: 'Has cerrado sesión!',
                  icon: 'success',
                  draggable: true
                }).then(() => {
                    window.location.href = '../index.php';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Ocurrio un problema al cerrar sesión.',
                    icon: 'error'
                });
            });
        </script>";
    }
}
?>
