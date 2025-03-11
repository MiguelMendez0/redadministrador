<?php
session_start();
require 'conn.php';
require '../../vendor/autoload.php'; // Asegúrate de incluir el autoloader de Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

$AsesorId= isset($_GET['id']) ? $_GET['id'] : null;;

function EvaluarUsuario($SessionId, $AsesorId) {

    $NumberId = (int)$AsesorId;

    if ($SessionId === $NumberId) {
        return '
        <div class="row">
            <div class="col-md-6">
                <label for="inputState">Contraseña:</label>
                <input name="password" type="password" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="inputState">Confirmación de Contraseña:</label>
                <input name="confirm" type="password" class="form-control">
            </div>
        </div>';
    }
}

function GetTableAsesores($pdo, $filtros) {

    global $sesion;

    $query = "SELECT * FROM ((asesores INNER JOIN especialidad ON asesores.AsesorEspecialidad = especialidad.EspecialidadId) INNER JOIN zona ON asesores.AsesorZona = zona.ZonaId) WHERE AsesorVigente = 1";
    $params = [];

    if (!empty($filtros['nombres'])) {
        $query .= " AND AsesorNombre LIKE :nombres";
        $params[':nombres'] = "%" . trim($filtros['nombres']) . "%";
    }

    if (!empty($filtros['apellido_paterno'])) {
        $query .= " AND AsesorApellidoPaterno LIKE :apellido_paterno";
        $params[':apellido_paterno'] = "%" . trim($filtros['apellido_paterno']) . "%";
    }

    if (!empty($filtros['apellido_materno'])) {
        $query .= " AND AsesorApellidoMaterno LIKE :apellido_materno";
        $params[':apellido_materno'] = $filtros['apellido_materno'];
    }

    $query .= " ORDER BY asesores.AsesorId";

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '';
    $contador = 1;
    
    foreach ($fetch as $asesor) {
        
        $html.= '<tr>
                    <td>' . $contador . '</td>
                    <td>' . $asesor['AsesorNombre'] . " " . $asesor['AsesorApellidoPaterno'] . " " . $asesor['AsesorApellidoMaterno'] . '</td>
                    <td>' . $asesor['AsesorCorreo'] . '</td>
                    <td>' . $asesor['AsesorUsuario'] . '</td>
                    <td>' . $asesor['AsesorRfc'] . '</td>
                    <td>' . $asesor['AsesorAlta'] . '</td>                                    
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="e_asesores.php?id=' . $asesor['AsesorId'] . '" class="btn btn-dark">
                                <i class="fas fa-pencil-alt"></i>
                            </a>';
                if ($sesion['AsesorAdmin'] === 1) {
                    $html .= '
                            <a  class="btn btn-danger modal_delete" data-toggle="modal" data-target="#eliminarModal' . $asesor['AsesorId'] . '">
                                            <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                        <div class="modal fade" id="eliminarModal' . $asesor['AsesorId'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar asesor.</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">¿Estas seguro de que quieres eliminar este asesor?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                            <form method="POST">
                                                <input type="hidden" name="AsesorId" value="'  . $asesor['AsesorId'] .  '">
                                                <button name="eliminarAsesor" class="btn btn-primary">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>        
                            </td>
                        </tr>';
                }

        $contador++;

    }

    return $html;
}

$filtros = [
    'nombres' => $_GET['nombres'] ?? null,
    'apellido_paterno'  => $_GET['apellido_paterno'] ?? null,
    'apellido_materno'     => $_GET['apellido_materno'] ?? null,
];

$asesoresTabla = GetTableAsesores($pdo, $filtros);

function EvaluarCheckbox($valor) {
    if ($valor === 1) {
        return "checked";
    } else if ($valor === 0) {
        return "";
    }
}

function GetFoto($id, $pdo) {
    $query = "SELECT AsesorFoto FROM asesores WHERE AsesorId = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetch(PDO::FETCH_ASSOC);


    return ($fetch && !empty($fetch['AsesorFoto']))
        ? 'data:image/jpeg;base64,' . base64_encode($fetch['AsesorFoto'])
        : '../img/avatar.png';
}

