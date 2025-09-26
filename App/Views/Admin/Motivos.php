<?php
    // Flash de errores
    $ErrorMessage = $_SESSION['ErrorMessage'] ?? null;
    $OldUsername  = $_SESSION['Old']['username'] ?? '';
    unset($_SESSION['ErrorMessage'], $_SESSION['Old']);

    // 4 formas de la palabra
    $Campo   = "Motivo";   // Singular con mayúscula
    $Campos  = "Motivos";  // Plural con mayúscula
    $camp    = "motivo";   // Singular en minúscula
    $camps   = "motivos";  // Plural en minúscula

    $title = $Campos." | " . app();

    require_once  __DIR__ . '/Partials/Head.php';
    require_once  __DIR__ . '/Partials/Topbar.php';
    require_once  __DIR__ . '/Partials/Sidebar.php';
?>

<!-- Contenido Pagina -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                        <h4 class="page-title ms-1"><?= $Campos; ?></h4>
                        <div class="welcome-text">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#"><?= app() ?></a></li>
                                <li class="breadcrumb-item active"><?= $Campos; ?></li>
                            </ol>
                        </div>                            
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Card formulario -->
                <div class="col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Registrar <?= $Campo; ?></h4>
                        </div>
                        <div class="card-body">
                            <form id="formRegistrar<?= $Campo; ?>">
                                <div class="mb-3">
                                    <label for="Cod<?= $Campo; ?>" class="form-label">Código</label>
                                    <input type="text" class="form-control" id="Cod<?= $Campo; ?>" name="Cod<?= $Campo; ?>" readonly placeholder="0">
                                </div>
                                <!-- Nuevo campo TipoTransaccion -->
                                <div class="mb-3">
                                    <label for="TipoTransaccion" class="form-label">Tipo de Transacción</label>
                                    <select class="form-select" id="TipoTransaccion" name="TipoTransaccion">
                                        <option value="I">Ingreso</option>
                                        <option value="S">Salida</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="Nom<?= $Campo; ?>" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" id="Nom<?= $Campo; ?>" name="Nom<?= $Campo; ?>" placeholder="Ingrese nombre del <?= $camp; ?>">
                                </div>
                                <div class="d-flex flex-wrap gap-2 justify-content-between">
                                    <button type="reset" class="btn btn-sm btn-soft-secondary" id="btnCancelar<?= $Campo; ?>">Cancelar</button>
                                    <button type="submit" class="btn btn-sm btn-soft-primary" id="btnGuardar<?= $Campo; ?>">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card tabla -->
                <div class="col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Lista de <?= $Campos; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle text-center mb-0">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>Código</th>
                                            <th class="text-start">Nombre del <?= $camp; ?></th>
                                            <th class="text-start">Tipo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if(isset($$camps) && is_array($$camps) && count($$camps) > 0): ?>
                                            <?php foreach ($$camps as $$camp): ?>
                                                <tr>
                                                    <td><?= $$camp['Cod'.$Campo]; ?></td>
                                                    <td class="text-start"><?= $$camp['Nom'.$Campo]; ?></td>
                                                    <td class="text-start">
                                                        <?= ($$camp['TipoTransaccion'] === 'I') ? 'Ingreso' : 'Salida'; ?>
                                                    </td>                                                    <td>
                                                        <?php if($$camp['FlgEli'] == '0'): ?>
                                                            <span class="badge bg-success">Activo</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger">Inactivo</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-primary btnEditar<?= $Campo; ?>" 
                                                                    data-id="<?= $$camp['Cod'.$Campo]; ?>">
                                                                <i class="las la-pen"></i>
                                                            </button>
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger btnEliminar<?= $Campo; ?>" 
                                                                    data-id="<?= $$camp['Cod'.$Campo]; ?>">
                                                                <i class="las la-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4">No hay <?= $camps; ?> registrados</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    © <script> document.write(new Date().getFullYear()) </script>
                                    <?= app() ?>
                                    <span class="text-muted d-none d-sm-inline-block float-end">
                                        Todos los derechos reservados.
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Script específico -->
<script>window.APP_BASE_URL = "<?= inicio(); ?>";</script>
<script src="<?= asset('js/'. $camps .'.js') ?>"></script>

<?php require_once  __DIR__ . '/Partials/footer.php'; ?>

