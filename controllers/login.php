<?php
session_start();
require_once 'conn.php';
require 'controllers/sesion.php';

if (isset($_SESSION['user_id'])) {
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Bienvenido nuevamente " . $sesion['AsesorNombre'] . " " . $sesion['AsesorApellidoPaterno'] . " " . $sesion['AsesorApellidoMaterno'] . ".',
                icon: 'success'
            }).then(() => {
                window.location.href = 'views/index.php';
            });
        });
    </script>";
}

function verificarCredenciales($username, $password, $pdo) {

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);


    $stmt = $pdo->prepare("SELECT * FROM asesores WHERE AsesorUsuario = :usuario");

    $stmt->execute(array(':usuario' => $username));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['AsesorPass'])) {
            $_SESSION['user_id'] = $user['AsesorId'];
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (verificarCredenciales($username, $password, $pdo)) {

        $stmt = $pdo->prepare('SELECT AsesorNombre, AsesorApellidoPaterno, AsesorApellidoMaterno FROM asesores WHERE AsesorId = :id');
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $sesion = null;
      
        if (count($results) > 0) {
          $sesion = $results;
        }

        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Has iniciado sesión.',
                    text: 'Bienvenido " . $sesion['AsesorNombre'] . " " . $sesion['AsesorApellidoPaterno'] . " " . $sesion['AsesorApellidoMaterno'] . ".', 
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'views/index.php';
                });
            });
        </script>";
    } else {
        echo " 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'La contraseña o el usuario son incorrectos.',
                    icon: 'error'
                });
            });
        </script>";
    }
}
?>