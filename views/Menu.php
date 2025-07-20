<?php include __DIR__ . '/../views/layout/header.php';?>
    <div class="mt-5 text-center" bis_skin_checked="1">
        <h2 class="m-0">Menú Principal</h2>
    </div>
    
   <p class="mb-4 text-center">
        Bienvenid@,
        <strong>
          <?= isset($_SESSION['Usuario']) ? strtoupper($_SESSION['Usuario']) : 'Usuario' ?>
        </strong>
    </p>
    
    <div class="container my-4" bis_skin_checked="1">
        <div class="row row-cols-1 row-cols-md-2 g-4" bis_skin_checked="1">
          <!-- Gestión de Clientes -->
          <div class="col" bis_skin_checked="1">
            <div class="card h-100 flex-row" bis_skin_checked="1">
              <img src="/../assets/img/clientes.webp" class="img-fluid h-100" style="width: 50%; object-fit: cover;" alt="Clientes">
              <div class="card-body" bis_skin_checked="1">
                <h5 class="card-title">Gestión de clientes</h5>
                <p class="card-text">Registra, Actualiza y consulta la información de los Clientes</p>
                <a href="index.php?accion=datoscliente" class="btn btn-primary mt-4">Operaciones</a>
              </div>
            </div>
          </div>

          <!-- Gestión de Técnicos -->
          <div class="col" bis_skin_checked="1">
            <div class="card h-100 flex-row" bis_skin_checked="1">
              <img src="/../assets/img/tecnicos.webp" class="img-fluid h-100" style="width: 50%; object-fit: cover;" alt="Técnicos">
              <div class="card-body" bis_skin_checked="1">
                <h5 class="card-title">Gestión de Técnicos</h5>
                <p class="card-text">Registra, Actualiza y consulta la información de los Técnicos</p>
                <a href="index.php?accion=datostecnico" class="btn btn-primary mt-4">Operaciones</a>
              </div>
            </div>
          </div>

          <!-- Gestión de Dispositivos -->
          <div class="col" bis_skin_checked="1">
            <div class="card h-100 flex-row" bis_skin_checked="1">
              <img src="/../assets/img/Dispositivos.webp" class="img-fluid h-100" style="width: 50%; object-fit: cover;" alt="Dispositivos">
              <div class="card-body" bis_skin_checked="1">
                <h5 class="card-title">Gestión de Dispositivos</h5>
                <p class="card-text">Registra, Actualiza y consulta la información de los Dispositivos</p>
                <a href="index.php?accion=datosdispositivo" class="btn btn-primary mt-4">Operaciones</a>
              </div>
            </div>
          </div>

          <!-- Gestión de Reparaciones -->
          <div class="col" bis_skin_checked="1">
            <div class="card h-100 flex-row" bis_skin_checked="1">
              <img src="/../assets/img/Reparaciones.webp" class="img-fluid h-100" style="width: 50%; object-fit: cover;" alt="Reparaciones">
              <div class="card-body" bis_skin_checked="1">
                <h5 class="card-title">Gestión de Reparaciones</h5>
                <p class="card-text">Registra, Actualiza y consulta la información de las Reparaciones</p>
                <a href="index.php?accion=datosreparacion" class="btn btn-primary mt-4">Operaciones</a>
              </div>
            </div>
          </div>

        </div>
    </div>

<?php include __DIR__ . '/../views/layout/footer.php';?>

