<?php include 'layout/header.php' ?>

    <div class="text-black text-center py-3 mt-5">
        <h1>Bienvenidos al Sistema de Gestión</h1>
        <h3>De Reparaciones de Dispositivos</h3>
        <a href="index.php?accion=login" class="btn btn-success mt-3">Iniciar Sesión</a>
    </div>
    
    <div class="row row-cols-md-4 mx-auto">
        <div class="col">
            <div class="card"  style="width: 18rem;">
                <img src="/../assets/img/clientes.webp" class="card-img-top " height="300" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Gestiòn de Clientes</h5>
                    <p class="card-text">Registra, Actualiza y consulta la informaciòn de los Clientes</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mx-3" style="width: 18rem;">
                <img src="/../assets/img/tecnicos.webp" class="card-img-top " height="300" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Gestiòn de Tecnicos</h5>
                    <p class="card-text">Registra, Actualiza y consulta la informaciòn de los Tecnicos</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mx-3" style="width: 18rem;">
                <img src="/../assets/img/Dispositivos.webp" class="card-img-top " height="300" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Gestiòn de Dispositivos</h5>
                    <p class="card-text">Registra, Actualiza y consulta la informaciòn de los Dispositivos</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mx-3" style="width: 18rem;">
                <img src="/../assets/img/Reparaciones.webp" class="card-img-top " height="300" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Gestiòn de Reparaciones</h5>
                    <p class="card-text">Registra, Actualiza y consulta la informaciòn de las Reparaciones</p>
                </div>
            </div>
        </div>
    </div>

<?php include 'layout/footer.php' ?>