<?php include 'layout/header.php' ?>

    <link rel="stylesheet" href="/assets/css/login.css">

    <div class="contenedor">
        <!-- From Uiverse.io by alexruix --> 
        <div class="form-box">
            <form action="index.php?accion=login" method="post" class="form">
                <span class="title">Iniciar Sesión</span>
                <span class="subtitle">Inicio sesión con tus credenciales</span>
                <div class="form-container">
                    <input type="text" name="nombre" class="input" placeholder="Usuario">
                    <input type="password" name="contraseña" class="input" placeholder="Contraseña">
                </div>
                <!-- Mensaje de error -->
                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'credencialesIncorrectas'): ?>
                    <div class="alert alert-danger text-center p-2">
                        Usuario o clave incorrectos.
                    </div>
                <?php endif; ?>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <div class="form-section">
                <p>No tienes una cuenta? <a href="index.php?accion=registrar">Crear Cuenta</a> </p>
            </div>
        </div>
    </div>

<?php include 'layout/footer.php' ?>