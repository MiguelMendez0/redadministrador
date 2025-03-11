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
                    <h1 class="h3 mb-4 text-gray-800">Propiedades</h1>
                    <form method="POST">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Titulo:</label>
                            <input name="titulo" type="text" class="form-control" id="formGroupExampleInput" required>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="inputState">Tipo Inmueble:</label>
                                <select name="tipo" id="inputState" class="form-control" required>
                                    <option disabled selected>Seleccionar</option>
                                    <?php echo GetListaTipo($tipos); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Tipo Operación:</label>
                                <select name="operacion" id="inputState" class="form-control" required>
                                    <option disabled selected>Seleccionar</option>
                                    <?php echo GetListaOperaciones($operaciones); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Financiamiento:</label>
                                <select name="financiamiento[]" id="financiamiento" class="form-control" multiple
                                    required>
                                    <?php echo GetListaFinanciamientos($financiamientos); ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="inputState">Libre Gravamen:</label>
                                <select name="gravamen" id="inputState" class="form-control" required>
                                    <option disabled selected>Seleccionar</option>
                                    <option value="0">Si</option>
                                    <option value="1">No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Uso Suelo:</label>
                                <select name="uso" id="inputState" class="form-control" required>
                                    <option disabled selected>Seleccionar</option>
                                    <?php echo GetListaUsos($usos); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Antiguedad:</label>
                                <select name="antiguedad" id="inputState" class="form-control" required>
                                    <option disabled selected>Seleccionar</option>
                                    <?php echo GetListaAntiguedad($antiguedad); ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="inputState">Asesor:</label>
                                <select name="asesor" id="inputState" class="form-control" required>
                                    <option disabled selected>Seleccionar</option>
                                    <?php echo GetListaAsesores($asesores); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Estatus Interno:</label>
                                <select name="status" id="inputState" class="form-control" required>
                                    <option disabled selected>Seleccionar</option>
                                    <?php echo GetListaStatus($status); ?>
                                </select>
                            </div>
                            <div class="form-check form-switch col-md-4">
                                <input name="publicar" class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault" value="1">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Publicar</label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="inputState">Precio Venta:</label>
                                <input name="precioVenta" id="precioVenta" type="number" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputState">Precio Renta:</label>
                                <input name="precioRenta" id="precioRenta" type="number" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Moneda</label>
                                <select name="moneda" id="inputState" class="form-control" required>
                                    <option disabled selected>Seleccionar</option>
                                    <?php echo GetListaMoneda($monedas); ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">Descipción (140 caracteres máximo):</label>
                                <textarea name="descripcion" class="form-control" id="exampleFormControlTextarea1"
                                    rows="3" required></textarea>
                            </div>
                        <button type="submit" name="registrarP" class="btn btn-secondary btn-lg btn-block">Registrar
                            Propiedad</button>
                    </form>
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

        precioVenta.addEventListener("input", function () {
            if (precioVenta.value.trim() !== "") {
                precioRenta.disabled = true;
                precioRenta.value = "";
            } else {
                precioRenta.disabled = false;
            }
        });

        precioRenta.addEventListener("input", function () {
            if (precioRenta.value.trim() !== "") {
                precioVenta.disabled = true;
                precioVenta.value = "";
            } else {
                precioVenta.disabled = false;
            }
        });
    });
</script>


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>