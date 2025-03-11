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

$ProspectoId= isset($_GET['id']) ? $_GET['id'] : null;

function GetProspectos ($pdo, $filtros) {
    
    global $sesion;

    $query = "SELECT * FROM prospectos WHERE ProspectoVigencia = 1";
    $params = [];

    if (!empty($filtros['nombres'])) {
        $query .= " AND CONCAT_WS(' ', ProspectoNombre, ProspectoAPaterno, ProspectoAMaterno) LIKE :nombres";
        $params[':nombres'] = "%" . trim($filtros['nombres']) . "%";
    }

    if (!empty($filtros['asesor'])) {
        $query .= " AND ProspectoAsesor = :asesor";
        $params[':asesor'] = "%" . trim($filtros['asesor']) . "%";
    }

    if (!empty($filtros['contacto'])) {
        $query .= " AND ProspectoContacto = :contacto";
        $params[':contacto'] = $filtros['contacto'];
    }

    $query .= " ORDER BY ProspectoId";

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '';
    $contador = 1;
    
    foreach ($fetch as $prospecto) {

         $html .= '
                <tr>
                    <td>' . $contador . '</td>
                    <td>' . $prospecto['ProspectoNombre'] . " " . $prospecto['ProspectoAPaterno'] . " " . $prospecto['ProspectoAMaterno'] . '</td>
                    <td>' . $prospecto['ProspectoCelular'] . '</td>
                    <td>' . $prospecto['ProspectoTelefono'] . '</td>
                    <td>' . $prospecto['ProspectoCorreo'] . '</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="e_prospectos.php?id=' . $prospecto['ProspectoId'] . '"
                                class="btn btn-dark">
                                <i class="fas fa-pencil-alt"></i>
                            </a>';
        if ($sesion['AsesorAdmin'] === 1) {
            $html .='    
                            <a  class="btn btn-danger modal_delete" data-toggle="modal" data-target="#eliminarModal' . $prospecto['ProspectoId'] . '">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="eliminarModal' . $prospecto['ProspectoId'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar prospecto.</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">¿Estas seguro de que quieres eliminar a este prospecto?</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                    <form method="POST">
                                        <input type="hidden" name="ProspectoId" value="'  . $prospecto['ProspectoId'] .  '">
                                        <button name="eliminarProspecto" class="btn btn-primary">
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
    'asesor'  => $_GET['asesor'] ?? null,
    'contacto'     => $_GET['contacto'] ?? null,
];

$prospectos = GetProspectos($pdo, $filtros);

function GetProspecto($id, $pdo) {
    $query = "SELECT * FROM prospectos INNER JOIN contacto ON prospectos.ProspectoContacto = contacto.ContactoId INNER JOIN operacion ON prospectos.ProspectoOperacion = operacion.OperacionId INNER JOIN asesores ON prospectos.ProspectoAsesor = asesores.AsesorId WHERE ProspectoId = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($fetch as $data) {
        return $data;
    }
}

$prospectoData = GetProspecto($ProspectoId, $pdo);

function GetPropiedades($pdo) {
    $query = "SELECT * FROM propiedades WHERE PropiedadVigencia = 1";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$propiedades = GetPropiedades($pdo);

function GetListaPropiedades($propiedades) {
    $options = '';
    foreach ($propiedades as $propiedad) {
        $value = htmlspecialchars($propiedad['PropiedadId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($propiedad['PropiedadTitulo']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetContacto($pdo) {
    $query = "SELECT * FROM contacto";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$contactos = GetContacto($pdo);

function GetListaContacto($contactos) {
    $options = '';
    foreach ($contactos as $contacto) {
        $value = htmlspecialchars($contacto['ContactoId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($contacto['ContactoNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetOperaciones($pdo) {
    $query = "SELECT * FROM operacion";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$operaciones = GetOperaciones($pdo);

function GetListaOperaciones($operaciones) {
    $options = '';
    foreach ($operaciones as $operacion) {
        $value = htmlspecialchars($operacion['OperacionId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($operacion['OperacionNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetAsesores($pdo) {
    $query = "SELECT * FROM asesores";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$asesores = GetAsesores($pdo);

function GetListaAsesores($asesores) {
    $options = '';
    foreach ($asesores as $asesor) {
        $value = htmlspecialchars($asesor['AsesorId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($asesor['AsesorNombre'] . " " . $asesor['AsesorApellidoPaterno'] . " " . $asesor['AsesorApellidoMaterno']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetPropiedadesData($propiedades, $pdo) {
    $propiedadSeleccionada = isset($propiedades) ? explode(',', $propiedades) : [];

    $options = '';

    $query = "SELECT * FROM propiedades";
    $result = $pdo->prepare($query);
    $result->execute();
    $consulta = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($consulta as $data) {
        $value = htmlspecialchars($data['PropiedadId']);
        $label = htmlspecialchars($data['PropiedadTitulo']);
        $selected = in_array($value, $propiedadSeleccionada) ? 'selected' : '';

        $options .= "<option value=\"$value\" $selected>$label</option>\n";
    }

    return $options;
}

function InsertProspectos(
    $nombre, $apellidopa, $apellidoma, $correo, $telefono, $celular, $contacto, $operacion, $asesor, $domicilio, $comentario, $propiedades, $pdo
) {
    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $apellidopa = filter_var($apellidopa, FILTER_SANITIZE_STRING);
    $apellidoma = filter_var($apellidoma, FILTER_SANITIZE_STRING);
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
    $celular = filter_var($celular, FILTER_SANITIZE_STRING);
    $contacto = filter_var($contacto, FILTER_SANITIZE_NUMBER_INT);
    $operacion = filter_var($operacion, FILTER_SANITIZE_NUMBER_INT);
    $asesor = filter_var($asesor, FILTER_SANITIZE_NUMBER_INT);
    $domicilio = filter_var($domicilio, FILTER_SANITIZE_STRING);
    $comentario = filter_var($comentario, FILTER_SANITIZE_STRING);

    // Convertir el arreglo de financiamientos a una cadena separada por comas
    $propiedadesString = implode(',', array_map('intval', $propiedades)); // Sanitiza los valores como enteros
 
    try {
        // Inserción principal
        $stmt = $pdo->prepare("INSERT INTO prospectos 
            (ProspectoNombre, ProspectoAPaterno, ProspectoAMaterno, ProspectoCorreo, ProspectoTelefono, ProspectoCelular, ProspectoContacto,ProspectoOperacion, ProspectoAsesor, ProspectoDomicilio, ProspectoComentario, ProspectoPropiedades, ProspectoVigencia) 
            VALUES 
            (:nombre, :paterno, :materno, :correo, :telefono, :celular, :contacto, :operacion, :asesor, :domicilio, :comentario, :propiedades, 1)");

        $stmt->execute([
            ':nombre' => $nombre,
            ':paterno' => $apellidopa,
            ':materno' => $apellidoma,
            ':correo' => $correo,
            ':telefono' => $telefono,
            ':celular' => $celular,
            ':contacto' => $contacto,
            ':operacion' => $operacion,
            ':asesor' => $asesor,
            ':domicilio' => $domicilio,
            ':comentario' => $comentario,
            ':propiedades' => $propiedadesString
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['r_prospectos'])) {
    $nombre = $_POST['nombre'];
    $apellidopa = $_POST['a_paterno'];
    $apellidoma = $_POST['a_materno'];
    $correo = $_POST['correo_electronico'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $contacto = $_POST['contacto'];
    $operacion = $_POST['operacion'];
    $asesor = $_POST['asesor'];
    $domicilio = $_POST['domicilio'];
    $comentario = $_POST['comentario'];
    $propiedades = $_POST['propiedades'];
    
    if (InsertProspectos($nombre, $apellidopa, $apellidoma, $correo, $telefono, $celular, $contacto, $operacion, $asesor, $domicilio, $comentario, $propiedades, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Prospecto registrado correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'v_prospectos.php';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al registrar el prospecto.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function UpdateProspecto($nombre, $a_paterno, $a_materno, $correo_electronico, $telefono, $celular, $contacto, $operacion, $asesor, $domicilio, $comentario, $propiedades, $ProspectoId, $pdo) {

    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $a_paterno = filter_var($a_paterno, FILTER_SANITIZE_STRING);
    $a_materno = filter_var($a_materno, FILTER_SANITIZE_STRING);
    $correo_electronico = filter_var($correo_electronico, FILTER_SANITIZE_STRING);
    $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
    $celular = filter_var($celular, FILTER_SANITIZE_STRING);
    $contacto = filter_var($contacto, FILTER_SANITIZE_NUMBER_INT);
    $operacion = filter_var($operacion, FILTER_SANITIZE_NUMBER_INT);
    $asesor = filter_var($asesor, FILTER_SANITIZE_NUMBER_INT);
    $domicilio = filter_var($domicilio, FILTER_SANITIZE_STRING);
    $comentario = filter_var($comentario, FILTER_SANITIZE_STRING);
    
    // Convertir el arreglo de financiamientos a una cadena separada por comas
    $propiedadesString = implode(',', array_map('intval', $propiedades)); // Sanitiza los valores como enteros
 
    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE prospectos SET 
            ProspectoNombre = :nombre,
            ProspectoAPaterno = :paterno,
            ProspectoAMaterno = :materno,
            ProspectoCorreo = :correo,
            ProspectoTelefono = :telefono,
            ProspectoCelular = :celular,
            ProspectoContacto = :contacto,
            ProspectoOperacion = :operacion,
            ProspectoAsesor = :asesor,
            ProspectoDomicilio = :domicilio,
            ProspectoComentario = :comentario,
            ProspectoPropiedades = :propiedades
        WHERE ProspectoId = :id");

        $stmt->execute([
            ':nombre' => $nombre,
            ':paterno' => $a_paterno,
            ':materno' => $a_materno,
            ':correo' => $correo_electronico,
            ':telefono' => $telefono,
            ':celular' => $celular,
            ':contacto' => $contacto,
            ':operacion' => $operacion,
            ':asesor' => $asesor,
            ':domicilio' => $domicilio,
            ':comentario' => $comentario,
            ':propiedades' => $propiedadesString,
            ':id' => $ProspectoId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['a_prospectos'])) {
    $nombre = $_POST['nombre'];
    $a_paterno = $_POST['a_paterno'];
    $a_materno = $_POST['a_materno'];
    $correo_electronico = $_POST['correo_electronico'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $contacto = $_POST['contacto'];
    $operacion = $_POST['operacion'];
    $asesor = $_POST['asesor'];
    $domicilio = $_POST['domicilio'];
    $comentario = $_POST['comentario'];
    $propiedades = $_POST['propiedades'];

    if (UpdateProspecto($nombre, $a_paterno, $a_materno, $correo_electronico, $telefono, $celular, $contacto, $operacion, $asesor, $domicilio, $comentario, $propiedades, $ProspectoId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios realizados correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_prospectos.php?id=" . $ProspectoId . "';
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

function DesactivarProspecto($ProspectoId, $pdo) {
    
    try {

        $stmt = $pdo->prepare("UPDATE prospectos SET ProspectoVigencia = 0 WHERE ProspectoId = :id");
        $stmt->execute([':id' => $ProspectoId]);
        return true;

    } catch (PDOException $e) {
        echo "Error al desactivar al prospecto: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarProspecto'])) {
    $ProspectoId= $_POST['ProspectoId'];

    if (DesactivarProspecto($ProspectoId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Prospecto eliminado correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'v_prospectos.php';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al eliminar al prospecto.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function GenerarExcel($pdo) {
    try {
        // Consulta para obtener los datos con el nombre completo del asesor
        $query = "SELECT CONCAT_WS(' ', ProspectoNombre, ProspectoAPaterno, ProspectoAMaterno) AS ProspectoNombreCompleto, ProspectoCorreo, ProspectoTelefono, ProspectoCelular, ProspectoDomicilio, c.ContactoNombre, CONCAT_WS(' ', a.AsesorNombre, a.AsesorApellidoPaterno, a.AsesorApellidoMaterno) AS AsesorNombreCompleto
                  FROM prospectos p
                  INNER JOIN contacto c ON  p.ProspectoContacto = c.ContactoId
                  INNER JOIN asesores a ON p.ProspectoAsesor = a.AsesorId
                  WHERE ProspectoVigencia = 1";

        $result = $pdo->prepare($query);
        $result->execute();
        $fetch = $result->fetchAll(PDO::FETCH_ASSOC);

        // Cargar la plantilla de Excel
        $spreadsheet = IOFactory::load('../doc/lista_prospectos.xlsx');
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
        header('Content-Disposition: attachment; filename="lista_prospectos.xlsx"');
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