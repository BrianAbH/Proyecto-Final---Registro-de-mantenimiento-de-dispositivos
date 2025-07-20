<?php 
    include __DIR__ . '/../layout/header.php';
    require_once __DIR__ . '/../../controllers/ClienteControll.php';
    $clientes = new ClienteControll();
    $accion = $_GET['accion'];
    if($accion === 'obtenerPorCedulaCliente'){
        $clienteData = $clientes->obtenerPorCedulaCliente();
    }else{
        $clienteData = $clientes->obtenerTodos();
    }

    $sector = $clientes->obtenerSector();
    $genero = $clientes->obtenerGenero();
?>  
    <!--Busqueda -->
    <div class="card m-3">
        <div class="card-header bg-dark text-white">
            <a href="index.php?accion=menu" class="navbar-brand" style="color:white;" class="ms-3"><img src="/../assets/icons/back.svg" alt="">Volver al menú</a>
            <i class="bi bi-arrow-return-left"></i>
            <img src="/../assets/icons/cliente.svg" style="margin-left:780px;" alt="">Clientes   
        </div>
        <div class="card-body mx-auto">
            <form class="row row-col-3" action="index.php?accion=obtenerPorCedulaCliente" method="post">
                <input class="form-control" style="width: 200px;" name="obtCedula" type="text" placeholder="Buscar por Cedula" aria-label="Search">
                <button class="btn btn-info ms-3" style="width: 80px;" type="submit">Buscar</button>
                <div style="width: 10px">
                    <a href="index.php?accion=datoscliente" >
                        <img src="/../assets/img/filtrar.png" class="m-2" alt="" style="width: 20px">
                    </a> 
                </div>
            </form>
        </div>
    </div>

    <div class="row m-4">
        <!--Contenedor del Formulario -->
        <div class="col-auto text-center w-25">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <img src="/../assets/icons/cliente.svg" class="me-2" alt="">Informacion del Cliente
                </div>
                <div class="p-3 mt-3">
                    <!-- Mensaje de error -->
                    <?php
                        $mensajes = ['actualizado' => ['Cliente Actualizado orrectamente.', 'primary'],
                                    'guardado' => ['Cliente Guardado Correctamente.', 'success'],
                                    'eliminado' => ['Cliente Eliminado Correctamente.', 'danger'],
                                    'sin_cambios' => ['No se realizaron cambios.', 'secondary'],
                                    'duplicada' => ['Ya existe un Cliente con ese Cédula.', 'warning'],
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
                    <!--Formulario -->
                    <form action="index.php?accion=insertCliente" method="post">
                        <div class="row">
                            <div class="col">
                                <label for="cedula">Cedula</label>
                                <input type="text" name="cedula" class="form-control" id="cedula" placeholder="Cedula" required>
                            </div>
                            <div class="col">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-4">
                                <label for="apellido">Apellidos</label>
                                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required>
                            </div>
                            <div class="col mt-4">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="correo">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="brian@gmail.com" required>
                        </div>

                        <div class="mt-4">
                            <label for="direccion">Direccion</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Av. Nueve de Octubre" required>
                        </div>

                        <div class="row">
                            <div class="col mt-4">
                                <label for="genero">Genero</label>
                                <?php foreach($genero as $gen): ?>
                                    <div class="form-check text-start">
                                            <input class="form-check-input" name="ID_GENERO" value="<?= $gen['ID_GENERO']?>"  name="ID_GENERO" id="ID_GENERO" type="radio" required>
                                            <label class="form-check-label" for="ID_GENERO"><?= $gen['NOMBRE']?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="col mt-4">
                                <label for="sector">Sector</label>
                                <?php foreach($sector as $sec): ?>
                                    <div class="form-check text-start">
                                            <input name="ID_SECTOR" value="<?= $sec['ID_SECTOR']?>" class="form-check-input" name="ID_SECTOR" id="ID_SECTOR" type="radio" required>
                                            <label class="form-check-label" for="ID_SECTOR"><?= $sec['NOMBRE']?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="fechaI">Fecha de Registro</label>
                            <input type="date" class="form-control" name="fechaI" id="fechaI" required>
                        </div>

                        <button type="submit" class="btn btn-success mt-4 w-100">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contenedor de la tabla -->
        <div class="col-auto text-center ml-3 w-75 overflow-auto">
            <div class="card" style="height: 687px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="position: sticky; top: 0;">Id</th>
                            <th scope="col" style="position: sticky; top: 0;">Cedula</th>
                            <th scope="col" style="position: sticky; top: 0;">Nombre</th>
                            <th scope="col" style="position: sticky; top: 0;">Apellido</th>
                            <th scope="col" style="position: sticky; top: 0;">Nombre Completo</th>
                            <th scope="col" style="position: sticky; top: 0;">Telefono</th>
                            <th scope="col" style="position: sticky; top: 0;">Correo</th>
                            <th scope="col" style="position: sticky; top: 0;">Direccion</th>
                            <th scope="col" style="position: sticky; top: 0;">Genero</th>
                            <th scope="col" style="position: sticky; top: 0;">Sector</th>
                            <th scope="col" style="position: sticky; top: 0;">Fecho de Registro</th>
                            <th scope="col" style="position: sticky; top: 0;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clienteData as $Cliente): ?>
                            <tr>
                                <td><?= $Cliente['ID_CLIENTE'] ?></td>
                                <td><?= $Cliente['CEDULA'] ?></td>
                                <td><?= $Cliente['NOMBRE'] ?></td>
                                <td><?= $Cliente['APELLIDO'] ?></td>
                                <td><?= $Cliente['NOMBRE_COMPLETO'] ?></td>
                                <td><?= $Cliente['TELEFONO'] ?></td>
                                <td><?= $Cliente['CORREO'] ?></td>
                                <td><?= $Cliente['DIRECCION'] ?></td>
                                <td><?= $Cliente['GENERO'] ?></td>
                                <td><?= $Cliente['SECTOR'] ?></td>
                                <td><?= $Cliente['FECHA_INGRESO'] ?></td>
                                <td>
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#actualizar<?= $Cliente['ID_CLIENTE']?>">
                                        <i class="fa-solid fa-pen" style="color: #e69a0d;"></i>
                                    </button >
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#eliminar<?= $Cliente['ID_CLIENTE']?>">
                                        <i class="fa-solid fa-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal actualizar-->
                            <div class="modal fade" id="actualizar<?= $Cliente['ID_CLIENTE'] ?>"  tabindex="-1" role="dialog" aria-labelledby="editarLabel<?= $Cliente['ID_CLIENTE'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Datos del Cliente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <form action="index.php?accion=actualizarCliente" method="post">
                                                <div class="row mt-3">
                                                    <div class="col">
                                                        <label for="id">Id</label>
                                                        <input type="text" name="ID_CLIENTE" value="<?= $Cliente['ID_CLIENTE']  ?>" class="form-control" id="ID_CLIENTE" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="cedula">Cedula</label>
                                                        <input type="text" name="cedula" value="<?= $Cliente['CEDULA']  ?>" class="form-control" id="cedula" placeholder="Cedula">
                                                    </div>
                                                    <div class="col">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" class="form-control" value="<?= $Cliente['NOMBRE']  ?>" name="nombre" id="nombre" placeholder="Nombre">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <label for="apellido">Apellidos</label>
                                                        <input type="text" name="apellido" value="<?= $Cliente['APELLIDO'] ?> " class="form-control" id="apellido" placeholder="Apellido">
                                                    </div>
                                                    <div class="col">
                                                        <label for="telefono">Telefono</label>
                                                        <input type="text" class="form-control" value="<?= $Cliente['TELEFONO']  ?> " name="telefono" id="telefono" placeholder="Telefono">
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                        <label for="correo">Correo</label>
                                                        <input type="email" class="form-control" value="<?= $Cliente['CORREO']  ?> " name="correo" id="correo" placeholder="brian@gmail.com">
                                                </div>

                                                <div class="mt-4">
                                                        <label for="direccion">Direccion</label>
                                                        <input type="text" class="form-control" value="<?= $Cliente['DIRECCION']  ?> " name="direccion" id="direccion" placeholder="Av. Nueve de Octubre">
                                                </div>

                                                <div class="row ">
                                                    <div class="col mt-4">
                                                        <label for="genero">Genero</label>
                                                        <div class="form-check text-start">
                                                            <input class="form-check-input" name="ID_GENERO" value="<?= $Cliente['ID_GENERO']?>"  name="ID_GENERO" id="ID_GENERO" type="radio" required checked>
                                                            <label class="form-check-label" for="ID_GENERO"><?= $Cliente['GENERO']?></label>
                                                        </div>
                                                        <?php foreach($genero as $gen): ?>
                                                            <?php if($gen['ID_GENERO']!= $Cliente['ID_GENERO']):  ?>
                                                                <div class="form-check text-start">
                                                                        <input class="form-check-input" name="ID_GENERO" value="<?= $gen['ID_GENERO']?>"  name="ID_GENERO" id="ID_GENERO" type="radio" required>
                                                                        <label class="form-check-label" for="ID_GENERO"><?= $gen['NOMBRE']?></label>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>

                                                    <div class="col mt-4">
                                                        <label for="sector">Sector</label>
                                                        <div class="form-check text-start">
                                                                <input name="ID_SECTOR" value="<?= $Cliente['ID_SECTOR']?>" class="form-check-input" name="ID_SECTOR" id="ID_SECTOR" type="radio" required checked>
                                                                <label class="form-check-label" for="ID_SECTOR"><?= $Cliente['SECTOR']?></label>
                                                        </div>
                                                        <?php foreach($sector as $sec): ?>
                                                            <?php if($sec['ID_SECTOR']!= $Cliente['ID_SECTOR']):  ?>
                                                                <div class="form-check text-start">
                                                                        <input name="ID_SECTOR" value="<?= $sec['ID_SECTOR']?>" class="form-check-input" name="ID_SECTOR" id="ID_SECTOR" type="radio" required>
                                                                        <label class="form-check-label" for="ID_SECTOR"><?= $sec['NOMBRE']?></label>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <label for="fechaI">Fecha de Ingreso</label>
                                                    <input type="date" class="form-control" value="<?= $Cliente['FECHA_INGRESO']?>" name="fechaI" id="fechaI" required>
                                                </div>

                                                <div class="modal-footer mt-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Eliminar-->
                            <div class="modal" tabindex="-1" role="dialog" id="eliminar<?= $Cliente['ID_CLIENTE'] ?>"  tabindex="-1" role="dialog" aria-labelledby="editarLabel<?= $Cliente['ID_CLIENTE'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Estas seguro que quieres eliminar este cliente?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <strong>Cédula: </strong><?= $Cliente['CEDULA'] ?> <br>
                                            <strong>Nombre: </strong><?= $Cliente['NOMBRE'] ?><br>
                                            <strong>Apellido: </strong><?= $Cliente['APELLIDO'] ?><br>
                                            <strong>Teléfono: </strong><?= $Cliente['TELEFONO'] ?><br>
                                            <strong>Correo: </strong><?= $Cliente['CORREO'] ?><br>
                                            <strong>Dirección: </strong><?= $Cliente['DIRECCION'] ?><br>
                                            <strong>Genero: </strong><?= $Cliente['GENERO'] ?><br>
                                            <strong>Sector: </strong><?= $Cliente['SECTOR'] ?><br>
                                            <strong>Fecha de Ingreso: </strong><?= $Cliente['FECHA_INGRESO'] ?><br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <a href="index.php?accion=eliminarCliente&id=<?= $Cliente['ID_CLIENTE'] ?>" type="button" class="btn btn-primary">Eliminar Cliente</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

<?php include __DIR__ . '/../layout/footer.php'?>

