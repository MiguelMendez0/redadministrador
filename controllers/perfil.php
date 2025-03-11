<?php
session_start();
require 'conn.php';

if (!isset($_SESSION['user_id'])) {
    echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Inicia Sesion para continuar.',
                    icon: 'error'
                }).then(() => {
                    window.location.href = '../index.php';
                });
            });
        </script>";
}

require 'sesion.php';
require 'logout.php';

function ObtenerSesion($pdo, $SesionId) {

    $query = "SELECT AsesorId, AsesorUsuario, AsesorAdmin, AsesorNombre, AsesorApellidoPaterno, AsesorApellidoMaterno, AsesorCorreo FROM asesores WHERE AsesorId = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $SesionId, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($fetch as $data) {
        return $data;
    }
}

$sesionData = ObtenerSesion($pdo, $sesion['AsesorId']);

function CorreoExiste($email, $pdo) {

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $stmt = $pdo->prepare("SELECT * FROM asesores WHERE AsesorCorreo = :email");
    $stmt->execute(array(':email' => $email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($user !== false);
}

function ActualizarPerfil($nombre, $apellidoP, $apellidoM, $correo, $AsesorId, $pdo) {

    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $apellidoP = filter_var($apellidoP, FILTER_SANITIZE_STRING);
    $apellidoM = filter_var($apellidoM, FILTER_SANITIZE_STRING);
    $correo = filter_var($correo, FILTER_SANITIZE_STRING);

    if (CorreoExiste($correo, $pdo)) {
        $error = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ya hay un usuario registrado con este correo.',
                        icon: 'error'
                    }).then(() => {
                    window.location.href = 'perfil.php';
                });
            });
            </script>";
        return $error;
    }

    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE Asesores SET 
            AsesorNombre = :nombre,
            AsesorApellidoPaterno = :apellidoP,
            AsesorApellidoMaterno = :apellidoM,
            AsesorCorreo = :correo
        WHERE AsesorId = :id");

        $stmt->execute([
            ':nombre' => $nombre,
            ':apellidoP' => $apellidoP,
            ':apellidoM' => $apellidoM,
            ':correo' => $correo,
            ':id' => $AsesorId
        ]);

            $exito = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Perfil actualizado exitosamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'perfil.php';
                    });
                });
            </script>";

        return $exito;

    } catch (PDOException $e) {
        echo "Error al actualizar los datos: " . $e->getMessage();
        $error = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrio un error inesperado.',
                        icon: 'error'
                    }).then(() => {
                    window.location.href = 'perfil.php';
                });
            });
            </script>";
        return $error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarPerfil'])) {
    $nombres = $_POST['nombres'];
    $apellidoPaterno = $_POST['apellido_paterno'];
    $apellidoMaterno = $_POST['apellido_materno'];
    $correo = $_POST['email'];

    echo ActualizarPerfil($nombres, $apellidoPaterno, $apellidoMaterno, $correo, $sesion['AsesorId'], $pdo);
    
}

function ActualizarPassword($password1, $password2, $AsesorId, $pdo) {

    $password1 = filter_var($password1, FILTER_SANITIZE_STRING);
    $password2 = filter_var($password2, FILTER_SANITIZE_STRING);

    if ($password1 !== $password2) {
        $error = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Las contraseñas no coinciden.',
                        icon: 'error'
                    }).then(() => {
                    window.location.href = 'perfil.php';
                });
            });
            </script>";
        return $error;
    }

    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);


    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE asesores SET 
            AsesorPass = :password
        WHERE AsesorId = :id");

        $stmt->execute([
            ':password' => $hashed_password,
            ':id' => $AsesorId
        ]);

            $exito = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Contraseña actualizada exitosamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'perfil.php';
                    });
                });
            </script>";

        return $exito;

    } catch (PDOException $e) {
        echo "Error al actualizar los datos: " . $e->getMessage();
        $error = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrio un error inesperado.',
                        icon: 'error'
                    }).then(() => {
                    window.location.href = 'perfil.php';
                });
            });
            </script>";
        return $error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarPass'])) {
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    echo ActualizarPassword($password1, $password2, $sesion['AsesorId'], $pdo);
    
}