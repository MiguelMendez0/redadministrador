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

$PropiedadId= isset($_GET['id']) ? $_GET['id'] : null;;

function GetPropiedadesFiltradas($pdo, $filtros) {

    global $sesion;

    $query = "SELECT * FROM propiedades 
                INNER JOIN tipo ON propiedades.PropiedadTipo = tipo.TipoId 
                INNER JOIN operacion ON propiedades.PropiedadOperacion = operacion.OperacionId INNER JOIN uso ON propiedades.PropiedadUso = uso.UsoId 
                INNER JOIN antiguedad ON propiedades.PropiedadAntiguedad = antiguedad.AntiguedadId 
                INNER JOIN asesores ON propiedades.PropiedadAsesor = asesores.AsesorId 
                INNER JOIN status ON propiedades.PropiedadStatus = status.StatusId 
                INNER JOIN moneda ON propiedades.PropiedadMoneda = moneda.MonedaId 
                WHERE PropiedadVigencia = 1";
    $params = [];

    if (!empty($filtros['folio'])) {
        $query .= " AND PropiedadFolio LIKE :folio";
        $params[':folio'] = "%" . trim($filtros['folio']) . "%";
    }

    if (!empty($filtros['titulo'])) {
        $query .= " AND PropiedadTitulo LIKE :titulo";
        $params[':titulo'] = "%" . trim($filtros['titulo']) . "%";
    }

    if (!empty($filtros['asesor'])) {
        $query .= " AND PropiedadAsesor = :asesor";
        $params[':asesor'] = $filtros['asesor'];
    }

    if (!empty($filtros['operacion'])) {
        $query .= " AND PropiedadOperacion = :operacion";
        $params[':operacion'] = $filtros['operacion'];
    }

    if (!empty($filtros['tipo'])) {
        $query .= " AND PropiedadTipo = :tipo";
        $params[':tipo'] = $filtros['tipo'];
    }

    $query .= " ORDER BY propiedades.PropiedadId";

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $html = '';
    
    foreach ($fetch as $propiedad) {

        $queryFoto = "SELECT FotoArchivo FROM fotos WHERE FotoPropiedad = :id AND FotoPrincipal = 1 LIMIT 1";
        $resultFoto = $pdo->prepare($queryFoto);
        $resultFoto->bindParam(':id', $propiedad['PropiedadId'], PDO::PARAM_INT);
        $resultFoto->execute();
        $foto = $resultFoto->fetch(PDO::FETCH_ASSOC);

        $fotoBase64 = $foto ? base64_encode($foto['FotoArchivo']) : null;
        $imagen = $fotoBase64 ? '<img src="data:image/jpeg;base64,' . $fotoBase64 . '" alt="Foto Propiedad" style="width: 100px; height: auto;">' : 'Sin Foto';

            $html .= '<tr>
                        <td>' .  $imagen . '</td>
                        <td>' . $propiedad['PropiedadFolio'] . '</td>
                        <td>' . $propiedad['TipoNombre'] . '</td>
                        <td>' . $propiedad['OperacionNombre'] . '</td>
                        <td>' . $propiedad['PropiedadTitulo'] . '</td>';
            switch ($propiedad['StatusId']) {
                case 1:
                    $html .= '
                        <td>
                            <div class="badge2" style="background-color: #3ac328; color:black;">
                                ' . $propiedad['StatusNombre'] . '
                            </div>
                        </td>';
                    break;
                case 2:
                    $html .= '
                        <td>
                            <div class="badge2" style="background-color: #e88411; color:black;">
                                ' . $propiedad['StatusNombre'] . '
                            </div>
                        </td>';
                    break;
                case 3:
                    $html .= '
                        <td>
                            <div class="badge2" style="background-color: #080808; color:black;">
                                ' . $propiedad['StatusNombre'] . '
                            </div>
                        </td>';
                    break;
                case 4:
                    $html .= '
                        <td>
                            <div class="badge2" style="background-color: #e25418; color:black;">
                                ' . $propiedad['StatusNombre'] . '
                            </div>
                        </td>';
                    break;
                case 5:
                    $html .= '
                        <td>
                            <div class="badge2" style="background-color: #e8113c; color:black;">
                                ' . $propiedad['StatusNombre'] . '
                            </div>
                        </td>';
                    break;
                case 6:
                    $html .= '
                        <td>
                            <div class="badge2" style="background-color: #1f0505; color:black;">
                                ' . $propiedad['StatusNombre'] . '
                            </div>
                        </td>';
                    break;
            };

            $html .= '<td>' . '$' . $propiedad['PropiedadVenta'] . " " .  $propiedad['MonedaNombre'] . '</td>
                        <td>' . '$' . $propiedad['PropiedadRenta'] . " " .  $propiedad['MonedaNombre'] . '</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="e_propiedades.php?id=' . $propiedad['PropiedadId'] . '" class="btn btn-dark">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>';
                                
        if ($sesion['AsesorAdmin'] === 1) {

            $html .= '<a  class="btn btn-danger modal_delete" data-toggle="modal" data-target="#eliminarModal' . $propiedad['PropiedadId'] . '">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                    <div class="modal fade" id="eliminarModal' . $propiedad['PropiedadId'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar propiedad.</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">¿Estas seguro de que quieres eliminar esta propiedad?</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                    <form method="POST">
                                        <input type="hidden" name="PropiedadId" value="'  . $propiedad['PropiedadId'] .  '">
                                        <button name="eliminarPropiedad" class="btn btn-primary">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    }

    return $html;

} 

$filtros = [
    'folio' => $_GET['folio'] ?? null,
    'titulo'  => $_GET['titulo'] ?? null,
    'asesor'     => $_GET['asesor'] ?? null,
    'operacion'  => $_GET['operacion'] ?? null,
    'tipo'       => $_GET['tipo'] ?? null,
];

$propiedadesTabla = GetPropiedadesFiltradas($pdo, $filtros);

function GetPropiedad($id, $pdo)  {
    $query = "SELECT * FROM propiedades 
    INNER JOIN tipo ON propiedades.PropiedadTipo = tipo.TipoId 
    INNER JOIN operacion ON propiedades.PropiedadOperacion = operacion.OperacionId 
    INNER JOIN uso ON propiedades.PropiedadUso = uso.UsoId 
    INNER JOIN antiguedad ON propiedades.PropiedadAntiguedad = antiguedad.AntiguedadId 
    INNER JOIN asesores ON propiedades.PropiedadAsesor = asesores.AsesorId 
    INNER JOIN status ON propiedades.PropiedadStatus = status.StatusId 
    INNER JOIN moneda ON propiedades.PropiedadMoneda = moneda.MonedaId 
    LEFT JOIN propietarios ON propiedades.PropiedadPropietario = propietarios.PropietariosId 
    LEFT JOIN llave ON propiedades.PropiedadLlaves = llave.LlaveId 
    LEFT JOIN contrato ON propiedades.PropiedadContrato = contrato.ContratoId 
    WHERE PropiedadId = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($fetch as $data) {
        return $data;
    }
}

$dataPropiedad = GetPropiedad($PropiedadId, $pdo);

function GetPropiedadCaracteristica($id, $pdo) {
    $query = "SELECT 
    p.PropiedadId,
    p.PropiedadTitulo,
    t.TipoNombre,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'M2 de Construccion' THEN pc.Valor ELSE NULL END) AS MetrosCuadrados,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Recámaras' THEN pc.Valor ELSE NULL END) AS Recamaras,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Baños' THEN pc.Valor ELSE NULL END) AS Baños,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Medio Baño' THEN pc.Valor ELSE NULL END) AS MedioBaño,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Estacionamiento' THEN pc.Valor ELSE NULL END) AS Estacionamiento,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Seguridad Privada' THEN pc.Valor ELSE NULL END) AS SeguridadPrivada,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Cocina Integral' THEN pc.Valor ELSE NULL END) AS CocinaIntegral,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Cuarto de Lavado' THEN pc.Valor ELSE NULL END) AS CuartoLavado,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Cuarto de Servicio' THEN pc.Valor ELSE NULL END) AS CuartoServicio,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Alberca Privada' THEN pc.Valor ELSE NULL END) AS AlbercaPrivada,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Sala de TV' THEN pc.Valor ELSE NULL END) AS SalaTV,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Área de Blancos' THEN pc.Valor ELSE NULL END) AS AreaBlancos,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'CCTV' THEN pc.Valor ELSE NULL END) AS CCTV,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Patio' THEN pc.Valor ELSE NULL END) AS Patio,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Cisterna' THEN pc.Valor ELSE NULL END) AS Cisterna,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Cocineta' THEN pc.Valor ELSE NULL END) AS Cocineta,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Calentador de Agua' THEN pc.Valor ELSE NULL END) AS CalentadorAgua,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Tinaco' THEN pc.Valor ELSE NULL END) AS Tinaco,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Jardín' THEN pc.Valor ELSE NULL END) AS Jardin,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Tanque de Gas Estacionario' THEN pc.Valor ELSE NULL END) AS TanqueEstacionario,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Portón' THEN pc.Valor ELSE NULL END) AS Porton,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Área Deportiva' THEN pc.Valor ELSE NULL END) AS AreaDeportiva,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Gimnasio Privado' THEN pc.Valor ELSE NULL END) AS GimnasioPrivado,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Gimnasio de uso común' THEN pc.Valor ELSE NULL END) AS GimnasioComun,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Parques / Áreas verdes' THEN pc.Valor ELSE NULL END) AS Parques,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Alberca de uso común' THEN pc.Valor ELSE NULL END) AS AlbercaComun,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Lavadora Secadora' THEN pc.Valor ELSE NULL END) AS LavadoraSecadora,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'INTERNET' THEN pc.Valor ELSE NULL END) AS Internet,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Vivero' THEN pc.Valor ELSE NULL END) AS Vivero,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Caverna' THEN pc.Valor ELSE NULL END) AS Caverna,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Jacuzzi' THEN pc.Valor ELSE NULL END) AS Jacuzzi,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'M2 de Terreno' THEN pc.Valor ELSE NULL END) AS M2Terreno,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Frente' THEN pc.Valor ELSE NULL END) AS Frente,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Fondo' THEN pc.Valor ELSE NULL END) AS Fondo,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Forma Regular' THEN pc.Valor ELSE NULL END) AS FormaRegular,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Forma Irregular' THEN pc.Valor ELSE NULL END) AS FormaIrregular,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Requiere Relleno' THEN pc.Valor ELSE NULL END) AS RequiereRelleno,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Energia Eléctrica' THEN pc.Valor ELSE NULL END) AS EnergiaElectrica,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Agua Potable' THEN pc.Valor ELSE NULL END) AS AguaPotable,
    MAX(CASE WHEN c.CaracteristicaDescripcion = 'Desván' THEN pc.Valor ELSE NULL END) AS Desvan
