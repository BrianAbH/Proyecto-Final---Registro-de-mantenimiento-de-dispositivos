<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fda2d00f8d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    
    <script src="/../../assets/js/time.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-dark bg-dark">
        <h2 class="text-white ms-3">Sitio G2 RepairTrack</h2>
        <!-- Enlaces de navegación a distintas secciones -->
        <?php if(!empty($_SESSION['Usuario'])): ?>
            <ul class="nav">
                <li class="nav-item">
                    <a class="btn btn-danger ms-3 mx-3" href="index.php?accion=logout">Cerrar Sesión</a>
                </li>
            </ul>
        <?php else: ?>
            <ul class="nav">
                <li class="nav-item">
                    <a class="btn btn-primary justify-content-end mx-5" href="index.php?accion=inicio">Inicio</a>
                </li>
            </ul>
        <?php endif ?>
    </nav>
    