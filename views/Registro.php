<?php include 'layout/header.php' ?>

    <link rel="stylesheet" href="/assets/css/login.css">

    <div class="contenedor">
        <!-- From Uiverse.io by alexruix --> 
        <div class="form-box">
            <form action="index.php?accion=registrar" method="post" class="form">
                <span class="title">Crear un Cuenta</span>
                <div class="form-container">
                    <input type="text" name="nombre" class="input" placeholder="Usuario">
                    <input type="password" name="contraseña" class="input" placeholder="Contraseña">
                    <input type="password" name="contraseCnf" class="input" placeholder="Confirmar Contraseña">
                </div>
                <!-- Mensaje de error -->
                    <?php
                        $mensajes = ['contraseña' => ['Contraseñas no coinciden.', 'danger'],
                                    'sin_cambios' => ['No se realizaron cambios.', 'secondary'],
                    ];
                        if(isset($_GET['msg'], $mensajes[$_GET['msg']])){
                            [$texto, $tipo] = $mensajes[$_GET['msg']];
                        
                    ?>
                        <div class="alert alert-<?= $tipo ?> alert-dismissible fade show text-center mb-3" role="alert">
                            <?= htmlspecialchars($texto) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                        }
                    ?>
                <button type="submit">Crear Cuenta</button>
            </form>
            <div class="form-section">
                <p>Ya tienes una cuenta? <a href="index.php?accion=login">Iniciar Sesión</a> </p>
            </div>
        </div>
    </div>

<?php include 'layout/footer.php' ?>