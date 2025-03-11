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

function GetCantidadPropiedades($pdo) {
    $query = "SELECT t.TipoNombre, COUNT(p.PropiedadId) AS TotalPropiedades FROM tipo t LEFT JOIN propiedades p ON t.TipoId = p.PropiedadTipo GROUP BY t.TipoId, t.TipoNombre;";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '';

    foreach ($fetch as $propiedad) {
        $html.= '<tr role="row" class="odd">
                    <td>' . $propiedad['TipoNombre'] . '</td>
                    <td class="text-center">' . $propiedad['TotalPropiedades'] . '</td>
                </tr>';
    }

    return $html;
}

$cantidadPropiedades = GetCantidadPropiedades($pdo);

function GetCantidadOperaciones($pdo) {
    $query = "SELECT o.OperacionNombre, COUNT(p.PropiedadId) AS TotalPropiedades FROM operacion  o LEFT JOIN propiedades p ON o.OperacionId = p.PropiedadOperacion GROUP BY o.OperacionId, o.OperacionNombre;";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '';

    foreach ($fetch as $operacion) {
        $html.= '<tr role="row" class="odd">
                    <td>' . $operacion['OperacionNombre'] . '</td>
                    <td class="text-center">' . $operacion['TotalPropiedades'] . '</td>
                </tr>';
    }

    return $html;
}

$cantidadOperaciones = GetCantidadOperaciones($pdo);

function GetCantidadTipoOperacion($pdo) {
    $query = "SELECT t.TipoNombre, CASE WHEN p.PropiedadOperacion = 5 THEN 'Venta o Renta' WHEN p.PropiedadOperacion = 1 THEN 'Venta' WHEN p.PropiedadOperacion = 2 THEN 'Renta' ELSE 'Sin Definir' END AS TipoOperacion, COUNT(p.PropiedadId) AS TotalPropiedades FROM tipo t LEFT JOIN propiedades p ON t.TipoId = p.PropiedadTipo GROUP BY t.TipoNombre, TipoOperacion ORDER BY t.TipoNombre, TipoOperacion;";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '';

    foreach ($fetch as $tipoOperacion) {
        $html.= '<tr role="row" class="odd">
                    <td>' . $tipoOperacion['TipoNombre'] . '</td>
                    <td>' . $tipoOperacion['TipoOperacion'] . '</td>
                    <td class="text-center">' . $tipoOperacion['TotalPropiedades'] . '</td>
                </tr>';
    }

    return $html;
}

$cantidadTipoOperaciones = GetCantidadTipoOperacion($pdo);

function GetCantidadPropiedadesAsesor($pdo) {
    $query = "SELECT a.AsesorNombre, a.AsesorApellidoPaterno, a.AsesorApellidoMaterno, COUNT(p.PropiedadId) AS TotalPropiedades
                FROM asesores a
                LEFT JOIN propiedades p ON a.AsesorId = p.PropiedadAsesor
                GROUP BY a.AsesorId, a.AsesorNombre;";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '';

    if(empty($fetch)) {
        return '
        <tr class="odd">
            <td valign="top" colspan="2"
                class="dataTables_empty"> Sin resultados para
                mostrar</td>
        </tr>';
    }

    foreach ($fetch as $propiedadAsesores) {
        $html.= '<tr role="row" class="odd">
                    <td>' . $propiedadAsesores['AsesorNombre'] . " " . $propiedadAsesores['AsesorApellidoPaterno'] . " " . $propiedadAsesores['AsesorApellidoMaterno'] . '</td>
                    <td class="text-center">' . $propiedadAsesores['TotalPropiedades'] . '</td>
                </tr>';
    }

    return $html;
}

$cantidadPropiedadesAsesor = GetCantidadPropiedadesAsesor($pdo);

function GetCantidadCerradasAsesor($pdo) {
    $query = "SELECT a.AsesorNombre, a.AsesorApellidoPaterno, a.AsesorApellidoMaterno, COUNT(p.PropiedadId) AS TotalPropiedades
                FROM asesores a
                LEFT JOIN propiedades p ON a.AsesorId = p.PropiedadAsesor
                WHERE p.PropiedadStatus = 4 OR p.PropiedadStatus = 5
                GROUP BY a.AsesorId, a.AsesorNombre;";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '';

    if(empty($fetch)) {
        return '
        <tr class="odd">
            <td valign="top" colspan="2"
                class="dataTables_empty"> Sin resultados para
                mostrar</td>
        </tr>';
    }

    foreach ($fetch as $propiedadAsesores) {
        $html.= '<tr role="row" class="odd">
                    <td>' . $propiedadAsesores['AsesorNombre'] . " " . $propiedadAsesores['AsesorApellidoPaterno'] . " " . $propiedadAsesores['AsesorApellidoMaterno'] . '</td>
                    <td class="text-center">' . $propiedadAsesores['TotalPropiedades'] . '</td>
                </tr>';
    }

    return $html;
}

$cantidadCerradasAsesor = GetCantidadCerradasAsesor($pdo);

function GetCantidadProspectosAsesor($pdo) {
    $query = "SELECT a.AsesorNombre, a.AsesorApellidoPaterno, a.AsesorApellidoMaterno, COUNT(p.ProspectoId) AS TotalProspectos
                FROM asesores a
                LEFT JOIN prospectos p ON a.AsesorId = p.ProspectoAsesor
                GROUP BY a.AsesorId, a.AsesorNombre;";
    $result = $pdo->prepare($query);
    $result->execute();
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '';

    if(empty($fetch)) {
        return '
        <tr class="odd">
            <td valign="top" colspan="2"
                class="dataTables_empty"> Sin resultados para
                mostrar</td>
        </tr>';
    }

    foreach ($fetch as $prospectoAsesores) {
        $html.= '<tr role="row" class="odd">
                    <td>' . $prospectoAsesores['AsesorNombre'] . " " . $prospectoAsesores['AsesorApellidoPaterno'] . " " . $prospectoAsesores['AsesorApellidoMaterno'] . '</td>
                    <td class="text-center">' . $prospectoAsesores['TotalProspectos'] . '</td>
                </tr>';
    }

    return $html;
}

$cantidadProspectosAsesor = GetCantidadProspectosAsesor($pdo);