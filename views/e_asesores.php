<?php 
require '../controllers/asesores.php';
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
            <li class="nav-item">
                <a class="nav-link" href="v_propiedades.php">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Propiedades</span></a>
            </li>
            <li class="nav-item active">
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
                    <h1 class="h3 mb-4 text-gray-800">Asesores</h1>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header">
                                    Actualizar datos
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="datos_generales-tab" data-toggle="tab"
                                                href="#datos_generales" role="tab" aria-controls="datos_generales"
                                                aria-selected="false">Datos Generales</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="foto_perfil-tab" data-toggle="tab"
                                                href="#foto_perfil" role="tab" aria-controls="foto_perfil"
                                                aria-selected="true">Foto de perfil</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="contacto-tab" data-toggle="tab" href="#contacto"
                                                role="tab" aria-controls="contacto" aria-selected="false">Contacto de
                                                emergencia</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="documentos-tab" data-toggle="tab" href="#documentos"
                                                role="tab" aria-controls="contact" aria-selected="false">Documentos</a>
                                        </li>

                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade" id="datos_generales" role="tabpanel"
                                            aria-labelledby="datos_generales-tab">
                                            <br>
                                            <form method="POST">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="inputState">Nombre:</label>
                                                        <input name="nombre" type="text" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorNombre']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Apellido Paterno:</label>
                                                        <input name="apellidoPaterno" type="text" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorApellidoPaterno']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Apellido Materno:</label>
                                                        <input name="apellidoMaterno" type="text" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorApellidoMaterno']; ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="inputState">Correo Electronico:</label>
                                                        <input name="correo" type="text" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorCorreo']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Fecha de Alta:</label>
                                                        <input name="fechaAlta" type="date" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorAlta']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">RFC:</label>
                                                        <input name="rfc" type="text" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorRfc']; ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="inputState">NSS:</label>
                                                        <input name="nss" type="text" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorNss']; ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Tipo de Sangre:</label>
                                                        <select name="tipoSangre" id="inputState" class="form-control">
                                                            <option
                                                                value="<?php echo $dataAsesor['AsesorTipoSangre'] ?>"
                                                                selected>
                                                                <?php echo $dataAsesor['AsesorTipoSangre']; ?></option>
                                                            <option value="O-">O-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Especialidad:</label>
                                                        <select name="especialidad" id="inputState"
                                                            class="form-control">
                                                            <option
                                                                value="<?php echo $dataAsesor['AsesorEspecialidad'] ?>"
                                                                selected><?php echo $dataAsesor['EspecialidadNombre'] ?>
                                                            </option>
                                                            <?php echo GetListaEspecialidad($especialidades); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Zona:</label>
                                                        <select name="zonas" id="inputState" class="form-control">
                                                            <option value="<?php echo $dataAsesor['AsesorZona'] ?>"
                                                                selected><?php echo $dataAsesor['ZonaNombre'] ?>
                                                            </option>
                                                            <?php echo GetListaZona($zonas); ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Telefono (fijo):</label>
                                                        <input name="telefono" type="text" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorTelefono']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Celular (movil):</label>
                                                        <input name="celular" type="text" class="form-control"
                                                            value="<?php echo $dataAsesor['AsesorCelular']; ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlTextarea1">Dirección:</label>
                                                        <textarea name="direccion" class="form-control"
                                                            id="exampleFormControlTextarea1"
                                                            rows="3"><?php echo $dataAsesor['AsesorDireccion']; ?></textarea>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlTextarea1">Observaciones:</label>
                                                        <textarea name="observaciones" class="form-control"
                                                            id="exampleFormControlTextarea1"
                                                            rows="3"><?php echo $dataAsesor['AsesorObservaciones'] ?></textarea>
                                                    </div>
                                                </div>
                                                <?php echo EvaluarUsuario($sesion['AsesorId'], $AsesorId) ?>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="form-check form-switch col-md-4">
                                                        <input name="admin" class="form-check-input" type="checkbox"
                                                            role="switch" id="flexSwitchCheckDefault" value="1"
                                                            <?php echo EvaluarCheckbox($dataAsesor['AsesorAdmin']) ?>>
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">¿Es
                                                            administrador?</label>
                                                    </div>
                                                    <div class="form-check form-switch col-md-4">
                                                        <input name="activo" class="form-check-input" type="checkbox"
                                                            role="switch" id="flexSwitchCheckChecked" value="1"
                                                            <?php echo EvaluarCheckbox($dataAsesor['AsesorActivo']) ?>>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">¿Es
                                                            usuario activo?</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <button type="submit" name="actualizarA"
                                                    class="btn btn-secondary btn-lg btn-block">Registrar Asesor</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade active show" id="foto_perfil" role="tabpanel"
                                            aria-labelledby="foto_perfil-tab">
                                            <br>
                                            <div class="card" style="width: 18rem;">
                                                <div class="card-body">

                                                    <img class="card-img-top img_foto_perfil"
                                                        src="<?php echo $asesorFoto ?>" alt="Profile">

                                                </div>
                                            </div>
                                            <br>
                                            <form id="foto_perfil_asesor" type="post" enctype="multipart/form-data"
                                                method="POST">
                                                <div class="form-group">
                                                    <label for="id_foto_perfil"> Foto de perfil: </label>
                                                    <span class="text-info">(JPEG, JPG). Tamaño máximo: 1MB</span>
                                                    <br>
                                                    <div class="mb-3">
                                                        <input name="foto" class="form-control" type="file"
                                                            id="formFile">
                                                    </div>
                                                </div>
                                                <button name="guardarFoto" type="submit"
                                                    class="btn btn-primary">Guardar</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="contacto" role="tabpanel"
                                            aria-labelledby="contacto-tab">
                                            <br>
                                            <form method="POST" id="contacto_emergencia_form">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="inputState">Nombre:</label>
                                                        <input name="nombre" type="text" class="form-control"
                                                            value="<?php echo $dataCEmergencia['CENombre'] ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Apellido Paterno:</label>
                                                        <input name="apellidoPaterno" type="text" class="form-control"
                                                            value="<?php echo $dataCEmergencia['CEApellidoPaterno'] ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Apellido Materno:</label>
                                                        <input name="apellidoMaterno" type="text" class="form-control"
                                                            value="<?php echo $dataCEmergencia['CEApellidoMaterno'] ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="inputState">Telefono (Fijo):</label>
                                                        <input name="telefono" type="text" class="form-control"
                                                            value="<?php echo $dataCEmergencia['CETelefono'] ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputState">Telefono (Movil):</label>
                                                        <input name="celular" type="text" class="form-control"
                                                            value="<?php echo $dataCEmergencia['CECelular'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Parentesco:</label>
                                                        <select name="parentesco" id="inputState" class="form-control"
                                                            required>
                                                            <option
                                                                value="<?php echo $dataCEmergencia['CEParentesco'] ?>"
                                                                selected>
                                                                <?php echo $dataCEmergencia['ParentescoNombre'] ?>
                                                            </option>
                                                            <?php echo GetListaParentesco($parentesco); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <button type="submit" name="actualizarCe"
                                                    class="btn btn-secondary btn-lg btn-block">Guardar</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="documentos" role="tabpanel"
                                            aria-labelledby="documentos-tab">
                                            <form method="POST" id="user_profile_documento_form"
                                                enctype="multipart/form-data" novalidate="">
                                                <input type="hidden" name="csrfmiddlewaretoken"
                                                    value="XoOYQB6ONHO1xwOWIsmlL1cMPYZccARUAhwADM8R1vRiW04tLsA7XXdW1GfpFE7m">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="id_tipo_documento"> Tipo de documento:</label>
                                                            <div class="form-group col-md-6">
                                                                <select name="tipo" id="inputState" class="form-control"
                                                                    required>
                                                                    <option disabled selected>Seleccionar</option>
                                                                    <?php echo GetListaDocumentacion($documentacion); ?>
                                                                </select>
                                                            </div>
                                                        </div>
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

                                                <?php echo $dataDocumentacionAsesor ?>

                                            </div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>