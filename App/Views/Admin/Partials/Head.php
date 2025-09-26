<!DOCTYPE html>
<html lang="es" dir="ltr" data-startbar="dark" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?? "Dashboard | " . app() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="<?= app() ?> - Sistema de Administración" name="description" />
    <meta content="<?= autor() ?>" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?= asset('images/favicon.ico') ?>">
    
    <!-- App css -->
    <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('css/app.min.css') ?>" rel="stylesheet" type="text/css" />
</head>

<body>
