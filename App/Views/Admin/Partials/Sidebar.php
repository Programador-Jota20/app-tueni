<!-- leftbar-tab-menu -->
<div class="startbar d-print-none">
    <div class="brand">
        <a href="index.php" class="logo">
            <span><img src="<?= asset('images/logo-sm.png') ?>" alt="logo-small" class="logo-sm"></span>
            <span>
                <img src="<?= asset('images/logo-light.png') ?>" alt="logo-large" class="logo-lg logo-light">
                <img src="<?= asset('images/logo-dark.png') ?>" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>

    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">

                <!-- Menú directamente aquí -->
                <ul class="navbar-nav mb-auto w-100">
                    <li class="menu-label mt-2"><span>Navegación</span></li>

                    <?php
                    $modCount = count($modulos);
                    for ($i = 0; $i < $modCount; $i++) {
                        $mod = $modulos[$i];

                        if ($mod['FlgMaestro'] == '1') {
                            $href = !empty($mod['IdHref']) ? inicio() . $mod['IdHref'] : '#';

                            // Buscar submódulos inmediatos
                            $subItems = [];
                            for ($j = $i + 1; $j < $modCount; $j++) {
                                if ($modulos[$j]['FlgMaestro'] == '0') {
                                    $subItems[] = $modulos[$j];
                                } elseif ($modulos[$j]['FlgMaestro'] == '1') {
                                    break; // siguiente maestro encontrado
                                }
                            }

                            if (!empty($subItems)) {
                                $collapseId = 'sidebar' . $mod['NomModulo'];
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" href="#' . $mod['IdHref'] . '" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="' . $mod['IdHref'] . '">';
                                echo '<i class="' . $mod['IconoClase'] . ' menu-icon"></i> <span>' . $mod['NomModulo'] . '</span>';
                                echo '</a>';
                                echo '<div class="collapse" id="' . $mod['IdHref'] . '"><ul class="nav flex-column">';
                                foreach ($subItems as $sub) {
                                    $subHref = !empty($sub['IdHref']) ? inicio() . $sub['IdHref'] : '#';
                                    echo '<li class="nav-item"><a class="nav-link" href="' . $subHref . '">' . $sub['NomModulo'] . '</a></li>';
                                }
                                echo '</ul></div></li>';
                            } else {
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" href="' . $href . '">';
                                echo '<i class="' . $mod['IconoClase'] . ' menu-icon"></i> <span>' . $mod['NomModulo'] . '</span>';
                                echo '</a></li>';
                            }
                        }
                    }
                    ?>
                </ul>
                <!-- Fin del menú -->

                <div class="update-msg text-center"> 
                    <div class="d-flex justify-content-center align-items-center thumb-lg update-icon-box rounded-circle mx-auto">
                        <img src="<?= asset('images/extra/party.gif') ?>" alt="" class="d-inline-block me-1" height="30">
                    </div>                   
                    <h5 class="mt-3">Felicidades</h5>
                    <p class="mb-3 text-muted">La app <?= app() ?> está actualizada a la versión</p>
                    <a href="javascript: void(0);" class="btn bg-black text-white shadow-sm rounded-pill">v <?= version() ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="startbar-overlay d-print-none"></div>
<!-- end leftbar-tab-menu-->
