<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - <?= app() ?></title>
    <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenido <?= $_SESSION['username'] ?? '' ?> 🚀</h1>
        <a href="<?= inicio() ?>admin/logout" class="btn btn-danger">Cerrar sesión</a>
    </div>
</body>
</html>