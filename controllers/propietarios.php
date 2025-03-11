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

$PropietarioId= isset($_GET['id']) ? $_GET['id'] : null;

function GetPropietarios($pdo, $filtros) {

    global $sesion;

    $query = "SELECT * FROM propietarios WHERE PropietariosVigencia = 1";
    $params = [];

    if (!empty($filtros['nombres'])) {
        $query .= " AND PropietariosNombre LIKE :nombres";
        $params[':nombres'] = "%" . trim($filtros['nombres']) . "%";
    }

    if (!empty($filtros['apellido_paterno'])) {
        $query .= " AND PropietariosAPAterno LIKE :apellido_paterno";
        $params[':apellido_paterno'] = "%" . trim($filtros['apellido_paterno']) . "%";
    }

    if (!empty($filtros['apellido_materno'])) {
        $query .= " AND PropietariosAMaterno LIKE :apellido_materno";
        $params[':apellido_materno'] = $filtros['apellido_materno'];
    }

    $query .= " ORDER BY PropietariosId";

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '';
    $contador = 1;
    
    foreach ($fetch as $propietario) {

         $html .= '<tr>
                    <td>'. $contador .'</td>
                    <td>'. $propietario['PropietariosNombre'] . " " . $propietario['PropietariosAPaterno'] . " " . $propietario['PropietariosAMaterno'] .'</td>
                    <td>'. $propietario['PropietariosTelefono'] .'</td>
                    <td>'. $propietario['PropietariosCelular'] .'</td>
                    <td>'. $propietario['PropietariosCorreo'] .'</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="e_propietarios.php?id=' . $propietario['PropietariosId'] . '"
                                class="btn btn-dark">
                                <i class="fas fa-pencil-alt"></i>
                            </a>';
            if ($sesion['AsesorAdmin'] === 1) {
                    $html .= '
                            <a  class="btn btn-danger modal_delete" data-toggle="modal" data-target="#eliminarModal' . $propietario['PropietariosId'] . '">
                                <i class="far fa-trash-alt"></i>
                            </a> 
                        </div>
                    </td>
                </tr>
                
                <div class="modal fade" id="eliminarModal' . $propietario['PropietariosId'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar propietario.</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">¿Estas seguro de que quieres eliminar a este propietario?</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                    <form method="POST">
                                        <input type="hidden" name="PropietarioId" value="'  . $propietario['PropietariosId'] .  '">
                                        <button name="eliminarPropietario" class="btn btn-primary">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
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

$propietarios = GetPropietarios($pdo, $filtros);

function GetPropietariosData($id, $pdo) {
    $query = "SELECT * FROM propietarios WHERE PropietariosId = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetch(PDO::FETCH_ASSOC);

    return $fetch;
}

$propietariosData = GetPropietariosData($PropietarioId, $pdo);

function InsertPropietarios(
    $nombre, $apaterno, $amaterno, $email, $telefono, $celular, $direccion, $pdo
) {
    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $apaterno = filter_var($apaterno, FILTER_SANITIZE_STRING);
    $amaterno = filter_var($amaterno, FILTER_SANITIZE_STRING);
    $email = filter_var($nombre, FILTER_SANITIZE_STRING);
    $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
    $celular = filter_var($celular, FILTER_SANITIZE_STRING);
    $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
 
    try {
        // Inserción principal
        $stmt = $pdo->prepare("INSERT INTO propietarios 
            (PropietariosNombre, PropietariosAPaterno, PropietariosAMaterno, PropietariosCorreo, PropietariosTelefono, PropietariosCelular, PropietariosDireccion) 
            VALUES 
            (:nombre, :paterno, :materno, :email, :telefono, :celular, :direccion)");

        $stmt->execute([
            ':nombre' => $nombre,
            ':paterno' => $apaterno,
            ':materno' => $amaterno,
            ':email' => $email,
            ':telefono' => $telefono,
            ':celular' => $celular,
            ':direccion' => $direccion
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrarPropietarios'])) {
    $nombre = $_POST['nombre'];
    $apaterno = $_POST['a_paterno'];
    $amaterno = $_POST['a_materno'];
    $email = $_POST['correo_electronico'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];

    if (InsertPropietarios($nombre, $apaterno, $amaterno, $email, $telefono, $celular, $direccion, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Propietario registrado correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'v_propietarios.php';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al registrar el propietario.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function UpdatePropietario($nombre, $apellidoP, $apellidoM, $correo, $telefono, $celular, $direccion, $PropietarioId, $pdo) {

    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $apellidoP = filter_var($apellidoP, FILTER_SANITIZE_STRING);
    $apellidoM = filter_var($apellidoM, FILTER_SANITIZE_STRING);
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
    $celular = filter_var($celular, FILTER_SANITIZE_STRING);
    $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
    
    
    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE propietarios SET 
            PropietariosNombre = :nombre,
            PropietariosAPaterno = :apaterno,
            PropietariosAMaterno = :amaterno,
            PropietariosCorreo = :correo,
            PropietariosTelefono = :telefono,
            PropietariosCelular = :celular,
            PropietariosDireccion = :direccion
        WHERE PropietariosId = :id");

        $stmt->execute([
            ':nombre' => $nombre,
            ':apaterno' => $apellidoP,
            ':amaterno' => $apellidoM,
            ':correo' => $correo,
            ':telefono' => $telefono,
            ':celular' => $celular,
            ':direccion' => $direccion,
            ':id' => $PropietarioId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarPropietario'])) {
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['a_paterno'];
    $apellidoM = $_POST['a_materno'];
    $correo = $_POST['correo_electronico'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];

    if (UpdatePropietario($nombre, $apellidoP, $apellidoM, $correo, $telefono, $celular, $direccion, $PropietarioId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios realizados correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_propietarios.php?id=" . $PropietarioId . "';
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

function DesactivarPropietario($PropietarioId, $pdo) {
    
    try {

        $stmt = $pdo->prepare("UPDATE propietarios SET PropietariosVigencia = 0 WHERE PropietariosId = :id");
        $stmt->execute([':id' => $PropietarioId]);
        return true;

    } catch (PDOException $e) {
        echo "Error al desactivar al propietario: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarPropietario'])) {
    $PropietarioId= $_POST['PropietarioId'];

    if (DesactivarPropietario($PropietarioId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Propietario eliminado correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'v_propietarios.php';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al eliminar al propietario.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function GenerarExcel($pdo) {
    try {
        // Consulta para obtener los datos con el nombre completo del asesor
        $query = "SELECT CONCAT_WS(' ', PropietariosNombre, PropietariosAPaterno, PropietariosAMaterno) AS PropietarioNombreCompleto, PropietariosCorreo, PropietariosTelefono, PropietariosCelular, PropietariosDireccion
                  FROM propietarios 
                  WHERE PropietariosVigencia = 1";

        $result = $pdo->prepare($query);
        $result->execute();
        $fetch = $result->fetchAll(PDO::FETCH_ASSOC);

        // Cargar la plantilla de Excel
        $spreadsheet = IOFactory::load('../doc/lista_propietarios.xlsx');
        $sheet = $spreadsheet->getActiveSheet();

        $fila = 4; // Comenzar en la fila 4
        $columnaInicio = 'B'; // Comenzar en la columna B

        foreach ($fetch as $row) {
            $columna = $columnaInicio;

            foreach ($row as $key => $value) {

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
        header('Content-Disposition: attachment; filename="lista_propietarios.xlsx"');
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