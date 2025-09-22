<?php
// Mostrar errores / old desde sesión (flash sencillo)
$ErrorMessage = $_SESSION['ErrorMessage'] ?? null;
$OldUsername  = $_SESSION['Old']['username'] ?? '';
unset($_SESSION['ErrorMessage'], $_SESSION['Old']);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
    <meta charset="utf-8" />
    <title>Login | <?= app() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="<?= app() ?> - Sistema de Administración" name="description" />
    <meta content="<?= autor() ?>" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= asset('images/favicon.ico') ?>">

    <!-- App css -->
    <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('css/app.min.css') ?>" rel="stylesheet" type="text/css" />

    <style>
        /* Personalización cabecera login */
        .auth-header-box {
            background: linear-gradient(135deg, #6f6af8, #6f6af8);
        }
    </style>
</head>

<body>
<div class="container-xxl">
    <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 mx-auto">
                        <div class="card">
                            <!-- Cabecera -->
                            <div class="card-body p-0 auth-header-box rounded-top">
                                <div class="text-center p-3">
                                    <a href="<?= inicio() ?>" class="logo logo-admin">
                                        <img src="<?= asset('images/logo-sm.png') ?>" height="50" alt="logo" class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">
                                        Bienvenido a <?= app() ?>
                                    </h4>
                                    <p class="text-light fw-medium mb-0">Inicia sesión para continuar</p>
                                </div>
                            </div>
                            <!-- Formulario -->
                            <div class="card-body">
                                <form class="my-4" action="<?= inicio() ?>admin/login" method="post">
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="username">Usuario</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Ingresa tu usuario">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="userpassword">Contraseña</label>
                                        <input type="password" class="form-control" name="password" id="userpassword" placeholder="Ingresa tu contraseña">
                                    </div>

                                    <div class="form-group row mt-3">
                                        <div class="col-sm-6">
                                            <div class="form-check form-switch form-switch-primary">
                                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Recuérdame</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-end">
                                            <a href="#" class="text-muted font-13"><i class="dripicons-lock"></i> ¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid mt-3">
                                                <button class="btn btn-primary" type="submit">
                                                    Ingresar <i class="fas fa-sign-in-alt ms-1"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="text-center mb-2">
                                    <p class="text-muted">¿No tienes una cuenta? 
                                        <a href="#" class="text-primary ms-2">Regístrate gratis</a>
                                    </p>
                                    <h6 class="px-3 d-inline-block">O inicia con</h6>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="d-flex justify-content-center align-items-center thumb-md bg-blue-subtle text-blue rounded-circle me-2">
                                        <i class="fab fa-facebook align-self-center"></i>
                                    </a>
                                    <a href="#" class="d-flex justify-content-center align-items-center thumb-md bg-info-subtle text-info rounded-circle me-2">
                                        <i class="fab fa-twitter align-self-center"></i>
                                    </a>
                                    <a href="#" class="d-flex justify-content-center align-items-center thumb-md bg-danger-subtle text-danger rounded-circle">
                                        <i class="fab fa-google align-self-center"></i>
                                    </a>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end card-body-->
        </div><!--end col-->
    </div><!--end row-->
</div><!-- container -->
</body>
</html>
