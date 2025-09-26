<?php
    // Mostrar errores / old desde sesión (flash sencillo)
    $ErrorMessage = $_SESSION['ErrorMessage'] ?? null;
    $OldUsername  = $_SESSION['Old']['username'] ?? '';
    unset($_SESSION['ErrorMessage'], $_SESSION['Old']);

    $namepage = "Usuarios";
    $title = $namepage." | " . app();
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
                        <h4 class="page-title"><?= $namepage; ?></h4>
                        <div class="">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#"><?= app() ?></a>
                                </li><!--end nav-item-->
                                <li class="breadcrumb-item active"><?= $namepage; ?></li>
                            </ol>
                        </div>                            
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">  
                                    <li class="mx-2 welcome-text">                    
                                        <h4 class="card-title">Lista de <?= $namepage; ?></h4> 
                                    </li>  
                                    <li class="mx-2 welcome-text">
                                        <a class="btn btn-sm btn-soft-success" href="#" role="button">
                                            <i class="fas fa-plus me-2"></i>Nuevo <?= $namepage; ?>
                                        </a>
                                    </li>                   
                                </div><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Contact No</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><img src="<?= asset('images/users/avatar-3.jpg') ?>" alt="" class="rounded-circle thumb-md me-1 d-inline"> Aaron Poulin</td>
                                        <td>Aaron@example.com</td>
                                        <td>+21 21547896</td>
                                        <td class="text-end">                                                       
                                            <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                            <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="<?= asset('images/users/avatar-4.jpg') ?>" alt="" class="rounded-circle thumb-md me-1 d-inline"> Richard Ali</td>
                                        <td>Richard@example.com</td>
                                        <td>+41 21547896</td>
                                        <td class="text-end">                                                       
                                            <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                            <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="<?= asset('images/users/avatar-5.jpg') ?>" alt="" class="rounded-circle thumb-md me-1 d-inline"> Juan Clark</td>
                                        <td>Juan@example.com</td>
                                        <td>+65 21547896</td>
                                        <td class="text-end">                                                       
                                            <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                            <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="<?= asset('images/users/avatar-6.jpg') ?>" alt="" class="rounded-circle thumb-md me-1 d-inline"> Albert Hull</td>
                                        <td>Albert@example.com</td>
                                        <td>+88 21547896</td>
                                        <td class="text-end">                                                       
                                            <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                            <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table><!--end /table-->
                            </div><!--end /tableresponsive-->          
                        </div><!--end card-body--> 
                    </div><!--end card--> 
                </div> <!--end col--> 
            </div>
        </div><!-- container -->

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
