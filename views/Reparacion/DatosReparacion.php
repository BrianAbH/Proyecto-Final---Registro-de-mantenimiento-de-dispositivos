<?php 
    include __DIR__ . '/../layout/header.php';
    require_once __DIR__ . '/../../controllers/ReparacionControll.php';
    $reparacion = new ReparacionControll();
    $accion = $_GET['accion'];
    if($accion === 'obtenerPorClienteReparacion'){
        $reparacionData = $reparacion->obtenerPorClienteReparacion();
    }else{
        $reparacionData = $reparacion->obtenerTodasReparacions();
    }

    $dispositivo = $reparacion->obtenerDispositivo();
    $tecnico = $reparacion->obtenerTecnico();
?>  
    <!--Busqueda -->
    <div class="card m-3">
        <div class="card-header bg-dark text-white">
            <a href="index.php?accion=menu" class="navbar-brand" style="color:white;" class="ms-3"><img src="/../assets/icons/back.svg" alt="">Volver al menú</a>
            <i class="bi bi-arrow-return-left"></i>
            <img src="/../assets/icons/reparacion.svg" style="margin-left:780px;" alt="">Reparaciones   
        </div>
        <div class="card-body mx-auto">
            <form class="row row-col-3" action="index.php?accion=obtenerPorClienteReparacion" method="post">
                <input class="form-control" style="width: 200px;" name="obtNombre" type="text" placeholder="Buscar por Cliente" aria-label="Search">
                <button class="btn btn-info ms-3" style="width: 80px;" type="submit">Buscar</button>
                <div style="width: 10px">
                    <a href="index.php?accion=datosreparacion" >
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
                    <img src="/../assets/icons/reparacion.svg" class="me-2" alt="">Informacion de la Reparación
                </div>
                <div class="p-3 mt-3">
                    <!-- Mensaje de error -->
                    <?php
                        $mensajes = ['actualizado' => ['Reparación Actualizada orrectamente.', 'primary'],
                                    'guardado' => ['Reparación Guardada Correctamente.', 'success'],
                                    'eliminado' => ['Reparación Eliminada Correctamente.', 'danger'],
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
                    <form action="index.php?accion=insertaReparacion" method="post">
                        <div class="row">
                            <div class="col">
                                <label class="mb-2" for="cliente">Clientes</label>
                                <select class="form-select" name="ID_DISPOSITIVO" id="cliente">
                                    <?php foreach($dispositivo as $dis): ?>
                                        <option value="<?= $dis['ID_DISPOSITIVO'] ?>"> <?= $dis['NOMBRE_COMPLETO'] ?> <?= $dis['MODELO'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col">
                                <label class="mb-2" for="cliente">tecnico</label>
                                <select class="form-select" name="ID_TECNICO" id="tecnico">
                                    <?php foreach($tecnico as $tec): ?>
                                        <option value="<?= $tec['ID_TECNICO'] ?>"> <?= $tec['NOMBRE_COMPLETO'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col mt-4">
                                <label for="repuestos">Repuestos</label>
                                <input type="text" name="repuestos" class="form-control" id="repuestos" placeholder="Repuestos" required>
                            </div>

                            <div class="col mt-4">
                                <label for="totalR">Total Repuestos</label>
                                <input type="text" name="totalR" class="form-control" id="totalR" placeholder="Total Repuestos" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-4">
                                <label for="servicio">Servicio Realizado</label>
                                <input type="text" name="servicio" class="form-control" id="servicio" placeholder="Servicio Realizado" required>
                            </div>

                            <div class="col mt-4">
                                <label for="totalS">Total Servicio</label>
                                <input type="text" name="totalS" class="form-control" id="totalS" placeholder="Total Servicio" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-4">
                                <label for="fechaR">Fecha de la Reparacion</label>
                                <input type="datetime-local" name="fechaR" class="form-control" id="fechaR" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-4 w-100">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contenedor de la tabla -->
        <div class="col-auto text-center ml-3 w-75 overflow-auto">
            <div class="card" style="height: 484px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr scope="col" style="position: sticky; top: 0;">
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Modelo</th>
                            <th>Tecnico</th>
                            <th>Repuestos</th>
                            <th>Total Repuestos</th>
                            <th>Servicio Realizado</th>
                            <th>Total Servicio</th>
                            <th>Fecha Reparacion</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reparacionData as $repar): ?>
                            <tr>
                                <td><?= $repar['ID_REPARACION'] ?></td>
                                <td><?= $repar['CLIENTE'] ?></td>
                                <td><?= $repar['MODELO'] ?></td>
                                <td><?= $repar['TECNICO'] ?></td>
                                <td><?= $repar['REPUESTOS'] ?></td>
                                <td><?= $repar['TOTAL_REPUESTOS'] ?></td>
                                <td><?= $repar["SERVICIO"] ?></td>
                                <td><?= $repar["TOTAL_SERVICIO"] ?></td>
                                <td><?= $repar["FECHA_REPARACION"] ?></td>
                                <td>
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#actualizar<?= $repar['ID_REPARACION']?>">
                                        <i class="fa-solid fa-pen" style="color: #e69a0d;"></i>
                                    </button >
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#eliminar<?= $repar['ID_REPARACION']?>">
                                        <i class="fa-solid fa-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal actualizar-->
                            <div class="modal fade" id="actualizar<?=$repar['ID_REPARACION']?>"  tabindex="-1" role="dialog" aria-labelledby="editarLabel<?= $repar['ID_REPARACION'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Datos de la Reparacion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="index.php?accion=actualizaReparacion" method="post">
                                                <div class="row mt-3">
                                                    <div class="col-2">
                                                        <label for="id">Id</label>
                                                        <input type="text" name="ID_REPARACION" value="<?= $repar['ID_REPARACION'] ?>" class="form-control" id="ID_REPARACION" readonly>
                                                    </div>

                                                    <div class="col">
                                                        <label for="id">Cliente</label>
                                                        <select class="form-select" name="ID_DISPOSITIVO" id="ID_DISPOSITIVO" required>
                                                            <option value="<?= $repar['ID_DISPOSITIVO']?>"><?= $repar['CLIENTE']?> <?= $repar['MODELO']?></option>
                                                            <?php foreach($dispositivo as $dis): ?>
                                                                <?php if($dis['MODELO'] != $repar['MODELO']): ?>
                                                                    <option value="<?= $dis['ID_DISPOSITIVO'] ?>"> <?= $dis['NOMBRE_COMPLETO']?> <?=$dis['MODELO']?> <?= $dis['ID_DISPOSITIVO'] ?></option>
                                                                <?php endif?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <label for="marca">Tecnicos</label>
                                                        <select class="form-select" name="ID_TECNICO" id="ID_TECNICO" required>
                                                            <option value="<?= $repar['ID_TECNICO']?>"><?= $repar['TECNICO']?></option>
                                                            <?php foreach($tecnico as $tec): ?>
                                                                <?php if($tec['ID_TECNICO'] != $repar['ID_TECNICO']): ?>
                                                                    <option value="<?= $tec['ID_TECNICO'] ?>"> <?= $tec['NOMBRE_COMPLETO']?></option>
                                                                <?php endif?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <label for="repuestos">Repuestos</label>
                                                        <input type="text" name="repuestos" id="repuestos"  class="form-control" value="<?=$repar['REPUESTOS']?>" placeholder="Repuestos" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="totalR">Total Repuestos</label>
                                                        <input type="text" class="form-control" value="<?=$repar['TOTAL_REPUESTOS'] ?>" name="totalR" id="totalR" placeholder="Total Repuestos" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <label for="servicio">Servicio Realizado</label>
                                                        <input type="text" class="form-control" value="<?=$repar['SERVICIO']?>" name="servicio" id="servicio" placeholder="Servicio" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="totalS">Total Servicio</label>
                                                        <input type="text" class="form-control" value="<?=$repar['TOTAL_SERVICIO']?>" name="totalS" id="totalS" placeholder="Total Servicio" required>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <label for="fechaR">Fecha de la Reparacion</label>
                                                        <?php $fecha = new DateTime($repar['FECHA_REPARACION'] );
                                                            $valorInput = $fecha->format('Y-m-d\TH:i');
                                                        ?>
                                                        <input type="datetime-local" class="form-control" value="<?= $valorInput ?>" name="fechaR" id="fechaR" required>
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
                            <div class="modal" tabindex="-1" role="dialog" id="eliminar<?=$repar['ID_REPARACION']?>"  tabindex="-1" role="dialog" aria-labelledby="editarLabel<?= $repar['ID_REPARACION']?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Estas seguro que quieres eliminar esta Reparaciòn?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <strong>Cliente: </strong><?= $repar['CLIENTE'] ?> <br>
                                            <strong>Modelo del Dispositivo: </strong><?= $repar['MODELO'] ?><br>
                                            <strong>Tecnico que realizo la Reparación: </strong><?= $repar['TECNICO'] ?><br>
                                            <strong>Repuestos Utilizados: </strong><?= $repar['REPUESTOS'] ?><br>
                                            <strong>Total de los Repuestos: </strong><?= $repar['TOTAL_REPUESTOS'] ?>    <br>
                                            <strong>Servicio Realizado: </strong><?= $repar["SERVICIO"] ?><br>
                                            <strong>Total de los Servicio Realizados: </strong><?= $repar["TOTAL_SERVICIO"] ?><br>
                                            <strong>Fecha de la Reparación: </strong><?= $repar["FECHA_REPARACION"] ?><br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <a href="index.php?accion=eliminarReparacion&id=<?=$repar['ID_REPARACION']?>" type="button" class="btn btn-primary">Eliminar Cliente</a>
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