$asesorFoto = GetFoto($AsesorId, $pdo);

function GetAsesor($id, $pdo) {
    $query = "SELECT * FROM ((asesores INNER JOIN especialidad ON asesores.AsesorEspecialidad = especialidad.EspecialidadId) INNER JOIN zona ON asesores.AsesorZona = zona.ZonaId) WHERE AsesorId = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($fetch as $data) {
        return $data;
    }
}

$dataAsesor = GetAsesor($AsesorId, $pdo);

function GetContactoEmergencia($id, $pdo) {
    $query = "SELECT * FROM contacto_emergencia LEFT JOIN parentesco ON CEParentesco = ParentescoId WHERE CEAsesor = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($fetch as $data) {
        return $data;
    }
}

$dataCEmergencia = GetContactoEmergencia($AsesorId, $pdo);

function GetEspecialidad($pdo) {
    $query = "SELECT * FROM especialidad";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$especialidades = GetEspecialidad($pdo);

function GetListaEspecialidad($especialidades) {
    $options = '';
    foreach ($especialidades as $especialidad) {
        $value = htmlspecialchars($especialidad['EspecialidadId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($especialidad['EspecialidadNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetZona($pdo) {
    $query = "SELECT * FROM zona";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$zonas = GetZona($pdo);

function GetListaZona($zonas) {
    $options = '';
    foreach ($zonas as $zona) {
        $value = htmlspecialchars($zona['ZonaId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($zona['ZonaNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetParentesco($pdo) {
    $query = "SELECT * FROM parentesco";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$parentesco = GetParentesco($pdo);

function GetListaParentesco($parentesco) {
    $options = '';
    foreach ($parentesco as $pariente) {
        $value = htmlspecialchars($pariente['ParentescoId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($pariente['ParentescoNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetDocumentacion($pdo) {
    $query = "SELECT * FROM documentacion WHERE DocumentacionClasificacion = 'ASESOR/ADMINISTRADOR'";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$documentacion = GetDocumentacion($pdo);

function GetListaDocumentacion($documentacion) {
    $options = '';
    foreach ($documentacion as $documentos) {
        $value = htmlspecialchars($documentos['DocumentacionId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($documentos['DocumentacionNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function CorreoExiste($email, $pdo) {

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $stmt = $pdo->prepare("SELECT * FROM asesores WHERE AsesorCorreo = :email");

    $stmt->execute(array(':email' => $email));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($user !== false);
}

function UsuarioExiste($usuario, $pdo) {

    $usuario = filter_var($usuario, FILTER_SANITIZE_EMAIL);

    $stmt = $pdo->prepare("SELECT * FROM asesores WHERE AsesorUsuario = :usuario");

    $stmt->execute(array(':usuario' => $usuario));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($user !== false);
}


function InsertAsesores($nombre, $apellidoPaterno, $apellidoMaterno, $correo, $fechaAlta, $rfc, $nss, $sangre, $especialidad, $zona, $telefono, $celular, $direccion, $observaciones, $username, $password, $admin, $activo, $pdo) {
    $nombre = strtoupper(filter_var($nombre, FILTER_SANITIZE_STRING));
    $apellidoPaterno = strtoupper(filter_var($apellidoPaterno, FILTER_SANITIZE_STRING));
    $apellidoMaterno = strtoupper(filter_var($apellidoMaterno, FILTER_SANITIZE_STRING));
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    $fechaAlta = filter_var($fechaAlta, FILTER_SANITIZE_STRING);
    $rfc = filter_var($rfc, FILTER_SANITIZE_STRING);
    $nss = filter_var($nss, FILTER_SANITIZE_STRING);
    $sangre = filter_var($sangre, FILTER_SANITIZE_STRING);
    $especialidad = filter_var($especialidad, FILTER_SANITIZE_STRING);
    $zona = filter_var($zona, FILTER_SANITIZE_STRING);
    $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
    $celular = filter_var($celular, FILTER_SANITIZE_STRING);
    $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
    $observaciones = filter_var($observaciones, FILTER_SANITIZE_STRING);
    $username = strtoupper(filter_var($username, FILTER_SANITIZE_STRING));
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $admin = filter_var($admin, FILTER_SANITIZE_NUMBER_INT);
    $activo = filter_var($activo, FILTER_SANITIZE_NUMBER_INT);

    if (CorreoExiste($correo, $pdo)) {
        $error = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ya hay un usuario registrado con este correo.',
                        icon: 'error'
                    }).then(() => {
                    window.location.href = 'r_asesores.php';
                });
            });
            </script>";
        return $error;
    }

    if (UsuarioExiste($username, $pdo)) {
        $error = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Este nombre de usuario ya esta registrado, ingresa uno distinto para continuar.',
                        icon: 'error'
                    }).then(() => {
                    window.location.href = 'r_asesores.php';
                });
            });
            </script>";
        return $error;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {

        $stmt = $pdo->prepare("INSERT INTO asesores (AsesorNombre, AsesorApellidoPaterno, AsesorApellidoMaterno, AsesorCorreo, AsesorAlta, AsesorRfc, AsesorNss, AsesorTipoSangre, AsesorEspecialidad, AsesorZona, AsesorTelefono, AsesorCelular, AsesorDireccion, AsesorObservaciones, AsesorUsuario, AsesorPass, AsesorActivo, AsesorAdmin, AsesorVigente) VALUES (:nombre, :paterno, :materno, :correo, :alta, :rfc, :nss, :sangre, :especialidad, :zona, :telefono, :celular, :direccion, :observaciones, :username, :password, :activo, :admin, 1)");

        $stmt->execute(array(
            ':nombre' => $nombre,
            ':paterno' => $apellidoPaterno, 
            ':materno' => $apellidoMaterno, 
            ':correo' => $correo, 
            ':alta' => $fechaAlta, 
            ':rfc' => $rfc, 
            ':nss' => $nss, 
            ':sangre' => $sangre, 
            ':especialidad' => $especialidad, 
            ':zona' => $zona, 
            ':telefono' => $telefono, 
            ':celular' => $celular, 
            ':direccion' => $direccion, 
            ':observaciones' => $observaciones, 
            ':username' => $username, 
            ':password' => $hashed_password, 
            ':activo' => $activo, 
            ':admin' => $admin
        ));

        $AsesorId = $pdo->lastInsertId();

        $stmtContactoEmergencia = $pdo->prepare("INSERT INTO contacto_emergencia (CEAsesor, CENombre, CEApellidoPaterno, CEApellidoMaterno, CETelefono, CECelular, CEParentesco) VALUES (:id, NULL, NULL, NULL, NULL, NULL, NULL)");

        $stmtContactoEmergencia->execute([
            ':id' => $AsesorId
        ]);

        $exito = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Usuario registrado exitosamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'v_asesores.php';
                    });
                });
            </script>";

        return $exito;
        
    } catch (PDOException $e) {

        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrarA'])) {
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $correo = $_POST['correo'];
    $fechaAlta = $_POST['fechaAlta'];
    $rfc = $_POST['rfc'];
    $nss = $_POST['nss'];
    $sangre = $_POST['tipoSangre'];
    $especialidad = $_POST['especialidad'];
    $zonas = $_POST['zonas'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $observaciones = $_POST['observaciones'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $c_password = $_POST['confirm'];
    $admin = isset($_POST['admin']) ? $_POST['admin'] : 0;
    $activo = isset($_POST['activo']) ? $_POST['activo'] : 0;

    if ($password === $c_password) {
        echo InsertAsesores($nombre, $apellidoPaterno, $apellidoMaterno, $correo, $fechaAlta, $rfc, $nss, $sangre, $especialidad, $zonas, $telefono, $celular, $direccion, $observaciones, $username, $password, $admin, $activo, $pdo);
    }
}

function UpdateAsesorFoto($foto, $id, $pdo) {

        $query = "UPDATE asesores SET AsesorFoto = :foto WHERE AsesorId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return true;

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarFoto'])) {
    // Validación de que se ha subido correctamente una imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);

        if (UpdateAsesorFoto($foto, $AsesorId, $pdo)) {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Foto actualizada correctamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'e_asesores.php?id=" . $AsesorId . "';
                    });
                });
            </script>";
        } else {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al atualizar la foto.',
                        icon: 'error'
                    });
                });
            </script>";
        }
    } else {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrio un error al cargar la imagen.',
                        icon: 'error'
                    });
                });
            </script>";
    }
}

