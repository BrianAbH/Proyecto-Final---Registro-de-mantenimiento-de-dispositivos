<?php 
    include __DIR__ . '/../layout/header.php';
    require_once __DIR__ . '/../../controllers/ClienteControll.php';
    $dispositivo = new DispositivoControll();
    $accion = $_GET['accion'];
    if($accion === 'obtenerPorCliente'){
        $dispositivoData = $dispositivo->obtenerPorClienteDispositivo();
    }else{
        $dispositivoData = $dispositivo->obtenerTodosDispositivo();
    }
    $clientes = $dispositivo->obtenerClientes();
    $tipos = $dispositivo->obtenerTipos();
    $sistema = $dispositivo->obtenerSistema();
?>  
    <!--Busqueda -->
    <div class="card m-3">
        <div class="card-header bg-dark text-white">
            <a href="index.php?accion=menu" class="navbar-brand" style="color:white;" class="ms-3"><img src="/../assets/icons/back.svg" alt="">Volver al menú</a>
            <i class="bi bi-arrow-return-left"></i>
            <img src="/../assets/icons/dispositivo.svg" style="margin-left:780px;" alt="">Dispositivos   
        </div>
        <div class="card-body mx-auto">
            <form class="row row-col-3" action="index.php?accion=obtenerPorCliente" method="post">
                <input class="form-control" style="width: 200px;" name="obtNombre" type="text" placeholder="Buscar por Cliente" aria-label="Search">
                <button class="btn btn-info ms-3" style="width: 80px;" type="submit">Buscar</button>
                <div style="width: 10px">
                    <a href="index.php?accion=datosdispositivo" >
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
                <div class="card-header bg-dark text-center text-white">
                    <img src="/../assets/icons/dispositivo.svg" class="me-2" alt="">Informacion del Dispositivo
                </div>
                <div class="p-3 mt-3">
                    <!-- Mensaje de error -->
                    <?php
                        $mensajes = ['actualizado' => ['Dispositivo Actualizado orrectamente.', 'primary'],
                                    'guardado' => ['Dispositivo Guardado Correctamente.', 'success'],
                                    'eliminado' => ['Dispositivo Eliminado Correctamente.', 'danger'],
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
                    <!--Formulario -->
                    <form action="index.php?accion=insertarDispositivo" method="post">
                        <div class="row">
                            <div class="col">
                                <label class="mb-2" for="cliente">Clientes</label>
                                <select class="form-select" name="ID_CLIENTE" id="cliente">
                                    <?php foreach($clientes as $Clien): ?>
                                        <option value="<?= $Clien['ID_CLIENTE'] ?>"> <?= $Clien['NOMBRE_COMPLETO'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col mt-4">
                                <label for="apellido">Tipo de Dispositivo</label>
                                    <?php foreach($tipos as $tip): ?>
                                        <div class="form-check text-start">
                                            <input name="ID_TIPO" class="form-check-input" type="radio" value="<?= $tip['ID_TIPO'] ?>" name="radioDefault" id="radioDefault1">
                                            <label class="form-check-label" for="radioDefault1"><?= $tip['NOMBRE'] ?></label>
                                        </div>
                                    <?php endforeach; ?>
                            </div>

                            <div class="col mt-4">
                                <label for="apellido">Sistema Operativo</label>
                                    <?php foreach($sistema as $sis): ?>
                                        <div class="form-check text-start">
                                            <input name="ID_SISTEMA" class="form-check-input" type="radio" value="<?= $sis['ID_SISTEMA']?>" name="radioDefault" id="radioDefault1">
                                            <label class="form-check-label" for="radioDefault1"><?= $sis['NOMBRE']?></label>
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-4">
                                <label for="marca">Marca</label>
                                <input type="text" name="marca" class="form-control" id="marca" placeholder="Marca" required>
                            </div>

                            <div class="col mt-4">
                                <label for="modelo">Modelo</label>
                                <input type="text" name="modelo" class="form-control" id="modelo" placeholder="modelo" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-4">
                                <label for="anio">Año de Compra</label>
                                <input type="text" name="anio" class="form-control" id="anio" placeholder="Año" required>
                            </div>

                            <div class="col mt-4">
                                <label for="fechaI">Fecha de Registro</label>
                                <input type="date" name="fechaI" class="form-control" id="fechaI" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success mt-4 w-100">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contenedor de la tabla -->
        <div class="col-auto text-center ml-3 w-75 overflow-auto">
            <div class="card" style="height: 520px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="position: sticky; top: 0;">Id</th>
                            <th scope="col" style="position: sticky; top: 0;">Nombre del Cliente</th>
                            <th scope="col" style="position: sticky; top: 0;">Tipo de Dispositivo</th>
                            <th scope="col" style="position: sticky; top: 0;">Sistema Operativo</th>
                            <th scope="col" style="position: sticky; top: 0;">Marca del Dispositivo</th>
                            <th scope="col" style="position: sticky; top: 0;">Modelo del Dispositivo</th>
                            <th scope="col" style="position: sticky; top: 0;">Año del Dispositivo</th>
                            <th scope="col" style="position: sticky; top: 0;">Fecha de Registro</th>
                            <th scope="col" style="position: sticky; top: 0;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dispositivoData as $dispositivo): ?>
                            <tr>
                                <td><?= $dispositivo['ID_DISPOSITIVO'] ?></td>
                                <td><?= $dispositivo['NOMBRE_COMPLETO'] ?></td>
                                <td><?= $dispositivo['NOMBRE'] ?></td>
                                <td><?= $dispositivo['SISTEMA'] ?></td>
                                <td><?= $dispositivo['MARCA'] ?></td>
                                <td><?= $dispositivo['MODELO'] ?></td>
                                <td><?= $dispositivo["ANIO"] ?></td>
                                <td><?= $dispositivo["FECHA_INGRESO"] ?></td>
                                <td>
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#actualizar<?= $dispositivo['ID_DISPOSITIVO']?>">
                                        <i class="fa-solid fa-pen" style="color: #e69a0d;"></i>
                                    </button >
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#eliminar<?= $dispositivo['ID_DISPOSITIVO']?>">
                                        <i class="fa-solid fa-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal actualizar-->
                            <div class="modal fade" id="actualizar<?= $dispositivo['ID_DISPOSITIVO'] ?>"  tabindex="-1" role="dialog" aria-labelledby="editarLabel<?= $dispositivo['ID_DISPOSITIVO'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Datos del Dispositivo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="index.php?accion=actualizarDispositivo" method="post">
                                                <div class="row mt-3">
                                                    <div class="col-2">
                                                        <label for="id">Id</label>
                                                        <input type="text" name="ID_DISPOSITIVO" value="<?= $dispositivo['ID_DISPOSITIVO']  ?>" class="form-control" id="ID_CLIENTE" readonly>
                                                    </div>

                                                    <div class="col">
                                                        <label for="id">Cliente</label>
                                                        <select class="form-select" name="ID_CLIENTE" id="cliente">
                                                            <option value="<?= $dispositivo['ID_CLIENTE']?>"><?= $dispositivo['NOMBRE_COMPLETO']?></option>
                                                            <?php foreach($clientes as $Clien): ?>
                                                                <?php if($Clien['ID_CLIENTE'] != $dispositivo['ID_CLIENTE']): ?>
                                                                    <option value="<?= $Clien['ID_CLIENTE'] ?>"> <?= $Clien['NOMBRE_COMPLETO'] ?></option>
                                                                <?php endif?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="">Tipo de Dispositivo</label>
                                                            <div class="form-check text-start">
                                                                <input name="ID_TIPO" class="form-check-input " type="radio" value="<?= $dispositivo['ID_TIPO'] ?>" name="radioDefault" id="radioDefault1" checked>
                                                                <label class="form-check-label" for="radioDefault1"><?= $dispositivo['NOMBRE'] ?></label>
                                                            </div>
                                                            <?php foreach($tipos as $tip): ?>
                                                                <?php if($tip['ID_TIPO'] != $dispositivo['ID_TIPO']): ?>
                                                                    <div class="form-check text-start">
                                                                        <input name="ID_TIPO" class="form-check-input" type="radio" value="<?= $tip['ID_TIPO'] ?>" name="radioDefault" id="radioDefault1">
                                                                        <label class="form-check-label" for="radioDefault1"><?= $tip['NOMBRE'] ?></label>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div class="col">
                                                            <label for="">Sistema Operativo</label>
                                                            <div class="form-check text-start">
                                                                <input name="ID_SISTEMA" class="form-check-input " type="radio" value="<?= $dispositivo['ID_SISTEMA'] ?>" name="radioDefault" id="radioDefault1" checked>
                                                                <label class="form-check-label" for="radioDefault1"><?= $dispositivo['SISTEMA'] ?></label>
                                                            </div>
                                                            <?php foreach($sistema as $sis): ?>
                                                                <?php if($sis['ID_SISTEMA'] != $dispositivo['ID_SISTEMA']): ?>
                                                                    <div class="form-check text-start">
                                                                        <input name="ID_SISTEMA" class="form-check-input" type="radio" value="<?= $sis['ID_SISTEMA'] ?>" name="radioDefault" id="radioDefault1">
                                                                        <label class="form-check-label" for="radioDefault1"><?= $sis['NOMBRE'] ?></label>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <label for="marca">Marca</label>
                                                        <input type="text" class="form-control" value="<?= $dispositivo['MARCA']?> " name="marca" id="marca" placeholder="marca">
                                                    </div>

                                                    <div class="col">
                                                        <label for="modelo">Modelo</label>
                                                        <input type="text" class="form-control" value="<?= $dispositivo['MODELO']?> " name="modelo" id="modelo" placeholder="Modelo">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <label for="anio">Año de Compra</label>
                                                        <input type="text" class="form-control" value="<?= $dispositivo['ANIO']?> " name="anio" id="anio" placeholder="Año">
                                                    </div>
                                                    <div class="col">
                                                        <label for="fechaI">Fecha de Ingreso</label>
                                                        <input type="date" name="fechaI" class="form-control" value="<?= $dispositivo['FECHA_INGRESO']?>"  id="fechaI" required>
                                                    </div>
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
                            <div class="modal" tabindex="-1" role="dialog" id="eliminar<?= $dispositivo['ID_DISPOSITIVO'] ?>"  tabindex="-1" role="dialog" aria-labelledby="editarLabel<?= $dispositivo['ID_DISPOSITIVO']?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Estas seguro que quieres eliminar este Dispositivo?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <strong>Cliente: </strong><?= $dispositivo['NOMBRE_COMPLETO'] ?> <br>
                                            <strong>Tipo de Dispositivo: </strong><?= $dispositivo['NOMBRE'] ?><br>
                                            <strong>Sistema Operativo: </strong><?= $dispositivo['SISTEMA'] ?><br>
                                            <strong>Marca: </strong><?= $dispositivo['MARCA'] ?><br>
                                            <strong>Modelo: </strong><?= $dispositivo['MODELO'] ?><br>
                                            <strong>Año de Compra: </strong><?= $dispositivo['ANIO'] ?><br>
                                            <strong>Fecha de Registro: </strong><?= $dispositivo['FECHA_INGRESO'] ?><br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <a href="index.php?accion=eliminarDispositivo&id=<?= $dispositivo['ID_DISPOSITIVO'] ?>" type="button" class="btn btn-primary">Eliminar Dispositivo</a>
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