FROM 
    propiedades p
JOIN 
    tipo t ON p.PropiedadTipo = t.TipoId
JOIN 
    propiedad_caracteristicas pc ON p.PropiedadId = pc.PropiedadId
JOIN 
    caracteristicas c ON pc.CaracteristicaId = c.CaracteristicaId
WHERE 
    p.PropiedadId = :id
GROUP BY 
    p.PropiedadId, p.PropiedadTitulo, t.TipoNombre;";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($fetch as $data) {
        return $data;
    }
}

$propiedadCaracteristica = GetPropiedadCaracteristica($PropiedadId, $pdo);

function EvaluarCheckbox($valor) {
    if ($valor === 1) {
        return "checked";
    } else if ($valor === 0) {
        return "";
    }
}

function GetFotos($id, $pdo) {

    global $sesion;

    $query = "SELECT * FROM fotos WHERE FotoPropiedad = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);

    $fotoPrincipalId = null;
    foreach ($fetch as $data) {
        if ($data['FotoPrincipal'] == 1) {
            $fotoPrincipalId = $data['FotoId'];
            break;
        }
    }

    $html = '';

    foreach ($fetch as $data) {
        $fotoBase64 = base64_encode($data['FotoArchivo']);
        $html .= '<tr id="tr_' . $data['FotoId'] . '" data-id="' . $data['FotoId'] . '"
                    data-lookup="a574d4a0-b789-4a2e-aadc-f948e39e005a"
                    draggable="false" class="" style="">
                    <td>
                        <img src="data:image/jpeg;base64,' . $fotoBase64 . '" class="rounded-circle foto_propiedad" height="40" width="40">
                    </td>';

                    if ($fotoPrincipalId == null) {

                        $html .= '<td>
                                    <a  class="btn btn-primary" data-toggle="modal" data-target="#principalModal' . $data['FotoId'] . '">
                                        Establecer Principal
                                    </a>
                                </td>';

                    } else {
                        if ($data['FotoId'] == $fotoPrincipalId) {
                            $html .= '<td>
                                        <a  class="btn btn-warning" data-toggle="modal" data-target="#quitarPrincipalModal' . $data['FotoId'] . '">
                                            Quitar Principal
                                        </a>
                                    </td>

                                        <div class="modal fade" id="quitarPrincipalModal' . $data['FotoId'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Quitar foto principal.</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">¿Estas seguro que quieres quitar esta foto como la principal?</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                        <form method="POST">
                                                            <input type="hidden" name="FotoId" value="'  . $data['FotoId'] .  '">
                                                            <button name="quitarPrincipalFoto" class="btn btn-primary">
                                                                Actualizar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                        } else {
                            $html .= '<td>-</td>';
                        }
                    }

                if ($sesion['AsesorAdmin'] === 1) {

                    $html .= '
                            <td>
                                <a  class="btn btn-danger modal_delete" data-toggle="modal" data-target="#eliminarModal' . $data['FotoId'] . '">
                                            <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                            
                            <div class="modal fade" id="eliminarModal' . $data['FotoId'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar foto.</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">¿Estas seguro de que quieres eliminar esta foto?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                            <form method="POST">
                                                <input type="hidden" name="FotoId" value="'  . $data['FotoId'] .  '">
                                                <button name="eliminarFoto" class="btn btn-primary">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal fade" id="principalModal' . $data['FotoId'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Establecer foto pricipal.</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">¿Estas seguro que quieres hacer que esta foto sea la principal?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                            <form method="POST">
                                                <input type="hidden" name="FotoId" value="'  . $data['FotoId'] .  '">
                                                <button name="principalFoto" class="btn btn-primary">
                                                    Actualizar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
    }

    return $html;
}

$fotos = GetFotos($PropiedadId, $pdo);

function GetTipo($pdo) {
    $query = "SELECT * FROM tipo";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$tipos = GetTipo($pdo);

function GetListaTipo($tipos) {
    $options = '';
    foreach ($tipos as $tipo) {
        $value = htmlspecialchars($tipo['TipoId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($tipo['TipoNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetOperacion($pdo) {
    $query = "SELECT * FROM operacion";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$operaciones = GetOperacion($pdo);

function GetListaOperaciones($operaciones) {
    $options = '';
    foreach ($operaciones as $operacion) {
        $value = htmlspecialchars($operacion['OperacionId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($operacion['OperacionNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetFinanciamiento($pdo) {
    $query = "SELECT * FROM financiamiento";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$financiamientos = GetFinanciamiento($pdo);

function GetListaFinanciamientos($financiamientos) {
    $options = '';
    foreach ($financiamientos as $financiamiento) {
        $value = htmlspecialchars($financiamiento['FinanciamientoId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($financiamiento['FinanciamientoNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetUso($pdo) {
    $query = "SELECT * FROM uso";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$usos = GetUso($pdo);

function GetListaUsos($usos) {
    $options = '';
    foreach ($usos as $uso) {
        $value = htmlspecialchars($uso['UsoId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($uso['UsoNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetAntiguedad($pdo) {
    $query = "SELECT * FROM antiguedad";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$antiguedad = GetAntiguedad($pdo);

function GetListaAntiguedad($antiguedad) {
    $options = '';
    foreach ($antiguedad as $antiguo) {
        $value = htmlspecialchars($antiguo['AntiguedadId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($antiguo['AntiguedadNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetAsesor($pdo) {
    $query = "SELECT * FROM asesores";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$asesores = GetAsesor($pdo);

function GetListaAsesores($asesores) {
    $options = '';
    foreach ($asesores as $asesor) {
        $value = htmlspecialchars($asesor['AsesorId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($asesor['AsesorNombre'] . " " . $asesor['AsesorApellidoPaterno'] . " " . $asesor['AsesorApellidoMaterno']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetStatus($pdo) {
    $query = "SELECT * FROM status";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$status = GetStatus($pdo);

function GetListaStatus($status) {
    $options = '';
    foreach ($status as $estado) {
        $value = htmlspecialchars($estado['StatusId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($estado['StatusNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetMoneda($pdo) {
    $query = "SELECT * FROM moneda";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$monedas = GetMoneda($pdo);

function GetListaMoneda($monedas) {
    $options = '';
    foreach ($monedas as $moneda) {
        $value = htmlspecialchars($moneda['MonedaId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($moneda['MonedaNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetPropietarios($pdo) {
    $query = "SELECT * FROM propietarios";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$propietarios = GetPropietarios($pdo);

function GetListaPropietarios($propietarios) {
    $options = '';
    foreach ($propietarios as $propietario) {
        $value = htmlspecialchars($propietario['PropietariosId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($propietario['PropietariosNombre'] . " " . $propietario['PropietariosAPaterno'] . " " . $propietario['PropietariosAMaterno']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetLlaves($pdo) {
    $query = "SELECT * FROM llave";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$llaves = GetLlaves($pdo);

function GetListaLlaves($llaves) {
    $options = '';
    foreach ($llaves as $llave) {
        $value = htmlspecialchars($llave['LlaveId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($llave['LlaveNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetContratos($pdo) {
    $query = "SELECT * FROM contrato";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$contratos = GetContratos($pdo);

function GetListaContratos($contratos) {
    $options = '';
    foreach ($contratos as $contrato) {
        $value = htmlspecialchars($contrato['ContratoId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($contrato['ContratoNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetDocumentacion($pdo) {
    $query = "SELECT * FROM documentacion";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$documentacion = GetDocumentacion($pdo);

function GetListaDocumentacion($documentacion) {
    $options = '';
    foreach ($documentacion as $documento) {
        $value = htmlspecialchars($documento['DocumentacionId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($documento['DocumentacionNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetProspectos($pdo) {
    $query = "SELECT * FROM prospectos";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    return $fetch;
}

$prospectos = GetProspectos($pdo);

function GetListaProspectos($prospectos) {
    $options = '';
    foreach ($prospectos as $prospecto) {
        $value = htmlspecialchars($prospecto['ProspectoId']); // Asegúrate de usar la clave correcta para el ID
        $label = htmlspecialchars($prospecto['ProspectoNombre']); // Asegúrate de usar la clave correcta para el nombre
        $options .= "<option value=\"$value\">$label</option>\n";
    }
    return $options;
}

function GetFinanciamientoData($financiamientos, $pdo) {
    $financiamientoSeleccionado = isset($financiamientos) ? explode(',', $financiamientos) : [];

    $options = '';

    $query = "SELECT * FROM financiamiento";
    $result = $pdo->prepare($query);
    $result->execute();
    $consulta = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($consulta as $data) {
        $value = htmlspecialchars($data['FinanciamientoId']);
        $label = htmlspecialchars($data['FinanciamientoNombre']);
        $selected = in_array($value, $financiamientoSeleccionado) ? 'selected' : '';

        $options .= "<option value=\"$value\" $selected>$label</option>\n";
    }

    return $options;
}

function GetGravamen($gravamen) {
    if ($gravamen === 1) {
        echo '<option selected value="1">Si</option>
              <option value="0">No</option>';
    } else {
        echo '<option value="1">Si</option>
              <option selected value="0">No</option>';
    }
}

function InsertPropiedades($titulo, $tipo, $operacion, $financiamiento, $gravamen, $uso, $antiguedad, $asesor, 
    $status, $publicar, $precioVenta, $precioRenta, $moneda, $descripcion, $pdo) {
    // Sanitización de datos
    $titulo = filter_var($titulo, FILTER_SANITIZE_STRING);
    $tipo = filter_var($tipo, FILTER_SANITIZE_NUMBER_INT);
    $operacion = filter_var($operacion, FILTER_SANITIZE_NUMBER_INT);
    $gravamen = filter_var($gravamen, FILTER_SANITIZE_NUMBER_INT);
    $uso = filter_var($uso, FILTER_SANITIZE_NUMBER_INT);
    $antiguedad = filter_var($antiguedad, FILTER_SANITIZE_NUMBER_INT);
    $asesor = filter_var($asesor, FILTER_SANITIZE_NUMBER_INT);
    $status = filter_var($status, FILTER_SANITIZE_NUMBER_INT);
    $publicar = filter_var($publicar, FILTER_SANITIZE_NUMBER_INT);
    //$precioVenta = filter_var($precioVenta, FILTER_SANITIZE_NUMBER_INT);
    //$precioRenta = filter_var($precioRenta, FILTER_SANITIZE_NUMBER_INT);
    $moneda = filter_var($moneda, FILTER_SANITIZE_NUMBER_INT);
    $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
    
    // Convertir financiamiento en string
    $financiamientoString = implode(',', array_map('intval', $financiamiento));
    
    try {
        // Obtener el prefijo de acuerdo a tipo y operación
        $tipoOperacionCodigo = [
            '1' => 'C', // Casa
            '2' => 'D', // Departamento
            '3' => 'H', // Hacienda
        ];
        $operacionCodigo = [
            '1' => 'V', // Venta
            '2' => 'R', // Renta
        ];
        
        $tipoPrefix = isset($tipoOperacionCodigo[$tipo]) ? $tipoOperacionCodigo[$tipo] : 'X';
        $operacionPrefix = isset($operacionCodigo[$operacion]) ? $operacionCodigo[$operacion] : 'X';
        
        // Obtener el último folio registrado con el mismo tipo y operación
        $stmtLastFolio = $pdo->prepare("SELECT PropiedadFolio FROM propiedades WHERE PropiedadTipo = :tipo AND PropiedadOperacion = :operacion ORDER BY PropiedadId DESC LIMIT 1");
        $stmtLastFolio->execute([':tipo' => $tipo, ':operacion' => $operacion]);
        $lastFolio = $stmtLastFolio->fetchColumn();
        
        // Obtener el número secuencial del último folio
        if ($lastFolio) {
            $lastNumber = (int) preg_replace('/[^0-9]/', '', $lastFolio);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        // Generar el nuevo folio
        $folio = $tipoPrefix . $operacionPrefix . $nextNumber;
        
        // Inserción de la propiedad
        $stmt = $pdo->prepare("INSERT INTO propiedades 
            (PropiedadFolio, PropiedadTitulo, PropiedadTipo, PropiedadOperacion, PropiedadFinanciamiento, PropiedadGravamen, 
            PropiedadUso, PropiedadAntiguedad, PropiedadAsesor, PropiedadStatus, PropiedadPublicar, 
            PropiedadVenta, PropiedadRenta, PropiedadMoneda, 
            PropiedadDescripcion, PropiedadVigencia) 
            VALUES 
            (:folio, :titulo, :tipo, :operacion, :financiamiento, :gravamen, :uso, :antiguedad, :asesor, 
            :status, :publicar, :precioVenta, :precioRenta, :moneda, 
            :descripcion, 1)");

        $stmt->bindParam(':folio', $folio);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);
        $stmt->bindParam(':operacion', $operacion, PDO::PARAM_INT);
        $stmt->bindParam(':financiamiento', $financiamientoString);
        $stmt->bindParam(':gravamen', $gravamen, PDO::PARAM_INT);
        $stmt->bindParam(':uso', $uso, PDO::PARAM_INT);
        $stmt->bindParam(':antiguedad', $antiguedad, PDO::PARAM_INT);
        $stmt->bindParam(':asesor', $asesor, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':publicar', $publicar, PDO::PARAM_INT);
        $stmt->bindValue(':precioVenta', $precioVenta, is_null($precioVenta) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':precioRenta', $precioRenta, is_null($precioRenta) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindParam(':moneda', $moneda, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->execute();

        // Obtener el ID de la propiedad insertada
        $propiedadId = $pdo->lastInsertId();

        // Insertar características con valores NULL
        $stmtCaracteristicas = $pdo->prepare("INSERT INTO propiedad_caracteristicas (PropiedadId, CaracteristicaId, Valor) VALUES (:propiedadId, :caracteristicaId, NULL)");
        
        for ($i = 1; $i <= 40; $i++) {
            $stmtCaracteristicas->execute([
                ':propiedadId' => $propiedadId,
                ':caracteristicaId' => $i
            ]);
        }
        
        return $folio; // Devuelve el folio generado

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrarP'])) {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $operacion = $_POST['operacion'];
    $financiamiento = $_POST['financiamiento'];
    $gravamen = $_POST['gravamen'];
    $uso = $_POST['uso'];
    $antiguedad = $_POST['antiguedad'];
    $asesor = $_POST['asesor'];
    $status = $_POST['status'];
    $publicar = isset($_POST['publicar']) ? $_POST['publicar'] : 0;
    $precioVenta = isset($_POST['precioVenta']) && $_POST['precioVenta'] !== '' ? (int)$_POST['precioVenta'] : null;
    $precioRenta = isset($_POST['precioRenta']) && $_POST['precioRenta'] !== '' ? (int)$_POST['precioRenta'] : null;    
    $moneda = $_POST['moneda'];
    $descripcion = $_POST['descripcion'];

    if (InsertPropiedades($titulo, $tipo, $operacion, $financiamiento, $gravamen, $uso, $antiguedad, $asesor, $status, $publicar, $precioVenta, $precioRenta, $moneda, $descripcion, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Propiedad registrada correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'v_propiedades.php';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al registrar la propiedad.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function UpdatePropiedades($titulo, $tipo, $operacion, $financiamiento, $gravamen, $uso, $antiguedad, $asesor, 
    $status, $publicar, $precioVenta, $precioRenta, $moneda, $descripcion, $PropiedadId, $pdo) {

    $titulo = filter_var($titulo, FILTER_SANITIZE_STRING);
    $tipo = filter_var($tipo, FILTER_SANITIZE_NUMBER_INT);
    $operacion = filter_var($operacion, FILTER_SANITIZE_NUMBER_INT);
    $gravamen = filter_var($gravamen, FILTER_SANITIZE_NUMBER_INT);
    $uso = filter_var($uso, FILTER_SANITIZE_NUMBER_INT);
    $antiguedad = filter_var($antiguedad, FILTER_SANITIZE_NUMBER_INT);
    $asesor = filter_var($asesor, FILTER_SANITIZE_NUMBER_INT);
    $status = filter_var($status, FILTER_SANITIZE_NUMBER_INT);
    $publicar = filter_var($publicar, FILTER_SANITIZE_NUMBER_INT);
    //$precioVenta = filter_var($precioVenta, FILTER_SANITIZE_NUMBER_INT);
    //$precioRenta = filter_var($precioRenta, FILTER_SANITIZE_NUMBER_INT);
    $moneda = filter_var($moneda, FILTER_SANITIZE_NUMBER_INT);
    $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);

    // Convertir el arreglo de financiamientos a una cadena separada por comas
    $financiamientoString = implode(',', array_map('intval', $financiamiento)); // Sanitiza los valores como enteros
 
    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE propiedades SET 
            PropiedadTitulo = :titulo,
            PropiedadTipo = :tipo,
            PropiedadOperacion = :operacion,
            PropiedadFinanciamiento = :financiamiento,
            PropiedadGravamen = :gravamen,
            PropiedadUso = :uso,
            PropiedadAntiguedad = :antiguedad,
            PropiedadAsesor = :asesor,
            PropiedadStatus = :status,
            PropiedadPublicar = :publicar,
            PropiedadVenta = :precioVenta,
            PropiedadRenta = :precioRenta,
            PropiedadMoneda = :moneda,
            PropiedadDescripcion = :descripcion
        WHERE PropiedadId = :id");

        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);
        $stmt->bindParam(':operacion', $operacion, PDO::PARAM_INT);
        $stmt->bindParam(':financiamiento', $financiamientoString);
        $stmt->bindParam(':gravamen', $gravamen, PDO::PARAM_INT);
        $stmt->bindParam(':uso', $uso, PDO::PARAM_INT);
        $stmt->bindParam(':antiguedad', $antiguedad, PDO::PARAM_INT);
        $stmt->bindParam(':asesor', $asesor, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':publicar', $publicar, PDO::PARAM_INT);
        $stmt->bindValue(':precioVenta', $precioVenta, is_null($precioVenta) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':precioRenta', $precioRenta, is_null($precioRenta) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindParam(':moneda', $moneda, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id', $PropiedadId);
        $stmt->execute();

        $stmt->execute([
            ':titulo' => $titulo,
            ':tipo' => $tipo,
            ':operacion' => $operacion,
            ':financiamiento' => $financiamientoString,
            ':gravamen' => $gravamen,
            ':uso' => $uso,
            ':antiguedad' => $antiguedad,
            ':asesor' => $asesor,
            ':status' => $status,
            ':publicar' => $publicar,
            ':precioVenta' => $precioVenta,
            ':precioRenta' => $precioRenta,
            ':moneda' => $moneda,
            ':descripcion' => $descripcion,
            ':id' => $PropiedadId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarP'])) {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $operacion = $_POST['operacion'];
    $financiamiento = $_POST['financiamiento'];
    $gravamen = $_POST['gravamen'];
    $uso = $_POST['uso'];
    $antiguedad = $_POST['antiguedad'];
    $asesor = $_POST['asesor'];
    $status = $_POST['status'];
    $publicar = isset($_POST['publicar']) ? $_POST['publicar'] : 0;
    $precioVenta = isset($_POST['precioVenta']) && $_POST['precioVenta'] !== '' ? (int)$_POST['precioVenta'] : null;
    $precioRenta = isset($_POST['precioRenta']) && $_POST['precioRenta'] !== '' ? (int)$_POST['precioRenta'] : null;
    $moneda = $_POST['moneda'];
    $descripcion = $_POST['descripcion'];

    if (UpdatePropiedades($titulo, $tipo, $operacion, $financiamiento, $gravamen, $uso, $antiguedad, $asesor, $status, $publicar, $precioVenta, $precioRenta, $moneda, $descripcion, $PropiedadId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios realizados correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
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

function InsertMultipleFotos($fotos, $id, $pdo) {

 
    try {
        // Inserción principal
        $query = "INSERT INTO fotos (FotoArchivo, FotoPropiedad, FotoPrincipal) VALUES (:foto, :propiedad, 0)";
        $stmt = $pdo->prepare($query);
        
        foreach ($fotos as $foto) {
            $stmt->bindParam(':propiedad', $id, PDO::PARAM_INT);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
            $stmt->execute();
        }

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarFotos'])) {
    $fotos = [];

    // Recorrer todas las imágenes subidas
    foreach ($_FILES['fotos']['tmp_name'] as $index => $tmp_name) {
        if ($_FILES['fotos']['error'][$index] === UPLOAD_ERR_OK) {
            $fotos[] = file_get_contents($tmp_name);
        } else {
            echo "Error con la imagen número " . ($index + 1);
        }
    }

    if (!empty($fotos) && InsertMultipleFotos($fotos, $PropiedadId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Fotos guardadas correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al guardar las fotos.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function InsertCaracteristicas($id, $caracteristicas, $pdo) {
    
    try {

        $stmt = $pdo->prepare("UPDATE propiedad_caracteristicas SET Valor = :valor WHERE PropiedadId = :propiedadid AND CaracteristicaId = :caracteristicaid");
        
            foreach ($caracteristicas as $caracteristica) {

            $stmt->execute([
                ':propiedadid' => $id,
                ':caracteristicaid' => $caracteristica['id'],
                ':valor' => $caracteristica['valor']
            ]);

        }

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrarC'])) {
    // Definimos las características y sus IDs
    $caracteristicas_con_id = [
        "metrosCuadrados" => 1, 
        "recamaras" => 2, 
        "banos" => 3, 
        "medioBano" => 4,
        "estacionamiento" => 5, 
        "cuartoServicio" => 9, 
        "jardin" => 19, 
        "metrosTerreno" => 32,
        "frente" => 33, 
        "fondo" => 34, 
        "cocinaIntegral" => 7, 
        "cuartoLavado" => 8,
        "albercaPrivada" => 10, 
        "salaTv" => 11, 
        "areaBlancos" => 12, 
        "patio" => 14,
        "cisterna" => 15, 
        "cocineta" => 16, 
        "gimnasioPrivado" => 23, 
        "caverna" => 30,
        "formaRegular" => 35, 
        "formaIrregular" => 36, 
        "desvan" => 40, 
        "seguridadPrivada" => 6,
        "cctv" => 13, 
        "calentadorAgua" => 17, 
        "tinaco" => 18, 
        "tanqueEstacionario" => 20,
        "porton" => 21, 
        "lavadoraSecadora" => 27, 
        "internet" => 28, 
        "energiaElectrica" => 38,
        "aguaPotable" => 39, 
        "areaDeportiva" => 22, 
        "gimnasioComun" => 24, 
        "parques" => 25,
        "albercaComun" => 26, 
        "jacuzzi" => 31
    ];

    // Procesar las características, asegurando que los valores vacíos sean 0
    $caracteristicas = [];
    foreach ($caracteristicas_con_id as $nombre => $id) {
        $valor = isset($_POST[$nombre]) && $_POST[$nombre] !== '' ? intval($_POST[$nombre]) : 0;
        $caracteristicas[] = ["id" => $id, "valor" => $valor];
    }

    // Llamar a la función para insertar las características
    if (InsertCaracteristicas($PropiedadId, $caracteristicas, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Características guardadas exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "'; 
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al guardar las características.',
                    icon: 'error'
                });
            });
        </script>";
    }
}


function UpdatePropietario($propietario, $llaves, $comision, $contrato, $notificacion, $PropiedadId, $pdo) {

    $propietario = filter_var($propietario, FILTER_SANITIZE_NUMBER_INT);
    $llaves = filter_var($llaves, FILTER_SANITIZE_NUMBER_INT);
    $comision = filter_var($comision, FILTER_SANITIZE_NUMBER_INT);
    $contrato = filter_var($contrato, FILTER_SANITIZE_NUMBER_INT);
    $notificacion = filter_var($notificacion, FILTER_SANITIZE_NUMBER_INT);
 
    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE propiedades SET 
            PropiedadPropietario = :propietario,
            PropiedadLlaves = :llaves,
            PropiedadComisionSolicitada = :comision,
            PropiedadContrato = :contrato,
            PropiedadNotificacion = :notificacion
        WHERE PropiedadId = :id");

        $stmt->execute([
            ':propietario' => $propietario,
            ':llaves' => $llaves,
            ':comision' => $comision,
            ':contrato' => $contrato,
            ':notificacion' => $notificacion,
            'id' => $PropiedadId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarPropietario'])) {
    $propietario = $_POST['propietario'];
    $llaves = $_POST['llaves'];
    $comision = $_POST['comision'];
    $contrato = $_POST['contrato'];
    $notificacion = isset($_POST['notificacion']) ? $_POST['notificacion'] : 0;

    if (UpdatePropietario($propietario, $llaves, $comision, $contrato, $notificacion, $PropiedadId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios realizados correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
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

function InsertDocumentacion($documento, $PropiedadId, $DocumentacionId, $TipoMime, $pdo) {
    try {
        $query = "INSERT INTO documentacion_propiedad (PropiedadId, TipoDocumentacion, Documento, TipoDocumento) 
                  VALUES (:id_propiedad, :id_documentacion, :documento, :tipo_mime)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_propiedad', $PropiedadId, PDO::PARAM_INT);
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
                if (InsertDocumentacion($contenidoArchivo, $PropiedadId, $tipoDocumentacion, $tipoMime, $pdo)) {
                    echo "
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'Documento guardado correctamente.',
                                icon: 'success'
                            }).then(() => {
                                window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "'; 
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


function GetDocumentacionPropiedad($id, $pdo) {
    $query = "SELECT * FROM documentacion_propiedad INNER JOIN documentacion ON documentacion_propiedad.TipoDocumentacion = documentacion.DocumentacionId WHERE PropiedadId = :id";
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

$dataDocumentacionPropiedad = GetDocumentacionPropiedad($PropiedadId, $pdo);

function EliminarDocumento($id, $pdo) {
    try {

        $query = "DELETE FROM documentacion_propiedad WHERE DocumentoId = :id";
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
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
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
    $query = "SELECT Documento, TipoDocumento FROM documentacion_propiedad WHERE DocumentoId = :id";
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
    $query = "SELECT Documento, TipoDocumento FROM documentacion_propiedad WHERE DocumentoId = :id";
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

function UpdateCierre($fecha, $monto, $asesor, $prospecto, $comision, $dias, $PropiedadId, $pdo) {

    $fecha = filter_var($fecha, FILTER_SANITIZE_STRING);
    $monto = filter_var($monto, FILTER_SANITIZE_NUMBER_INT);
    $asesor = filter_var($asesor, FILTER_SANITIZE_NUMBER_INT);
    $prospecto = filter_var($prospecto, FILTER_SANITIZE_NUMBER_INT);
    $comision = filter_var($comision, FILTER_SANITIZE_NUMBER_INT);
    $dias = filter_var($dias, FILTER_SANITIZE_NUMBER_INT);
 
    try {
        // Inserción principal
        $stmt = $pdo->prepare("UPDATE propiedades SET 
            PropiedadFechaCierre = :fecha,
            PropiedadMonto = :monto,
            PropiedadAsesorCierre = :asesor,
            PropiedadProspecto = :prospecto,
            PropiedadComisionCierre = :comision,
            PropiedadDiasComision = :dias
        WHERE PropiedadId = :id");

        $stmt->execute([
            ':fecha' => $fecha,
            ':monto' => $monto,
            ':asesor' => $asesor,
            ':prospecto' => $prospecto,
            ':comision' => $comision,
            ':dias' => $dias,
            'id' => $PropiedadId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarCierre'])) {
    $fecha = $_POST['fecha'];
    $monto = $_POST['monto_operacion'];
    $asesor = $_POST['asesor'];
    $prospecto = $_POST['prospecto'];
    $comision = $_POST['comision'];
    $dias = $_POST['dias_comision'];

    if (UpdateCierre($fecha, $monto, $asesor, $prospecto, $comision, $dias, $PropiedadId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Cambios realizados correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
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

function DesactivarPropiedad($PropiedadId, $pdo) {
    
    try {

        $stmt = $pdo->prepare("UPDATE propiedades SET PropiedadVigencia = 0 WHERE PropiedadId = :id");
        $stmt->execute([':id' => $PropiedadId]);
        return true;

    } catch (PDOException $e) {
        echo "Error al registrar la propiedad: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarPropiedad'])) {
    $PropiedadId= $_POST['PropiedadId'];

    if (DesactivarPropiedad($PropiedadId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Propiedad eliminada correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'v_propiedades.php';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al eliminar la propiedad.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function GenerarExcel($pdo) {
    try {
        // Consulta para obtener los datos con el nombre completo del asesor
        $query = "SELECT PropiedadFolio, t.TipoNombre, o.OperacionNombre, PropiedadTitulo, s.StatusNombre, 
                         PropiedadVenta, PropiedadRenta, m.MonedaNombre, PropiedadGravamen, 
                         a.AntiguedadNombre, 
                         CONCAT_WS(' ', asesores.AsesorNombre, asesores.AsesorApellidoPaterno, asesores.AsesorApellidoMaterno) AS AsesorNombreCompleto, PropiedadCp, CONCAT_WS(' ', PropiedadCalle, PropiedadNumero, PropiedadReferencia) AS PropiedadDireccion, PropiedadColonia, PropiedadMunicipio, PropiedadEstado, pr.PropietariosNombre
                  FROM propiedades p 
                  INNER JOIN tipo t ON p.PropiedadTipo = t.TipoId 
                  INNER JOIN operacion o ON p.PropiedadOperacion = o.OperacionId 
                  INNER JOIN status s ON p.PropiedadStatus = s.StatusId 
                  INNER JOIN moneda m ON p.PropiedadMoneda = m.MonedaId 
                  INNER JOIN antiguedad a ON p.PropiedadAntiguedad = a.AntiguedadId 
                  INNER JOIN asesores ON p.PropiedadAsesor = asesores.AsesorId
                  LEFT JOIN propietarios pr ON p.PropiedadPropietario = pr.PropietariosId
                  WHERE PropiedadVigencia = 1";

        $result = $pdo->prepare($query);
        $result->execute();
        $fetch = $result->fetchAll(PDO::FETCH_ASSOC);

        // Cargar la plantilla de Excel
        $spreadsheet = IOFactory::load('../doc/lista_propiedades.xlsx');
        $sheet = $spreadsheet->getActiveSheet();

        $fila = 4; // Comenzar en la fila 4
        $columnaInicio = 'B'; // Comenzar en la columna B

        foreach ($fetch as $row) {
            $columna = $columnaInicio;

            foreach ($row as $key => $value) {
                // Si la clave es PropiedadGravamen, cambiar el valor a "Sí" o "No"
                if ($key === 'PropiedadGravamen') {
                    $value = ($value == 1) ? 'Sí' : 'No';
                }

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
        header('Content-Disposition: attachment; filename="lista_propiedades.xlsx"');
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

function ActualizarDireccion($cp, $estado, $municipio, $colonia, $calle, $numero, $referencia, $PropiedadId, $pdo) {

    $cp = filter_var($cp, FILTER_SANITIZE_NUMBER_INT);
    $estado = filter_var($estado, FILTER_SANITIZE_STRING);
    $municipio = filter_var($municipio, FILTER_SANITIZE_STRING);
    $colonia = filter_var($colonia, FILTER_SANITIZE_STRING);
    $calle = filter_var($calle, FILTER_SANITIZE_STRING);
    $numero = filter_var($numero, FILTER_SANITIZE_STRING);
    $referencia = filter_var($referencia, FILTER_SANITIZE_STRING);
    
    try {

        $stmt = $pdo->prepare("UPDATE propiedades SET 
        PropiedadCp = :cp,
        PropiedadEstado = :estado,
        PropiedadMunicipio = :municipio,
        PropiedadColonia = :colonia,
        PropiedadCalle = :calle,
        PropiedadNumero = :numero,
        PropiedadReferencia = :referencia 
        WHERE PropiedadId = :id");
        $stmt->execute([
            ':cp' => $cp,
            ':estado' => $estado,
            ':municipio' => $municipio,
            ':colonia' => $colonia,
            ':calle' => $calle,
            ':numero' => $numero,
            ':referencia' => $referencia,
            ':id' => $PropiedadId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al actualizar la direccion: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarDireccion'])) {
    $cp = $_POST['cp'];
    $estado = $_POST['estado'];
    $municipio = $_POST['municipio'];
    $colonia = $_POST['asentamiento'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $referencia = $_POST['referencia'];

    if (ActualizarDireccion($cp, $estado, $municipio, $colonia, $calle, $numero, $referencia, $PropiedadId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Dirección de la propiedad modificada exitosamente.',
                    icon: 'success'
            }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al modificar la dirección de la propiedad.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function EliminarFoto($FotoId, $pdo) {
    
    try {

        $stmt = $pdo->prepare("DELETE FROM fotos  
        WHERE FotoId = :id");
        $stmt->execute([
            ':id' => $FotoId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al actualizar la direccion: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarFoto'])) {
    $FotoId = $_POST['FotoId'];

    if (EliminarFoto($FotoId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Foto eliminada exitosamente.',
                    icon: 'success'
            }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al eliminar la foto.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function PrincipalFoto($FotoId, $pdo) {
    
    try {

        $stmt = $pdo->prepare("UPDATE fotos SET
        FotoPrincipal = 1
        WHERE FotoId = :id");
        $stmt->execute([
            ':id' => $FotoId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al actualizar la foto: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['principalFoto'])) {
    $FotoId = $_POST['FotoId'];

    if (PrincipalFoto($FotoId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'La foto se establecio como principal.',
                    icon: 'success'
            }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al establecer esta foto como principal.',
                    icon: 'error'
                });
            });
        </script>";
    }
}

function QuitarFotoPrincipal($FotoId, $pdo) {
    
    try {

        $stmt = $pdo->prepare("UPDATE fotos SET
        FotoPrincipal = 0
        WHERE FotoId = :id");
        $stmt->execute([
            ':id' => $FotoId
        ]);

        return true;

    } catch (PDOException $e) {
        echo "Error al actualizar la foto: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quitarPrincipalFoto'])) {
    $FotoId = $_POST['FotoId'];

    if (QuitarFotoPrincipal($FotoId, $pdo)) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Se ha quitado la foto como principal.',
                    icon: 'success'
            }).then(() => {
                    window.location.href = 'e_propiedades.php?id=" . $PropiedadId . "';
                });
            });
        </script>";
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al establecer esta foto como principal.',
                    icon: 'error'
                });
            });
        </script>";
    }
}