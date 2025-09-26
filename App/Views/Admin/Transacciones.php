<?php
// Mostrar errores / old desde sesión (flash sencillo)
$ErrorMessage = $_SESSION['ErrorMessage'] ?? null;
$OldUsername  = $_SESSION['Old']['username'] ?? '';
unset($_SESSION['ErrorMessage'], $_SESSION['Old']);

$Campos = "Transacciones";
$title = $Campos." | " . app();
require_once  __DIR__ . '/Partials/Head.php';
require_once  __DIR__ . '/Partials/Topbar.php';
require_once  __DIR__ . '/Partials/Sidebar.php';
?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
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

            <!-- Card -->
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="card">

                        <!-- Card Header con filtros -->
                        <div class="card-header">
                            <div class="row g-2 align-items-end">

                                <!-- Tipo de transacción -->
                                <div class="col-12 col-sm-auto">
                                    <label for="filterTipo" class="form-label mb-0">Tipo</label>
                                    <select id="filterTipo" class="form-select form-select-sm">
                                        <option value="0">Todos</option>
                                        <option value="S">Salidas</option>
                                        <option value="I">Ingresos</option>
                                    </select>
                                </div>

                                <!-- Motivo -->
                                <div class="col-12 col-sm-auto">
                                    <label for="filterMotivo" class="form-label mb-0">Motivo</label>
                                    <select id="filterMotivo" class="form-select form-select-sm">
                                        <option value="0">Todos</option>
                                        <?php foreach($motivos as $m): ?>
                                            <option value="<?= $m['CodMotivo'] ?>"><?= $m['NomMotivo'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Línea -->
                                <div class="col-12 col-sm-auto">
                                    <label for="filterLinea" class="form-label mb-0">Código Línea</label>
                                    <input type="text" id="filterLinea" class="form-control form-control-sm" placeholder="CodLinea">
                                </div>

                                <!-- Apellidos / Nombre -->
                                <div class="col-12 col-sm-auto">
                                    <label for="filterNombre" class="form-label mb-0">Apellidos / Nombre</label>
                                    <input type="text" id="filterNombre" class="form-control form-control-sm" placeholder="Buscar">
                                </div>

                                <!-- Desde -->
                                <div class="col-12 col-sm-auto">
                                    <label for="filterDesde" class="form-label mb-0">Desde</label>
                                    <input type="date" id="filterDesde" class="form-control form-control-sm">
                                </div>

                                <!-- Hasta -->
                                <div class="col-12 col-sm-auto">
                                    <label for="filterHasta" class="form-label mb-0">Hasta</label>
                                    <input type="date" id="filterHasta" class="form-control form-control-sm">
                                </div>

                                <!-- Botón buscar -->
                                <div class="col-12 col-sm-auto d-flex align-items-end">
                                    <button id="btnBuscar" class="btn btn-primary w-100 w-sm-auto">Filtrar</button>
                                </div>

                            </div>
                        </div>

                        <!-- Card Body: Tabla -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabla-transacciones" class="table table-striped table-bordered align-middle text-center mb-0">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>CodCuenta</th>
                                            <th>Fecha</th>
                                            <th>Periodo</th>
                                            <th>Tipo</th>
                                            <th>Motivo</th>
                                            <th>CodLinea</th>
                                            <th>Linea</th>
                                            <th>Apellidos / Nombre</th>
                                            <th>Concepto</th>
                                            <th>Moneda</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr><td colspan="11">Cargando...</td></tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación -->
                            <div class="d-flex justify-content-end mt-2">
                                <ul id="pagination" class="pagination mb-0"></ul>
                            </div>
                        </div>

                    </div><!--end card--> 
                </div>
            </div>
        </div><!-- container -->

        <!-- Footer -->
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

    </div> <!-- end page content -->
</div> <!-- end page-wrapper -->

<!-- JS específico de Transacciones -->
 <script>window.APP_BASE_URL = "<?= inicio(); ?>";</script>
<script src="<?= asset('js/transacciones.js') ?>"></script>

<?php require_once  __DIR__ . '/Partials/footer.php'; ?>
