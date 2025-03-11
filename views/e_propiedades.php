<?php 
require '../controllers/propiedades.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Red Inmobiliaria</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Red Inmobiliaria</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Principal
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="v_propiedades.php">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Propiedades</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="v_asesores.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Asesores</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="v_propietarios.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Propietarios</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="v_prospectos.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Prospectos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $sesion['AsesorNombre'] ?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Propiedades</h1>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header">
                                    Actualizar datos
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="datos_generales-tab" data-toggle="tab"
                                                href="#datos_generales" role="tab" aria-controls="datos_generales"
                                                aria-selected="true">Datos Generales</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="mapa-tab" data-toggle="tab" href="#mapa" role="tab"
                                                aria-controls="mapa" aria-selected="false">
                                                <i class="fas fa-map-marker-alt"></i> Mapa
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="caracteristicas-tab" data-toggle="tab"
                                                href="#caracteristicas" role="tab" aria-controls="caracteristicas"
                                                aria-selected="false">
                                                <i class="fas fa-clipboard-check"></i> Características
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="fotografias-tab" data-toggle="tab"
                                                href="#fotografias" role="tab" aria-controls="fotografias"
                                                aria-selected="false">
                                                <i class="fas fa-camera"></i> Fotografias
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="condiciones_propietario-tab" data-toggle="tab"
                                                href="#condiciones_propietario" role="tab"
                                                aria-controls="condiciones_propietario" aria-selected="false">
                                                <i class="fas fa-user"></i> Propietario
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="documento-tab" data-toggle="tab" href="#documento"
                                                role="tab" aria-controls="documento" aria-selected="false">
                                                <i class="fas fa-file-alt"></i> Documentación
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="cierre-tab" data-toggle="tab" href="#cierre"
                                                role="tab" aria-controls="cierre" aria-selected="false">
                                                <i class="fas fa-door-closed"></i> Cierre
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="datos_generales" role="tabpanel"
                                            aria-labelledby="datos_generales-tab">
                                            <br>
                                            <form method="POST">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="inputState">Titulo:</label>
                                                        <input name="titulo" type="text" class="form-control"
                                                            value="<?php echo $dataPropiedad['PropiedadTitulo'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Tipo Inmueble:</label>
                                                        <select name="tipo" id="inputState" class="form-control"
                                                            required>
                                                            <option value="<?php echo $dataPropiedad['TipoId'] ?>"
                                                                selected>
                                                                <?php echo $dataPropiedad['TipoNombre'] ?></option>
                                                            <?php echo GetListaTipo($tipos); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Tipo Operación:</label>
                                                        <select name="operacion" id="inputState" class="form-control"
                                                            required>
                                                            <option value="<?php echo $dataPropiedad['OperacionId'] ?>"
                                                                selected>
                                                                <?php echo $dataPropiedad['OperacionNombre'] ?></option>
                                                            <?php echo GetListaOperaciones($operaciones); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Financiamiento:</label>
                                                        <select name="financiamiento[]" id="financiamiento"
                                                            class="form-control" multiple required>
                                                            <?php echo GetFinanciamientoData($dataPropiedad['PropiedadFinanciamiento'], $pdo); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Libre Gravamen:</label>
                                                        <select name="gravamen" id="inputState" class="form-control"
                                                            required>
                                                            <option selected>Seleccionar</option>
                                                            <?php echo GetGravamen($dataPropiedad['PropiedadGravamen']) ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Uso Suelo:</label>
                                                        <select name="uso" id="inputState" class="form-control"
                                                            required>
                                                            <option value="<?php echo $dataPropiedad['UsoId'] ?>"
                                                                selected>
                                                                <?php echo $dataPropiedad['UsoNombre'] ?></option>
                                                            <?php echo GetListaUsos($usos); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Antiguedad:</label>
                                                        <select name="antiguedad" id="inputState" class="form-control"
                                                            required>
                                                            <option
                                                                value="<?php echo $dataPropiedad['PropiedadAntiguedad'] ?>"
                                                                selected>
                                                                <?php echo $dataPropiedad['AntiguedadNombre'] ?>
                                                            </option>
                                                            <?php echo GetListaAntiguedad($antiguedad); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Asesor:</label>
                                                        <select name="asesor" id="inputState" class="form-control"
                                                            required>
                                                            <option
                                                                value="<?php echo $dataPropiedad['PropiedadAsesor'] ?>"
                                                                selected>
                                                                <?php echo $dataPropiedad['AsesorNombre'] . " " . $dataPropiedad['AsesorApellidoPaterno'] . " " . $dataPropiedad['AsesorApellidoMaterno'] ?>
                                                            </option>
                                                            <?php echo GetListaAsesores($asesores); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Estatus Interno:</label>
                                                        <select name="status" id="inputState" class="form-control"
                                                            required>
                                                            <option
                                                                value="<?php echo $dataPropiedad['PropiedadStatus'] ?>"
                                                                selected>
                                                                <?php echo $dataPropiedad['StatusNombre'] ?></option>
                                                            <?php echo GetListaStatus($status); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-check form-switch col-md-4">
                                                        <input name="publicar" class="form-check-input" type="checkbox"
                                                            role="switch" <?php echo EvaluarCheckbox($dataPropiedad['PropiedadPublicar']) ?> id="flexSwitchCheckDefault" value="1">
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckDefault">Publicar</label>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="inputState">Precio Venta:</label>
                                                        <input name="precioVenta" type="number" id="precioVenta" class="form-control"
                                                            value="<?php echo $dataPropiedad['PropiedadVenta'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Precio Renta:</label>
                                                        <input name="precioRenta" type="number" id="precioRenta" class="form-control"
                                                            value="<?php echo $dataPropiedad['PropiedadRenta'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Moneda</label>
                                                        <select name="moneda" id="inputState" class="form-control"
                                                            required>
                                                            <option value="<?php echo $dataPropiedad['MonedaId'] ?>"
                                                                selected><?php echo $dataPropiedad['MonedaNombre'] ?>
                                                            </option>
                                                            <?php echo GetListaMoneda($monedas); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>
                                                <br>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleFormControlTextarea1">Descipción (140
                                                            caracteres máximo):</label>
                                                        <textarea name="descripcion" class="form-control"
                                                            id="exampleFormControlTextarea1" rows="3"
                                                            required><?php echo $dataPropiedad['PropiedadDescripcion'] ?></textarea>
                                                    </div>
                                                    <button type="submit" name="actualizarP"
                                                        class="btn btn-secondary btn-lg btn-block">Actualizar
                                                        Datos</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="mapa" role="tabpanel" aria-labelledby="mapa-tab">
                                        <br>
                                        <form method="POST" id="addressproperty_form">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="inputState">Codigo Postal:</label>
                                                    <input name="cp" id="cp" type="text" class="form-control"
                                                        autocomplete="off"
                                                        value="<?php echo $dataPropiedad['PropiedadCp'] ?>" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="inputState">Estado:</label>
                                                    <input name="estado" id="estado" type="text" class="form-control"
                                                        value="<?php echo $dataPropiedad['PropiedadEstado'] ?>" readonly
                                                        required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="inputState">Municipio:</label>
                                                    <input name="municipio" id="municipio" type="text"
                                                        class="form-control"
                                                        value="<?php echo $dataPropiedad['PropiedadMunicipio'] ?>"
                                                        readonly required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="inputState">Asentamiento:</label>
                                                    <input name="asentamiento" id="asentamiento" type="text"
                                                        class="form-control"
                                                        value="<?php echo $dataPropiedad['PropiedadColonia'] ?>"
                                                        readonly required>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="id_calle"> Calle:</label>
                                                        <input type="text" name="calle" maxlength="100" required
                                                            id="id_calle" class="form-control"
                                                            value="<?php echo $dataPropiedad['PropiedadCalle'] ?>">
                                                        <span id="error_id_calle" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="id_numero"> Numero:</label>
                                                        <input type="text" name="numero" maxlength="100" required
                                                            id="id_numero" class="form-control"
                                                            value="<?php echo $dataPropiedad['PropiedadNumero'] ?>">
                                                        <span id="error_id_numero" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="id_referencia"> Referencia:</label>
                                                        <textarea name="referencia" cols="40" rows="4" maxlength="500"
                                                            required id="id_referencia"
                                                            class="form-control"><?php echo $dataPropiedad['PropiedadReferencia'] ?></textarea>
                                                        <span id="error_id_referencia" class="red"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" name="actualizarDireccion"
                                                    class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="caracteristicas" role="tabpanel">
                                        <br>

                                        <form method="POST" id="caracteristicas_form" novalidate="">
                                            <!--datos cuantitativos-->
                                            <h2>Características</h2>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="inputState">M2 de Construcción:</label>
                                                        <input name="metrosCuadrados" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['MetrosCuadrados'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">Recámaras:</label>
                                                        <input name="recamaras" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['Recamaras'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">Baños:</label>
                                                        <input name="banos" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['Baños'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">Medio Baño:</label>
                                                        <input name="medioBano" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['MedioBaño'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">Estacionamiento:</label>
                                                        <input name="estacionamiento" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['Estacionamiento'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">Cuarto de Servicio:</label>
                                                        <input name="cuartoServicio" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['CuartoServicio'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">Jardín:</label>
                                                        <input name="jardin" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['Jardin'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">M2 de Terreno:</label>
                                                        <input name="metrosTerreno" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['M2Terreno'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">Frente:</label>
                                                        <input name="frente" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['Frente'] ?>"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="inputState">Fondo:</label>
                                                        <input name="fondo" type="number" class="form-control"
                                                            value="<?php echo $propiedadCaracteristica['Fondo'] ?>"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="71" name="cocinaIntegral"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['CocinaIntegral']) ? EvaluarCheckbox($propiedadCaracteristica['CocinaIntegral']) : '' ?>>
                                                            <label for="71">Cocina Integral</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="83" name="cuartoLavado" value="1"
                                                                <?php echo isset($propiedadCaracteristica['CuartoLavado']) ? EvaluarCheckbox($propiedadCaracteristica['CuartoLavado']) : '' ?>>
                                                            <label for="83">Cuarto de Lavado</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="101" name="albercaPrivada"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['AlbercaPrivada']) ? EvaluarCheckbox($propiedadCaracteristica['AlbercaPrivada']) : '' ?>>
                                                            <label for="101">Alberca Privada</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="110" name="salaTv" value="1"
                                                                <?php echo isset($propiedadCaracteristica['SalaTV']) ? EvaluarCheckbox($propiedadCaracteristica['SalaTV']) : '' ?>>
                                                            <label for="110">Sala de TV</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="119" name="areaBlancos" value="1"
                                                                <?php echo isset($propiedadCaracteristica['AreaBlancos']) ? EvaluarCheckbox($propiedadCaracteristica['AreaBlancos']) : '' ?>>
                                                            <label for="119">Área de Blancos</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="140" name="patio" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Patio']) ? EvaluarCheckbox($propiedadCaracteristica['Patio']) : '' ?>>
                                                            <label for="140">Patio</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="152" name="cisterna" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Cisterna']) ? EvaluarCheckbox($propiedadCaracteristica['Cisterna']) : '' ?>>
                                                            <label for="152">Cisterna</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="165" name="cocineta" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Cocineta']) ? EvaluarCheckbox($propiedadCaracteristica['Cocineta']) : '' ?>>
                                                            <label for="165">Cocineta</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="250" name="gimnasioPrivado"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['GimnasioPrivado']) ? EvaluarCheckbox($propiedadCaracteristica['GimnasioPrivado']) : '' ?>>
                                                            <label for="250">Gimnasio Privado</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="353" name="caverna" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Caverna']) ? EvaluarCheckbox($propiedadCaracteristica['Caverna']) : '' ?>>
                                                            <label for="353">Caverna</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="407" name="formaRegular"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['FormaRegular']) ? EvaluarCheckbox($propiedadCaracteristica['FormaRegular']) : '' ?>>
                                                            <label for="407">Forma Regular</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="420" name="formaIrregular"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['FormaIrregular']) ? EvaluarCheckbox($propiedadCaracteristica['FormaIrregular']) : '' ?>>
                                                            <label for="420">Forma Irregular</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="461" name="desvan" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Desvan']) ? EvaluarCheckbox($propiedadCaracteristica['Desvan']) : '' ?>>
                                                            <label for="461">Desván</label><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Checkbox para datos no cuantitativos-->
                                            <hr>
                                            <h2>Servicios</h2>
                                            <br>
                                            <div>
                                                <div class="row">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="58" name="seguridadPrivada"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['SeguridadPrivada']) ? EvaluarCheckbox($propiedadCaracteristica['SeguridadPrivada']) : '' ?>>
                                                            <label for="58">Seguridad Privada</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="128" name="cctv" value="1"
                                                                <?php echo isset($propiedadCaracteristica['CCTV']) ? EvaluarCheckbox($propiedadCaracteristica['CCTV']) : '' ?>>
                                                            <label for="128">CCTV</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="177" name="calentadorAgua"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['CalentadorAgua']) ? EvaluarCheckbox($propiedadCaracteristica['CalentadorAgua']) : '' ?>>
                                                            <label for="177">Calentador de Agua</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="189" name="tinaco" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Tinaco']) ? EvaluarCheckbox($propiedadCaracteristica['Tinaco']) : '' ?>>
                                                            <label for="189">Tinaco</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="213" name="tanqueEstacionario"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['TanqueEstacionario']) ? EvaluarCheckbox($propiedadCaracteristica['TanqueEstacionario']) : '' ?>>
                                                            <label for="213">Tanque de Gas
                                                                Estacionanario</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="225" name="porton" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Porton']) ? EvaluarCheckbox($propiedadCaracteristica['Porton']) : '' ?>>
                                                            <label for="225">Portón</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="327" name="lavadoraSecadora"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['LavadoraSecadora']) ? EvaluarCheckbox($propiedadCaracteristica['LavadoraSecadora']) : '' ?>>
                                                            <label for="327">Lavadora Secadora</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="336" name="internet" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Internet']) ? EvaluarCheckbox($propiedadCaracteristica['Internet']) : '' ?>>
                                                            <label for="336">INTERNET</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="435" name="energiaElectrica"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['EnergiaElectrica']) ? EvaluarCheckbox($propiedadCaracteristica['EnergiaElectrica']) : '' ?>>
                                                            <label for="435">Energía Eléctrica</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="448" name="aguaPotable" value="1"
                                                                <?php echo isset($propiedadCaracteristica['AguaPotable']) ? EvaluarCheckbox($propiedadCaracteristica['AguaPotable']) : '' ?>>
                                                            <label for="448">Agua Potable</label><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h2>Amenidades</h2>
                                            <br>
                                            <div>
                                                <div class="row">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="237" name="areaDeportiva"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['AreaDeportiva']) ? EvaluarCheckbox($propiedadCaracteristica['AreaDeportiva']) : '' ?>>
                                                            <label for="237">Área Deportiva</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="260" name="gimnasioComun"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['GimnasioComun']) ? EvaluarCheckbox($propiedadCaracteristica['GimnasioComun']) : '' ?>>
                                                            <label for="260">Gimnasio de uso común</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="273" name="parques" value="1"
                                                                <?php echo isset($propiedadCaracteristica['Parques']) ? EvaluarCheckbox($propiedadCaracteristica['Parques']) : '' ?>>
                                                            <label for="273">Parques / Áreas verdes</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="286" name="albercaComun"
                                                                value="1"
                                                                <?php echo isset($propiedadCaracteristica['AlbercaComun']) ? EvaluarCheckbox($propiedadCaracteristica['AlbercaComun']) : '' ?>>
                                                            <label for="286">Alberca de uso común</label><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h2>Equipamientos</h2>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="357"> Jacuzzi:</label>
                                                            <input id="357" type="number" min="0"
                                                                value="<?php echo $propiedadCaracteristica['Jacuzzi'] ?>"
                                                                required="" class="form-control" name="jacuzzi">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" name="registrarC"
                                                    class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="fotografias" role="tabpanel"
                                        aria-labelledby="fotografias-tab">
                                        <br>
                                            <div class="text-left">
                                                <div class="row">
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label for="formFileMultiple" class="form-label">Fotos</label>
                                                        <input class="form-control" name="fotos[]" type="file"
                                                            id="formFileMultiple" multiple>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" name="guardarFotos"
                                                            class="btn btn-primary">Guardar</button>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <span id="error_id_archivo" class="red"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="table-responsive">
                                            <table class="table" id="fotos_table">
                                                <thead>
                                                    <tr>
                                                        <td>Fotografia</td>
                                                        <td>Principal</td>
                                                        <td>Opciones</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="photos">
                                                    <?php echo $fotos; ?>
                                                </tbody>
                                            </table>
                                            <button id="saveOrder" class="btn btn-outline-primary" disabled="">Guardar
                                                orden</button>
                                        </div>

                                        <div class="modal fade" id="modal-imagen_propiedad" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Vista
                                                            previa</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: center;">
                                                        <img class="img-fluid" id="imagen-modal" height="400px">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="condiciones_propietario" role="tabpanel"
                                        aria-labelledby="condiciones_propietario-tab">
                                        <br>
                                        <div class="text-right">
                                            <a href="r_propietarios.php" id="add-owner"
                                                class="btn btn-sm btn-primary shadow-sm mr-1 btn-lgr-inr">
                                                <i class="fas fa-plus fa-sm text-white-50"></i> Agregar propietario
                                            </a>
                                        </div>
                                        <hr>
                                        <form method="POST" id="condiciones_propietario_form" novalidate="">
                                            <input type="hidden" name="csrfmiddlewaretoken"
                                                value="1dHXzEd40p4mwRsO22RNvdFWnLmuTlAaE6pzmPf7ed7DVlIl525zH9G6ztCHmpQC">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Propietarios:</label>
                                                    <select name="propietario" id="inputState" class="form-control"
                                                        required>
                                                        <option
                                                            value="<?php echo $dataPropiedad['PropiedadPropietario'] ?>"
                                                            selected>
                                                            <?php echo $dataPropiedad['PropietariosNombre'] ?>
                                                        </option>
                                                        <?php echo GetListaPropietarios($propietarios); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Llaves:</label>
                                                    <select name="llaves" id="inputState" class="form-control" required>
                                                        <option value="<?php echo $dataPropiedad['LlaveId'] ?>"
                                                            selected>
                                                            <?php echo $dataPropiedad['LlaveNombre'] ?></option>
                                                        <?php echo GetListaLlaves($llaves); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_comision"> Comision:</label>
                                                        <input type="number" name="comision" id="id_comision"
                                                            class="form-control"
                                                            value="<?php echo $dataPropiedad['PropiedadComisionSolicitada'] ?>">
                                                        <span id="error_id_comision" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Tipo contrato:</label>
                                                    <select name="contrato" id="inputState" class="form-control"
                                                        required>
                                                        <option value="<?php echo $dataPropiedad['ContratoId'] ?>"
                                                            selected><?php echo $dataPropiedad['ContratoNombre'] ?>
                                                        </option>
                                                        <?php echo GetListaContratos($contratos); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_notificacion">
                                                            Notificación:</label>
                                                        <div>
                                                            <input type="checkbox" name="notificacion"
                                                                id="id_notificacion" value="1"
                                                                <?php echo EvaluarCheckbox($dataPropiedad['PropiedadNotificacion']) ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button name="actualizarPropietario" type="submit"
                                                    class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="documento" role="tabpanel"
                                        aria-labelledby="fotografias-tab">
                                        <br>
                                        <form method="POST" id="documento_propiedad_form" enctype="multipart/form-data"
                                            novalidate="">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Documentación:</label>
                                                    <select name="tipo" id="inputState" class="form-control" required>
                                                        <option disabled selected>Seleccionar</option>
                                                        <?php echo GetListaDocumentacion($documentacion); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="id_documento"> Documento:</label>
                                                        <span class="text-info">(JPEG, JPG, PDF). Tamaño máximo:
                                                            1.5MB</span>
                                                        <div>
                                                            <input type="file" name="archivo" id="id_archivo"
                                                                class="form-control" accept=".jpg, .jpeg, .pdf"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary"
                                                    name="guardarDocumentos">Guardar</button>
                                            </div>
                                        </form>
                                        <hr>
                                        <h4>Documentos</h4>
                                        <div class="document-container">
                                            <?php echo $dataDocumentacionPropiedad ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="cierre" role="tabpanel" aria-labelledby="cierre-tab">
                                        <br>
                                        <form method="POST" id="close_form">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_fecha"> Fecha:</label>
                                                        <input type="date" name="fecha" class="form-control" required=""
                                                            id="id_fecha">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_monto_operacion"> Monto operacion:</label>
                                                        <input type="number" name="monto_operacion" step="any"
                                                            required="" id="id_monto_operacion" class="form-control">
                                                        <span id="error_id_monto_operacion" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Asesor que cierra:</label>
                                                    <select name="asesor" id="inputState" class="form-control" required>
                                                        <option disabled selected>Seleccionar</option>
                                                        <?php echo GetListaAsesores($asesores); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Prospecto que compra o renta:</label>
                                                    <select name="prospecto" id="inputState" class="form-control"
                                                        required>
                                                        <option disabled selected>Seleccionar</option>
                                                        <?php echo GetListaProspectos($prospectos); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="id_comision"> Comision:</label>
                                                        <input type="number" name="comision" value="0" min="0"
                                                            required="" id="id_comision" class="form-control">
                                                        <span id="error_id_comision" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="id_dias_comision"> Dias comision:</label>
                                                        <input type="number" name="dias_comision" value="0" min="0"
                                                            required="" id="id_dias_comision" class="form-control">
                                                        <span id="error_id_dias_comision" class="red"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button id="close-form-button" type="submit" class="btn btn-primary"
                                                    name="actualizarCierre">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Powered by FastNet</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">¿Estas seguro de que quieres cerrar sesión?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <form method="POST">
                        <button name="cerrarSesion" class="btn btn-primary">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const precioVenta = document.getElementById('precioVenta');
        const precioRenta = document.getElementById('precioRenta');

            if (precioVenta.value.trim() !== "") {
                precioRenta.disabled = true;
                precioRenta.value = "";
            } else {
                precioRenta.disabled = false;
            }

            if (precioRenta.value.trim() !== "") {
                precioVenta.disabled = true;
                precioVenta.value = "";
            } else {
                precioVenta.disabled = false;
            }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWqYQAniQLOuWOSal10pEzZmJCaGyXqZI&libraries=places">
    </script>

    <script src="../js/maps.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script>
    new MultiSelectTag('financiamiento')
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOSJewu-OFH--i5UZZyBZ_r3Yijxx6b1c=places">
    </script>
    <script src="../js/maps.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>