<?php
    // Mostrar errores / old desde sesión (flash sencillo)
    $ErrorMessage = $_SESSION['ErrorMessage'] ?? null;
    $OldUsername  = $_SESSION['Old']['username'] ?? '';
    unset($_SESSION['ErrorMessage'], $_SESSION['Old']);

    $Campos = "Dashboard";
    $title = $Campos." | " . app();
    require_once  __DIR__ . '/Partials/Head.php';
    require_once  __DIR__ . '/Partials/Topbar.php';
    require_once  __DIR__ . '/Partials/Sidebar.php';
?>

<!-- Contenido Pagina -->

<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                        <h4 class="page-title"><?= $Campos; ?></h4>
                        <div class="">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#"><?= app() ?></a>
                                </li><!--end nav-item-->
                                <li class="breadcrumb-item active"><?= $Campos; ?></li>
                            </ol>
                        </div>                            
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <div class="row">
                <div class="col-lg-9">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-3">
                            <div class="card report-card">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col">
                                            <p class="text-dark mb-0 fw-semibold">Ingresos</p>
                                            <h3 class="my-1 fs-20">24k</h3>
                                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="las la-trending-up"></i>5.5%</span> Nuevos ingresos</p>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <div class="flex-shrink-0 bg-info-subtle text-info thumb-md rounded-circle">
                                                <i class="iconoir-activity fs-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col--> 
                        <div class="col-md-6 col-lg-3">
                            <div class="card report-card">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">                                                
                                        <div class="col">
                                            <p class="text-dark mb-0 fw-semibold">Salidas</p>
                                            <h3 class="my-1 fs-20">1k</h3>
                                            <p class="mb-0 text-truncate text-muted"><span class="text-danger"><i class="las la-trending-down"></i>1.5%</span> Nuevos ingresos</p>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <div class="flex-shrink-0 bg-pink-subtle text-pink thumb-md rounded-circle">
                                                <i class="iconoir-activity fs-4"></i>
                                            </div>
                                        </div> 
                                    </div>
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col--> 
                        <div class="col-md-6 col-lg-3">
                            <div class="card report-card">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">                                                
                                        <div class="col">
                                            <p class="text-dark mb-0 fw-semibold">Transacciones</p>
                                            <h3 class="my-1 fs-20">15800</h3>
                                            <p class="mb-0 text-truncate text-muted"><span class="text"><i class="las la-trending-down"></i>2%</span> Avance Semanal</p>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <div class="flex-shrink-0 bg-warning-subtle text-warning thumb-md rounded-circle">
                                                <i class="iconoir-handbag fs-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col--> 
                        <div class="col-md-6 col-lg-3">
                            <div class="card report-card">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col">  
                                            <p class="text-dark mb-0 fw-semibold">Lineas Activas</p>                                         
                                            <h3 class="my-1 fs-20">80</h3>
                                            <p class="mb-0 text-truncate text-muted"><span class="text"><i class="las la-trending-up"></i>100%</span> Lineas Completadas</p>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <div class="flex-shrink-0 bg-warning-subtle text-warning thumb-md rounded-circle">
                                                <i class="iconoir-handbag fs-4"></i>
                                            </div>
                                        </div> 
                                    </div>
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col-->                               
                    </div><!--end row-->
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">                      
                                    <h4 class="card-title">Proximamente...</h4>                      
                                </div><!--end col-->
                                <div class="col-auto"> 
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            This Year<i class="las la-angle-down ms-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Today</a>
                                            <a class="dropdown-item" href="#">Last Week</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">This Year</a>
                                        </div>
                                    </div>               
                                </div><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="">
                                <div id="ana_dash_1" class="apex-charts"></div>
                            </div> 
                        </div><!--end card-body--> 
                    </div><!--end card--> 
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">                      
                                    <h4 class="card-title">Proximamente...</h4>                      
                                </div><!--end col-->
                                <div class="col-auto"> 
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            All<i class="las la-angle-down ms-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Purchases</a>
                                            <a class="dropdown-item" href="#">Emails</a>
                                        </div>
                                    </div>         
                                </div><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="text-center">
                                <div id="sessions_device" class="apex-charts"></div>
                                <h6 class="bg-light py-2 px-2 mb-0 rounded mt-3">
                                    <i data-feather="calendar" class="align-self-center icon-xs me-1"></i>
                                    01 January 2020 to 31 December 2020
                                </h6>
                            </div>  
                            <div class="table-responsive mt-2">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>Device</th>
                                        <th class="text-end">Sassions</th>
                                        <th class="text-end">Day</th>
                                        <th class="text-end">Week</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Dasktops</td>
                                        <td class="text-end">1843</td>
                                        <td class="text-end">-3</td>
                                        <td class="text-end">-12</td>
                                    </tr>
                                    <tr>
                                        <td>Tablets</td>
                                        <td class="text-end">2543</td>
                                        <td class="text-end">-5</td>
                                        <td class="text-end">-2</td>                                                 
                                    </tr>
                                    <tr>
                                        <td>Mobiles</td>
                                        <td class="text-end">3654</td>
                                        <td class="text-end">-5</td>
                                        <td class="text-end">-6</td>
                                    </tr>
                                    
                                    </tbody>
                                </table><!--end /table-->
                            </div><!--end /div-->                                 
                        </div><!--end card-body--> 
                    </div><!--end card--> 
                </div> <!--end col--> 
            </div><!--end row-->
            
        </div><!-- container -->

        <!--Start Rightbar-->
        <!--Start Rightbar/offcanvas-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
            <div class="offcanvas-header border-bottom justify-content-between">
                <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
                <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">  
                <h6>Account Settings</h6>
                <div class="p-2 text-start mt-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch1">
                        <label class="form-check-label" for="settings-switch1">Auto updates</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                        <label class="form-check-label" for="settings-switch2">Location Permission</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="settings-switch3">
                        <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                    </div><!--end form-switch-->
                </div><!--end /div-->
                <h6>General Settings</h6>
                <div class="p-2 text-start mt-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch4">
                        <label class="form-check-label" for="settings-switch4">Show me Online</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                        <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                    </div><!--end form-switch-->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="settings-switch6">
                        <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                    </div><!--end form-switch-->
                </div><!--end /div-->               
            </div><!--end offcanvas-body-->
        </div>
        <!--end Rightbar/offcanvas-->
        <!--end Rightbar-->
        <!--Start Footer-->
        
        <footer class="footer text-center text-sm-start d-print-none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0 border-bottom-0 rounded-bottom-0">
                            <div class="card-body">
                                <p class="text-muted mb-0">
                                    ©
                                    <script> document.write(new Date().getFullYear()) </script>
                                    <?= app() ?>
                                    <span
                                        class="text-muted d-none d-sm-inline-block float-end">
                                        Todos los derechos reservados.
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!--end footer-->
    </div>
    <!-- end page content -->
</div>

<!-- end Contenido Pagina  -->

<?php require_once  __DIR__ . '/Partials/footer.php'; ?>
