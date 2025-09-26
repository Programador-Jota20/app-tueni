<?php
    // Mostrar errores / old desde sesión (flash sencillo)
    $ErrorMessage = $_SESSION['ErrorMessage'] ?? null;
    $OldUsername  = $_SESSION['Old']['username'] ?? '';
    unset($_SESSION['ErrorMessage'], $_SESSION['Old']);

    $namepage = "Módulos";
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
                        <h4 class="page-title ms-1"><?= $namepage; ?></h4>
                        <div class="welcome-text">
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
                                    <li class="welcome-text me-2">                    
                                        <h4 class="card-title">Lista de <?= $namepage; ?></h4> 
                                    </li>  
                                    <li class="d-inline-block me-2">
                                    <a id="btnNuevo" class="btn btn-sm btn-soft-primary" href="javascript:void(0);" role="button">
                                        <i class="fas fa-plus me-2"></i>Nuevo
                                    </a>
                                    </li>
                                    <li class="d-inline-block me-2">
                                        <a id="GuardarOrden" class="btn btn-sm btn-soft-success" href="#" role="button">
                                            <i class="fas fa-save me-2"></i>Guardar Cambios
                                        </a>
                                    </li>                   
                                </div><!--end col-->
                            </div>  <!--end row-->                                  
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabla-mover"  class="table table-striped table-bordered align-middle text-center mb-0">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th style="width: 40px;">Mover</th>
                                            <th class="text-start">Descripción</th>
                                            <th>Maestro</th>
                                            <th>Icono</th>
                                            <th>Clase</th>
                                            <th>Href</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (!empty($modulos)): ?>
                                            <?php foreach ($modulos as $mod): ?>
                                                <tr>
                                                    <td class="handle"><i class="las la-arrows-alt"></i></td>

                                                    <!-- Descripción alineada a la izquierda -->
                                                    <td class="text-start"><?= htmlspecialchars($mod['NomModulo']) ?></td>

                                                    <!-- Maestro como checkbox -->
                                                    <td>
                                                        <input type="checkbox" 
                                                            class="toggleMaestro" 
                                                            data-id="<?= $mod['CodModulo'] ?>" 
                                                            <?= $mod['FlgMaestro'] == 1 ? 'checked' : '' ?>>
                                                    </td>

                                                    <!-- Vista previa icono -->
                                                    <td><i class="<?= htmlspecialchars($mod['IconoClase']) ?>"></i></td>

                                                    <!-- Clase icono -->
                                                    <td class="text-nowrap"><?= htmlspecialchars($mod['IconoClase']) ?></td>

                                                    <!-- Href -->
                                                    <td><?= htmlspecialchars($mod['IdHref']) ?></td>

                                                    <!-- Acciones -->
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-primary btnEditar" 
                                                                    data-id="<?= $mod['CodModulo'] ?>">
                                                                <i class="las la-pen"></i>
                                                            </button>
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger btnEliminar" 
                                                                    data-id="<?= $mod['CodModulo'] ?>">
                                                                <i class="las la-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No hay módulos disponibles</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--end card--> 
                </div> <!--end col--> 
            </div>
        </div><!-- container -->

        <!-- Modal Crear/Editar -->
        <div class="modal fade" id="modalModulo" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md"><!-- tamaño más compacto -->
                <div class="modal-content">
                <form id="formModulo">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                    <input type="hidden" id="CodModulo" name="CodModulo">

                    <div class="row g-3">
                        <!-- Descripción -->
                        <div class="col-12">
                        <label for="NomModulo" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="NomModulo" name="NomModulo" required>
                        </div>

                        <!-- Maestro + Href -->
                        <div class="col-6">
                        <label class="form-label d-block">Maestro</label>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" id="FlgMaestro" name="FlgMaestro" class="form-check-input">
                            <label for="FlgMaestro" class="form-check-label">Marque para activar</label>
                        </div>
                        </div>

                        <div class="col-6">
                        <label for="IdHref" class="form-label">Href</label>
                        <input type="text" class="form-control" id="IdHref" name="IdHref" placeholder="SliderModulo">
                        </div>


                        <!-- Icono -->
                        <div class="col-8">
                        <label for="IconoClase" class="form-label">Clase Icono</label>
                        <input type="text" class="form-control" id="IconoClase" name="IconoClase" placeholder="ej: las la-home">
                        </div>
                        <div class="col-4 d-flex flex-column align-items-center justify-content-center">
                        <label class="form-label">Vista Previa</label>
                        <i id="previewIcon" class="las la-home fa-2x"></i>
                        </div>
                    </div>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

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

<!-- SortableJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<!-- Script específico -->
<script>window.APP_BASE_URL = "<?= inicio(); ?>";</script>
<script src="<?= asset('js/modulos.js') ?>"></script>

<?php require_once  __DIR__ . '/Partials/footer.php'; ?>
