<!-- Top Bar Start -->
<div class="topbar d-print-none">
    <div class="container-fluid">
        <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">

            <!-- Botón menú mobile -->
            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                <li>
                    <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                        <i class="iconoir-menu"></i>
                    </button>
                </li>
            </ul>

            <!-- Items derecha -->
            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">

                <!-- Buscador TopBar-->
                <li class="hide-phone app-search">
                    <form role="search" action="#" method="get">
                        <input type="search" name="search" class="form-control top-search mb-0" placeholder="Buscar...">
                        <button type="submit"><i class="iconoir-search"></i></button>
                    </form>
                </li>

                <!-- Modo Oscuro/Dia -->
                <li class="topbar-item">
                    <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                        <i class="iconoir-half-moon dark-mode"></i>
                        <i class="iconoir-sun-light light-mode"></i>
                    </a>                    
                </li>

                <!-- Notificaciones-->
                <li class="dropdown topbar-item">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
                        <i class="iconoir-bell"></i>
                        <span class="alert-badge"></span>
                    </a>
                    <div class="dropdown-menu stop dropdown-menu-end dropdown-lg py-0">
                        <h5 class="dropdown-item-text m-0 py-3 d-flex justify-content-between align-items-center">
                            Notificaciones
                        </h5>
                        <div class="ms-0" style="max-height:230px;" data-simplebar>
                            <a href="#" class="dropdown-item py-3">
                                <small class="float-end text-muted ps-2">Ahora</small>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                        <i class="iconoir-wolf fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2 text-truncate">
                                        <h6 class="my-0 fw-normal text-dark fs-13">Bienvenido al Sistema</h6>
                                        <small class="text-muted mb-0">El nuevo sistema ERP con nuevas funciones.</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="#" class="dropdown-item text-center text-dark fs-13 py-2">
                            Mostrar Todo <i class="fi-arrow-right"></i>
                        </a>
                    </div>
                </li>

                <!-- Perfil-->
                <li class="dropdown topbar-item">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
                        <img src="<?= asset('images/users/avatar-1.jpg') ?>" alt="" class="thumb-md rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end py-0">
                        <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                            <div class="flex-shrink-0">
                                <img src="<?= asset('images/users/avatar-1.jpg') ?>" alt="" class="thumb-md rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                <h6 class="my-0 fw-medium text-dark fs-13"><?= $_SESSION['username'] ?? '' ?></h6>
                                <small class="text-muted mb-0">Administrador</small>
                            </div>
                        </div>
                        <div class="dropdown-divider mt-0"></div>
                        <small class="text-muted px-2 pb-1 d-block">Cuenta</small>
                        <a class="dropdown-item" href="pages-profile.html"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Mi Perfil</a>
                        <small class="text-muted px-2 py-1 d-block">Configuración</small>                        
                        <a class="dropdown-item" href="pages-profile.html"><i class="las la-cog fs-18 me-1 align-text-bottom"></i> Ajustes</a>
                        <a class="dropdown-item" href="pages-profile.html"><i class="las la-lock fs-18 me-1 align-text-bottom"></i> Seguridad</a>
                        <a class="dropdown-item" href="pages-faq.html"><i class="las la-question-circle fs-18 me-1 align-text-bottom"></i> Ayuda</a>                       
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item text-danger" href="<?= inicio() ?>admin/logout"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Salir</a>
                    </div>
                </li>

            </ul>
            <!--end topbar-nav-->
        </nav>
        <!-- end navbar-->
    </div>
</div>
<!-- Top Bar End -->
