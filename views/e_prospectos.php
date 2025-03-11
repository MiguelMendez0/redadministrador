<?php 
require '../controllers/prospectos.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Red  Inmobiliaria</title>

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
            <li class="nav-item">
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
            <li class="nav-item active">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $sesion['AsesorNombre'] ?></span>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="d-sm-flex justify-content-start">
                            <h1 class="h3 mb-0 ml-2 text-gray-800">Prospectos</h1>
                        </div>
                        <div class="d-sm-flex justify-content-end">
                        </div>
                    </div>
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
                                            <a class="nav-link" id="propiedad_ubicacion-tab" data-toggle="tab"
                                                href="#propiedad_ubicacion" role="tab"
                                                aria-controls="propiedad_ubicacion"
                                                aria-selected="false">Características de propiedades de interés</a>
                                        </li>

                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="datos_generales" role="tabpanel"
                                            aria-labelledby="datos_generales-tab">
                                            <br>
                                            <form method="POST">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_nombre"> Nombre:</label>
                                                            <input type="text" name="nombre" maxlength="50"
                                                                class="form-control" required="" id="id_nombre" value="<?php echo $prospectoData['ProspectoNombre'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_a_paterno"> Apellido Paterno:</label>
                                                            <input type="text" name="a_paterno" maxlength="50"
                                                                class="form-control" required="" id="id_a_paterno" value="<?php echo $prospectoData['ProspectoAPaterno'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_a_materno"> Apellido Materno:</label>
                                                            <input type="text" name="a_materno" maxlength="50"
                                                                class="form-control" id="id_a_materno" value="<?php echo $prospectoData['ProspectoAMaterno'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_correo_electronico"> Correo
                                                                electronico:</label>
                                                            <input type="email" name="correo_electronico"
                                                                maxlength="254" class="form-control"
                                                                id="id_correo_electronico" value="<?php echo $prospectoData['ProspectoCorreo'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_telefono"> Teléfono fijo:</label>
                                                            <input type="text" name="telefono" maxlength="10"
                                                                class="form-control" id="id_telefono" value="<?php echo $prospectoData['ProspectoTelefono'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_celular"> Teléfono móvil:</label>
                                                            <input type="text" name="celular" maxlength="10"
                                                                class="form-control" id="id_celular" value="<?php echo $prospectoData['ProspectoCelular'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Origen contacto:</label>
                                                        <select name="contacto" id="inputState" class="form-control">
                                                            <option value="<?php echo $prospectoData['ProspectoContacto'] ?>" selected><?php echo $prospectoData['ContactoNombre'] ?></option>
                                                            <?php echo GetListaContacto($contactos) ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Tipo operacion prospecto:</label>
                                                        <select name="operacion" id="inputState" class="form-control">
                                                            <option value="<?php echo $prospectoData['ProspectoOperacion'] ?>" selected><?php echo $prospectoData['OperacionNombre'] ?></option>
                                                            <?php echo GetListaOperaciones($operaciones) ?> 
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Asesor:</label>
                                                        <select name="asesor" id="inputState" class="form-control">
                                                            <option value="<?php echo $prospectoData['ProspectoAsesor'] ?>" selected><?php echo $prospectoData['AsesorNombre'] . " " . $prospectoData['AsesorApellidoPaterno'] . " " . $prospectoData['AsesorApellidoMaterno'] ?></option>
                                                            <?php echo GetListaAsesores($asesores) ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="id_domicilio"> Domicilio:</label>
                                                            <textarea name="domicilio" cols="40" rows="2"
                                                                id="id_domicilio" class="form-control"><?php echo $prospectoData['ProspectoDomicilio'] ?></textarea>
                                                            <span class="red"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="id_comentario"> Comentario:</label>
                                                            <textarea name="comentario" cols="40" rows="2"
                                                                id="id_comentario" class="form-control"><?php echo $prospectoData['ProspectoComentario'] ?></textarea>
                                                            <span class="red"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Propiedades especificas de su interés:</label>
                                                        <select name="propiedades[]" id="propiedades"
                                                            class="form-control" multiple required>
                                                            <?php echo GetPropiedadesData($prospectoData['ProspectoPropiedades'], $pdo); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary" name="a_prospectos">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="propiedad_ubicacion" role="tabpanel"
                                            aria-labelledby="propiedad_ubicacion-tab">
                                            <br>
                                            <div class="text-right">
                                                <a href="/administracion/api/prospect/interest/63/"
                                                    id="add-property-interest"
                                                    class="btn btn-sm btn-primary shadow-sm mr-1 btn-lgr-inr">
                                                    <i class="fas fa-plus fa-sm text-white-50"></i> Agregar
                                                    característica
                                                </a>
                                            </div>
                                            <hr>
                                            <div class="list-container row">

                                                <p class="list-no-items">No se encontraron registros</p>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="modal-container">
                        <div class="modal fade" id="modal-property-interest" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <spa id="modal-property-interest-title"></spa> característica de propiedad
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="" method="" id="property_interest_form" novalidate="">
                                        <div class="modal-body">
                                            <input type="hidden" name="csrfmiddlewaretoken"
                                                value="x2ihzS62mZyRhZbfyzuJLdt7hSxqrGVcwdP1ElWaXD7Yfwl9Fteztj0sGBEu1faI">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_tipo_inmueble"> Tipo de inmueble:</label>
                                                        <span class="red">*</span>
                                                        <select name="tipo_inmueble" required="" id="id_tipo_inmueble"
                                                            data-select2-id="id_tipo_inmueble" tabindex="-1"
                                                            class="select2-hidden-accessible" aria-hidden="true">
                                                            <option value="" selected="" data-select2-id="11">---------
                                                            </option>

                                                            <option value="1">Casa</option>

                                                            <option value="2">Departamento</option>

                                                            <option value="3">Terreno</option>

                                                            <option value="4">Local Comercial</option>

                                                            <option value="5">Bodega Comercial</option>

                                                            <option value="6">Rancho</option>

                                                            <option value="7">Hacienda</option>

                                                            <option value="8">Quinta</option>

                                                            <option value="9">Villa</option>

                                                            <option value="10">Townhouse</option>

                                                            <option value="11">Cabaña</option>

                                                            <option value="12">Casa en Condominio</option>

                                                            <option value="13">Oficina</option>

                                                        </select><span
                                                            class="select2 select2-container select2-container--bootstrap"
                                                            dir="ltr" data-select2-id="10" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-labelledby="select2-id_tipo_inmueble-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-id_tipo_inmueble-container"
                                                                        role="textbox" aria-readonly="true"
                                                                        title="---------">---------</span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper"
                                                                aria-hidden="true"></span></span>
                                                        <span id="error_id_tipo_inmueble" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_zona_interes"> Zona de interés:</label>
                                                        <span class="red">*</span>
                                                        <select name="zona_interes" required="" id="id_zona_interes"
                                                            data-select2-id="id_zona_interes" tabindex="-1"
                                                            class="select2-hidden-accessible" aria-hidden="true">
                                                            <option value="" selected="" data-select2-id="13">---------
                                                            </option>

                                                            <option value="1">Villahermosa</option>

                                                            <option value="2">Centro, Villahermosa</option>

                                                            <option value="3">Zona Country</option>

                                                            <option value="4">Zona Ciudad Industrial</option>

                                                            <option value="5">Tabasco 2000</option>

                                                        </select><span
                                                            class="select2 select2-container select2-container--bootstrap"
                                                            dir="ltr" data-select2-id="12" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-labelledby="select2-id_zona_interes-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-id_zona_interes-container"
                                                                        role="textbox" aria-readonly="true"
                                                                        title="---------">---------</span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper"
                                                                aria-hidden="true"></span></span>
                                                        <span id="error_id_zona_interes" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_localidad"> Localidad:</label>
                                                        <input type="text" name="localidad" maxlength="200"
                                                            id="id_localidad" class="form-control">
                                                        <span id="error_id_localidad" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_tipo_operacion"> Tipo de operación:</label>
                                                        <span class="red">*</span>
                                                        <select name="tipo_operacion" required="" id="id_tipo_operacion"
                                                            data-select2-id="id_tipo_operacion" tabindex="-1"
                                                            class="select2-hidden-accessible" aria-hidden="true">
                                                            <option value="" selected="" data-select2-id="15">---------
                                                            </option>

                                                            <option value="1">Venta</option>

                                                            <option value="2">Renta</option>

                                                            <option value="3">Traspaso</option>

                                                            <option value="5">Vacacional</option>

                                                            <option value="6">Venta o Renta</option>

                                                            <option value="8">Compra</option>

                                                        </select><span
                                                            class="select2 select2-container select2-container--bootstrap"
                                                            dir="ltr" data-select2-id="14" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-labelledby="select2-id_tipo_operacion-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-id_tipo_operacion-container"
                                                                        role="textbox" aria-readonly="true"
                                                                        title="---------">---------</span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper"
                                                                aria-hidden="true"></span></span>
                                                        <span id="error_id_tipo_operacion" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_financiamiento"> Financiamiento:</label>
                                                        <span class="red">*</span>
                                                        <select name="financiamiento" required="" id="id_financiamiento"
                                                            data-select2-id="id_financiamiento" tabindex="-1"
                                                            class="select2-hidden-accessible" aria-hidden="true">
                                                            <option value="" selected="" data-select2-id="17">---------
                                                            </option>

                                                            <option value="1">Bancario</option>

                                                            <option value="2">Infonavit</option>

                                                            <option value="3">Fovissste</option>

                                                            <option value="4">PEMEX</option>

                                                            <option value="7">Recursos propios (Efectivo)</option>

                                                        </select><span
                                                            class="select2 select2-container select2-container--bootstrap"
                                                            dir="ltr" data-select2-id="16" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-labelledby="select2-id_financiamiento-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-id_financiamiento-container"
                                                                        role="textbox" aria-readonly="true"
                                                                        title="---------">---------</span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper"
                                                                aria-hidden="true"></span></span>
                                                        <span id="error_id_financiamiento" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_presupuesto_desde"> Presupuesto desde:</label>
                                                        <input type="number" name="presupuesto_desde"
                                                            id="id_presupuesto_desde" class="form-control">
                                                        <span id="error_id_presupuesto_desde" class="red"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="id_presupuesto_hasta"> Presupuesto hasta:</label>
                                                        <input type="number" name="presupuesto_hasta"
                                                            id="id_presupuesto_hasta" class="form-control">
                                                        <span id="error_id_presupuesto_hasta" class="red"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
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
    new MultiSelectTag('propiedades')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>