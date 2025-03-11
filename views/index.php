<?php
require '../controllers/index.php';
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

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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
            <li class="nav-item active">
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <div id="cerrar-sesion">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                            </div>
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
                                <a class="dropdown-item" href="perfil.php">
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



                        </div>
                        <div class="d-sm-flex justify-content-end">


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Tipos de propiedad en catálogo</h5>
                                    <div id="DataTables_Table_0_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 553.2px; padding-right: 17px;">
                                                            <table
                                                                class="table table-sm scroll-table dataTable no-footer"
                                                                role="grid" style="margin-left: 0px; width: 553.2px;">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 309.688px;">
                                                                            Propiedad</th>
                                                                        <th class="text-center sorting_disabled"
                                                                            rowspan="1" colspan="1"
                                                                            style="width: 193.913px;">Cantidad</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; height: 200px; width: 100%;">
                                                        <table class="table table-sm scroll-table dataTable no-footer"
                                                            id="DataTables_Table_0" role="grid" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row" style="height: 0px;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 309.688px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Propiedad</div>
                                                                    </th>
                                                                    <th class="text-center sorting_disabled" rowspan="1"
                                                                        colspan="1"
                                                                        style="width: 193.913px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Cantidad</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php echo $cantidadPropiedades ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5"></div>
                                            <div class="col-sm-12 col-md-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Operaciones en catálogo</h5>
                                    <div id="DataTables_Table_1_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 570px; padding-right: 0px;">
                                                            <table
                                                                class="table table-sm scroll-table dataTable no-footer"
                                                                role="grid" style="margin-left: 0px; width: 570px;">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 286.638px;">
                                                                            Operación</th>
                                                                        <th class="text-center sorting_disabled"
                                                                            rowspan="1" colspan="1"
                                                                            style="width: 233.762px;">Cantidad</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; height: 200px; width: 100%;">
                                                        <table class="table table-sm scroll-table dataTable no-footer"
                                                            id="DataTables_Table_1" role="grid" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row" style="height: 0px;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 286.638px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Operación</div>
                                                                    </th>
                                                                    <th class="text-center sorting_disabled" rowspan="1"
                                                                        colspan="1"
                                                                        style="width: 233.762px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Cantidad</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php echo $cantidadOperaciones ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5"></div>
                                            <div class="col-sm-12 col-md-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Cantidad de operaciones por propiedad</h5>
                                    <div id="DataTables_Table_2_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 1188.8px; padding-right: 17px;">
                                                            <table
                                                                class="table table-sm scroll-table dataTable no-footer"
                                                                role="grid" style="margin-left: 0px; width: 1188.8px;">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 461.688px;">
                                                                            Propiedad</th>
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 358.812px;">
                                                                            Operación</th>
                                                                        <th class="text-center sorting_disabled"
                                                                            rowspan="1" colspan="1"
                                                                            style="width: 293.9px;">Cantidad</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; height: 200px; width: 100%;">
                                                        <table class="table table-sm scroll-table dataTable no-footer"
                                                            id="DataTables_Table_2" role="grid" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row" style="height: 0px;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 461.688px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Propiedad</div>
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 358.812px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Operación</div>
                                                                    </th>
                                                                    <th class="text-center sorting_disabled" rowspan="1"
                                                                        colspan="1"
                                                                        style="width: 293.9px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Cantidad</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php echo $cantidadTipoOperaciones ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5"></div>
                                            <div class="col-sm-12 col-md-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Propiedades incorporadas por asesor</h5>
                                    <div id="DataTables_Table_3_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 553.2px; padding-right: 17px;">
                                                            <table
                                                                class="table table-sm scroll-table dataTable no-footer"
                                                                role="grid" style="margin-left: 0px; width: 553.2px;">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 404.462px;">Asesor
                                                                        </th>
                                                                        <th class="text-center sorting_disabled"
                                                                            rowspan="1" colspan="1"
                                                                            style="width: 99.1375px;">Cantidad</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; height: 200px; width: 100%;">
                                                        <table class="table table-sm scroll-table dataTable no-footer"
                                                            id="DataTables_Table_3" role="grid" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row" style="height: 0px;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 404.462px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Asesor</div>
                                                                    </th>
                                                                    <th class="text-center sorting_disabled" rowspan="1"
                                                                        colspan="1"
                                                                        style="width: 99.1375px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Cantidad</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php echo $cantidadPropiedadesAsesor ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5"></div>
                                            <div class="col-sm-12 col-md-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Propiedades cerradas por asesor</h5>
                                    <div id="DataTables_Table_4_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 553.2px; padding-right: 17px;">
                                                            <table
                                                                class="table table-sm scroll-table dataTable no-footer"
                                                                role="grid" style="margin-left: 0px; width: 553.2px;">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 404.462px;">Asesor
                                                                        </th>
                                                                        <th class="text-center sorting_disabled"
                                                                            rowspan="1" colspan="1"
                                                                            style="width: 99.1375px;">Cantidad</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; height: 200px; width: 100%;">
                                                        <table class="table table-sm scroll-table dataTable no-footer"
                                                            id="DataTables_Table_4" role="grid" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row" style="height: 0px;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 404.462px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Asesor</div>
                                                                    </th>
                                                                    <th class="text-center sorting_disabled" rowspan="1"
                                                                        colspan="1"
                                                                        style="width: 99.1375px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Cantidad</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php echo $cantidadCerradasAsesor ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5"></div>
                                            <div class="col-sm-12 col-md-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Prospectos por asesor</h5>
                                    <div id="DataTables_Table_5_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 553.2px; padding-right: 17px;">
                                                            <table
                                                                class="table table-sm scroll-table dataTable no-footer"
                                                                role="grid" style="margin-left: 0px; width: 553.2px;">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 404.462px;">Asesor
                                                                        </th>
                                                                        <th class="text-center sorting_disabled"
                                                                            rowspan="1" colspan="1"
                                                                            style="width: 99.1375px;">Cantidad</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; height: 200px; width: 100%;">
                                                        <table class="table table-sm scroll-table dataTable no-footer"
                                                            id="DataTables_Table_5" role="grid" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row" style="height: 0px;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 404.462px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Asesor</div>
                                                                    </th>
                                                                    <th class="text-center sorting_disabled" rowspan="1"
                                                                        colspan="1"
                                                                        style="width: 99.1375px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Cantidad</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php echo $cantidadProspectosAsesor ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5"></div>
                                            <div class="col-sm-12 col-md-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-6 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Visitas por asesor</h5>
                                    <div id="DataTables_Table_6_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 570px; padding-right: 0px;">
                                                            <table
                                                                class="table table-sm scroll-table dataTable no-footer"
                                                                role="grid" style="margin-left: 0px; width: 570px;">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 233.738px;">Asesor
                                                                        </th>
                                                                        <th class="text-center sorting_disabled"
                                                                            rowspan="1" colspan="1"
                                                                            style="width: 286.663px;">Cantidad</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; height: 200px; width: 100%;">
                                                        <table class="table table-sm scroll-table dataTable no-footer"
                                                            id="DataTables_Table_6" role="grid" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row" style="height: 0px;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 233.738px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Asesor</div>
                                                                    </th>
                                                                    <th class="text-center sorting_disabled" rowspan="1"
                                                                        colspan="1"
                                                                        style="width: 286.663px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Cantidad</div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                                <tr class="odd">
                                                                    <td valign="top" colspan="2"
                                                                        class="dataTables_empty"> Sin resultados para
                                                                        mostrar</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5"></div>
                                            <div class="col-sm-12 col-md-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Ultimos prospectos </h5>
                                    <div id="DataTables_Table_7_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner"
                                                            style="box-sizing: content-box; width: 1205.6px; padding-right: 0px;">
                                                            <table
                                                                class="table table-sm scroll-table dataTable no-footer"
                                                                role="grid" style="margin-left: 0px; width: 1205.6px;">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 433.225px;">Asesor
                                                                        </th>
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 506.087px;">
                                                                            Prospecto</th>
                                                                        <th class="sorting_disabled" rowspan="1"
                                                                            colspan="1" style="width: 191.887px;">Fecha
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="dataTables_scrollBody"
                                                        style="position: relative; overflow: auto; height: 200px; width: 100%;">
                                                        <table class="table table-sm scroll-table dataTable no-footer"
                                                            id="DataTables_Table_7" role="grid" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row" style="height: 0px;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 433.225px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Asesor</div>
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 506.087px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">
                                                                            Prospecto</div>
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                        style="width: 191.887px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                                        <div class="dataTables_sizing"
                                                                            style="height: 0px; overflow: hidden;">Fecha
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr role="row" class="odd">
                                                                    <td>NEIVA RAMON BAUTISTA</td>
                                                                    <td>LORENA ROMERO GONZALEZ</td>
                                                                    <td>21/11/2024</td>
                                                                </tr>
                                                                <tr role="row" class="even">
                                                                    <td>NEIVA RAMON BAUTISTA</td>
                                                                    <td>FRANCISCO PEREZ</td>
                                                                    <td>21/11/2024</td>
                                                                </tr>
                                                                <tr role="row" class="odd">
                                                                    <td>NEIVA RAMON BAUTISTA</td>
                                                                    <td>JOSE DANTE BAUTISTA</td>
                                                                    <td>15/10/2024</td>
                                                                </tr>
                                                                <tr role="row" class="even">
                                                                    <td>NEIVA RAMON BAUTISTA</td>
                                                                    <td>Vanesa Lopez BAUTISTA</td>
                                                                    <td>15/10/2024</td>
                                                                </tr>
                                                                <tr role="row" class="odd">
                                                                    <td>NEIVA RAMON BAUTISTA</td>
                                                                    <td>ALDO HERNANDEZ</td>
                                                                    <td>15/10/2024</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5"></div>
                                            <div class="col-sm-12 col-md-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


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
                    <!-- <a class="btn btn-primary" href="../controllers/logout.php">Cerrar sesión</a> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>