function UpdateAsesores($nombre, $apellidoP, $apellidoM, $correo, $fecha, $rfc, $nss, $tipoSangre, $especialidad, $zonas, $telefono, $celular, $direccion, $observaciones, $password, $admin, $activo, $AsesorId, $pdo) {

    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $apellidoP = filter_var($apellidoP, FILTER_SANITIZE_STRING);
    $apellidoM = filter_var($apellidoM, FILTER_SANITIZE_STRING);
    $correo = filter_var($correo, FILTER_SANITIZE_STRING);
    $fecha = filter_var($fecha, FILTER_SANITIZE_STRING);
    $rfc = filter_var($rfc, FILTER_SANITIZE_STRING);
    $nss = filter_var($nss, FILTER_SANITIZE_STRING);
    $tipoSangre = filter_var($tipoSangre, FILTER_SANITIZE_STRING);
    $especialidad = filter_var($especialidad, FILTER_SANITIZE_NUMBER_INT);
    $zonas = filter_var($zonas, FILTER_SANITIZE_NUMBER_INT);
    $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
    $celular = filter_var($celular, FILTER_SANITIZE_STRING);
    $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
    $observaciones = filter_var($observaciones, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $admin = filter_var($admin, FILTER_SANITIZE_NUMBER_INT);
    $activo = filter_var($activo, FILTER_SANITIZE_NUMBER_INT);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (CorreoExiste($correo, $pdo)) {
        $error = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ya hay un usuario registrado con este correo.',
                        icon: 'error'
                    }).then(() => {
                    window.location.href = 'e_asesores.php?id=" . $AsesorId . "';
                });
            });
            </script>";
        return $error;
    }

    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE Asesores SET 
            AsesorNombre = :nombre,
            AsesorApellidoPaterno = :apaterno,
            AsesorApellidoMaterno = :amaterno,
            AsesorCorreo = :correo,
            AsesorAlta = :fecha,
            AsesorRfc = :rfc,
            AsesorNss = :nss,
            AsesorTipoSangre = :sangre,
            AsesorEspecialidad = :especialidad,
            AsesorZona = :zona,
            AsesorTelefono = :telefono,
            AsesorCelular = :celular,
            AsesorDireccion = :direccion,
            AsesorObservaciones = :observaciones,
            AsesorPass = :password,
            AsesorAdmin = :admin,
            AsesorActivo = :activo
        WHERE AsesorId = :id");

        $stmt->execute([
            ':nombre' => $nombre,
            ':apaterno' => $apellidoP,
            ':amaterno' => $apellidoM,
            ':correo' => $correo,
            ':fecha' => $fecha,
            ':rfc' => $rfc,
            ':nss' => $nss,
            ':sangre' => $tipoSangre,
            ':especialidad' => $especialidad,
            ':zona' => $zonas,
            ':telefono' => $telefono,
            ':celular' => $celular,
            ':direccion' => $direccion,
            ':observaciones' => $observaciones,
            ':password' => $hashed_password,
            ':admin' => $admin,
            ':activo' => $activo,
            ':id' => $AsesorId
        ]);

        $exito = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Datos actualizados exitosamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'e_asesores.php?id=" . $AsesorId . "';
                    });
                });
            </script>";

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarA'])) {
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoPaterno'];
    $apellidoM = $_POST['apellidoMaterno'];
    $correo = $_POST['correo'];
    $fecha = $_POST['fechaAlta'];
    $rfc = $_POST['rfc'];
    $nss = $_POST['nss'];
    $tipoSangre = $_POST['tipoSangre'];
    $especialidad = $_POST['especialidad'];
    $zonas = $_POST['zonas'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $observaciones = $_POST['observaciones'];
    $admin = isset($_POST['admin']) ? $_POST['admin'] : 0;
    $activo = isset($_POST['activo']) ? $_POST['activo'] : 0;
    $password = $_POST['password'];
    $c_password = $_POST['confirm'];


    if ($password === $c_password) {
        echo UpdateAsesores($nombre, $apellidoP, $apellidoM, $correo, $fecha, $rfc, $nss, $tipoSangre, $especialidad, $zonas, $telefono, $celular, $direccion, $observaciones, $password, $admin, $activo, $AsesorId, $pdo);
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Las contraseñas no coinciden.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function UpdateContactoEmergencia($nombre, $apellidoP, $apellidoM, $telefono, $celular, $parentesco, $AsesorId, $pdo) {

    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $apellidoP = filter_var($apellidoP, FILTER_SANITIZE_STRING);
    $apellidoM = filter_var($apellidoM, FILTER_SANITIZE_STRING);
    $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
    $celular = filter_var($celular, FILTER_SANITIZE_STRING);
    $parentesco = filter_var($parentesco, FILTER_SANITIZE_NUMBER_INT);
    
    
    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE contacto_emergencia SET 
            CENombre = :nombre,
            CEApellidoPaterno = :apaterno,
            CEApellidoMaterno = :amaterno,
            CETelefono = :telefono,
            CECelular = :celular,
            CEParentesco = :parentesco
        WHERE CEAsesor = :id");

        $stmt->execute([
            ':nombre' => $nombre,
            ':apaterno' => $apellidoP,
            ':amaterno' => $apellidoM,
            ':telefono' => $telefono,
            ':celular' => $celular,
            ':parentesco' => $parentesco,
            ':id' => $AsesorId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarCe'])) {
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoPaterno'];
    $apellidoM = $_POST['apellidoMaterno'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $parentesco = $_POST['parentesco'];

    if (UpdateContactoEmergencia($nombre, $apellidoP, $apellidoM, $telefono, $celular, $parentesco, $AsesorId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios realizados correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_asesores.php?id=" . $AsesorId . "';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al realizar los cambios.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function InsertDocumentacion($documento, $AsesorId, $DocumentacionId, $TipoMime, $pdo) {
    try {
        $query = "INSERT INTO documentacion_asesor (AsesorId, TipoDocumentacion, Documento, TipoDocumento) 
                  VALUES (:id_asesor, :id_documentacion, :documento, :tipo_mime)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_asesor', $AsesorId, PDO::PARAM_INT);
        $stmt->bindParam(':id_documentacion', $DocumentacionId, PDO::PARAM_INT);
        $stmt->bindParam(':documento', $documento, PDO::PARAM_LOB);
        $stmt->bindParam(':tipo_mime', $TipoMime, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarDocumentos'])) {
    $tipoDocumentacion = $_POST['tipo'];

    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $archivo = $_FILES['archivo'];
        $nombreArchivo = $archivo['name'];
        $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
        $tamañoArchivo = $archivo['size'];
        $contenidoArchivo = file_get_contents($archivo['tmp_name']); // Convertir el archivo a BLOB
        $tipoMime = mime_content_type($archivo['tmp_name']); // Obtener el MIME type real

        // Extensiones permitidas
        $extensionesPermitidas = ['jpg', 'jpeg', 'pdf'];

        if (in_array($tipoArchivo, $extensionesPermitidas)) {
            if ($tamañoArchivo <= 60 * 1024 * 1024) { // Máximo 5MB
                if (InsertDocumentacion($contenidoArchivo, $AsesorId, $tipoDocumentacion, $tipoMime, $pdo)) {
                    echo "
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'Documento guardado correctamente.',
                                icon: 'success'
                            }).then(() => {
                                window.location.href = 'e_asesores.php?id=" . $AsesorId . "'; 
                            });
                        });
                    </script>";
                } else {
                    echo "<script>Swal.fire('Error', 'Hubo un problema al guardar el documento.', 'error');</script>";
                }
            } else {
                echo "<script>Swal.fire('Error', 'El archivo es demasiado grande. Máximo 5MB.', 'error');</script>";
            }
        } else {
            echo "<script>Swal.fire('Error', 'Formato no permitido. Solo JPG, JPEG y PDF.', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Error', 'No se ha seleccionado un archivo.', 'error');</script>";
    }
}

function GetDocumentacionAsesor($id, $pdo) {
    $query = "SELECT * FROM documentacion_asesor INNER JOIN documentacion ON documentacion_asesor.TipoDocumentacion = documentacion.DocumentacionId WHERE AsesorId = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);

    if (empty($fetch)) {
        return '<p class="no-documents">No se encontraron documentos</p>';
    }
    
    $html = '';

    foreach ($fetch as $data) {

        if ($data['TipoDocumento'] === "image/jpeg") {

            $html.= '
            <div id="document-card-26" class="card" style="width: 14rem; float: left">
                <form method="POST" target="_blank">
                    <input type="hidden" name="documentoId" value="' . $data['DocumentoId'] . '">
                    <button type="submit" class="btn btn-sm" name="visualizarD">
                        <img src="../img/image.png" class="card-img-top" alt="pdf">
                    </button>
                </form>
                <div class="card-body">
                    <h5 class="card-title">' . $data['DocumentacionNombre'] . '</h5>
                    <div class="btn-group w-100">                    
                        <form metod="POST">
                            <input type="hidden" name="documentoId" value="' . $data['DocumentoId'] . '">
                            <button type="submit" class="btn btn-primary btn-sm" name="download" download>
                                <i class="fas fa-download d-block"></i> Descargar
                        </form>
                        <form method="POST">
                            <input type="hidden" name="documentoId" value="' . $data['DocumentoId'] . '">
                            <button type="submit" class="btn btn-danger btn-sm" name="eliminarD">
                                <i class="fas fa-trash d-block"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>';
        } else if ($data['TipoDocumento'] === "application/pdf") {
            $html.= '
            <div id="document-card-23" class="card" style="width: 14rem; float: left">
                <form method="POST" target="_blank">
                    <input type="hidden" name="documentoId" value="' . $data['DocumentoId'] . '">
                    <button type="submit" class="btn btn-sm" name="visualizarD">
                        <img src="../img/pdf.png" class="card-img-top" alt="pdf">
                    </button>
                </form>
                <div class="card-body">
                    <h5 class="card-title">' . $data['DocumentacionNombre'] . '</h5>
                    <div class="btn-group w-100">                    
                        <form method="POST">
                            <input type="hidden" name="documentoId" value="' . $data['DocumentoId'] . '">
                            <button type="submit" class="btn btn-primary btn-sm" name="download" download>
                                <i class="fas fa-download d-block"></i> Descargar
                        </form>
                        <form method="POST">
                            <input type="hidden" name="documentoId" value="' . $data['DocumentoId'] . '">
                            <button type="submit" class="btn btn-danger btn-sm" name="eliminarD">
                                <i class="fas fa-trash d-block"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>';
        }
    }
    return $html;
}

$dataDocumentacionAsesor = GetDocumentacionAsesor($AsesorId, $pdo);

function EliminarDocumento($id, $pdo) {
    try {

        $query = "DELETE FROM documentacion_asesor WHERE DocumentoId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        echo "Error al eliminar el documento: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarD'])) {
    $documentoid = $_POST['documentoId'];

    if (EliminarDocumento($documentoid, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Documento eliminado correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_asesores.php?id=" . $AsesorId . "';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al eliminar el documento.',
                    icon: 'error'
                });
            });
        </script>";
    }
}


function DescargarDocumento($documentoId, $pdo) {
    $query = "SELECT Documento, TipoDocumento FROM documentacion_asesor WHERE DocumentoId = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $documentoId, PDO::PARAM_INT);
    $stmt->execute();
    $documento = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($documento) {
        $tipo = $documento['TipoDocumento'];
        $contenido = $documento['Documento'];
        $extension = ($tipo == "application/pdf") ? "pdf" : "jpg";

        // Configuración de encabezados HTTP para la descarga
        header("Content-Type: $tipo");
        header("Content-Disposition: attachment; filename=documento_$documentoId.$extension");
        header("Content-Length: " . strlen($contenido));

        echo $contenido;
        exit();
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'El documento no ha sido encontrado.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['download'])) {
    $documentoid = $_POST['documentoId'];

    $descargarDocumento = DescargarDocumento($documentoid, $pdo);

}

function VerDocumento($documentoId, $pdo) {
    $query = "SELECT Documento, TipoDocumento FROM documentacion_asesor WHERE DocumentoId = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $documentoId, PDO::PARAM_INT);
    $stmt->execute();
    $documento = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($documento) {
        header("Content-Type: " . $documento['TipoDocumento']);
        header("Content-Disposition: inline");
        echo $documento['Documento'];
        exit();
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'No ha sido posible visualizar el documento.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['visualizarD'])) {
    $documentoid = $_POST['documentoId'];

    $verDocumento = VerDocumento($documentoid, $pdo);

}

function DesactivarAsesor($AsesorId, $pdo) {
    
    try {
        
        $stmt = $pdo->prepare("UPDATE prospectos SET ProspectoAsesor = 1 WHERE ProspectoAsesor = :id");
        $stmt->execute([':id' => $AsesorId]);

        $stmt = $pdo->prepare("UPDATE asesores SET AsesorVigente = 0 WHERE AsesorId = :id");
        $stmt->execute([':id' => $AsesorId]);
        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarAsesor'])) {
    $AsesorId = $_POST['AsesorId'];

    if (DesactivarAsesor($AsesorId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Asesor eliminado correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'v_asesores.php';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al eliminar al asesor.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function GenerarExcel($pdo) {
    try {
        // Consulta para obtener los datos con el nombre completo del asesor
        $query = "SELECT CONCAT_WS(' ', AsesorNombre, AsesorApellidoPaterno, AsesorApellidoMaterno) AS AsesorNombreCompleto, 
                         AsesorCorreo, AsesorUsuario, AsesorRfc, AsesorNss, AsesorTipoSangre, 
                         e.EspecialidadNombre, z.ZonaNombre, AsesorTelefono, AsesorCelular, 
                         AsesorDireccion, AsesorAdmin, 
                         CONCAT_WS(' ', ce.CENombre, ce.CEApellidoPaterno, ce.CEApellidoMaterno) AS CENombreCompleto, 
                         ce.CETelefono, ce.CECelular, p.ParentescoNombre
                  FROM asesores a 
                  INNER JOIN especialidad e ON a.AsesorEspecialidad = e.Especialidadid 
                  INNER JOIN zona z ON a.AsesorZona = z.ZonaId 
                  LEFT JOIN contacto_emergencia ce ON ce.CEmergenciaId = a.AsesorId 
                  LEFT JOIN parentesco p ON ce.CEParentesco = p.ParentescoId";

        $result = $pdo->prepare($query);
        $result->execute();
        $fetch = $result->fetchAll(PDO::FETCH_ASSOC);

        // Cargar la plantilla de Excel
        $spreadsheet = IOFactory::load('../doc/lista_asesores.xlsx');
        $sheet = $spreadsheet->getActiveSheet();

        $fila = 4; // Comenzar en la fila 4
        $columnaInicio = 'B'; // Comenzar en la columna B

        foreach ($fetch as $row) {
            $columna = $columnaInicio;

            foreach ($row as $key => $value) {
                // Si la clave es AsesorAdmin, cambiar el valor a "Sí" o "No"
                if ($key === 'AsesorAdmin') {
                    $value = ($value == 1) ? 'Sí' : 'No';
                }

                // Si el valor está vacío o es NULL, reemplazarlo con "No se ha registrado nada"
                if (empty($value)) {
                    $value = "No se ha registrado nada";
                }

                $sheet->setCellValue($columna . $fila, $value);
                $columna++; // Mover a la siguiente columna
            }

            $fila++; // Mover a la siguiente fila
        }

        // Configurar la salida del archivo en memoria
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="lista_asesores.xlsx"');
        header('Cache-Control: max-age=0');

        // Escribir el archivo a la salida sin guardarlo en el servidor
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } catch (PDOException $e) {
        echo "Error al descargar el archivo: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['generarExcel'])) {

    $generarExcel = GenerarExcel($pdo);

}