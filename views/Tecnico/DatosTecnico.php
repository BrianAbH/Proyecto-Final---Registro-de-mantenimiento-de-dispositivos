<?php 
    include __DIR__ . '/../layout/header.php';
    require_once __DIR__ . '/../../controllers/TecnicoControll.php';
    $tecnicos = new TecnicoControll();
    $accion = $_GET['accion'];
    if($accion =='obtenerPorCedulaTecnico'){
        $tecnicoData = $tecnicos->obtenerPorCedulaTecnico();
    }else{
        $tecnicoData = $tecnicos->obtenerTodosTecnico();
    }

    $especialidad =  $tecnicos->obtenerEspecialidad();
?>
    <!--Busqueda -->
    <div class="card m-3">
        <div class="card-header bg-dark text-white">
            <a href="index.php?accion=menu" class="navbar-brand" style="color:white;" class="ms-3"><img src="/../assets/icons/back.svg" alt="">Volver al menú</a>
            <i class="bi bi-arrow-return-left"></i>
            <img src="/../assets/icons/tecnico.svg" class="me-2" style="margin-left:780px;" alt="">Tecnicos   
        </div>
        <div class="card-body mx-auto">
            <form class="row row-col-3" action="index.php?accion=obtenerPorCedulaTecnico" method="post">
                <input class="form-control" style="width: 200px;" name="obtCedula" type="text" placeholder="Buscar por Cedula" aria-label="Search">
                <button class="btn btn-info ms-3" style="width: 80px;" type="submit">Buscar</button>
                <div style="width: 10px">
                    <a href="index.php?accion=datostecnico" >
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
                    <img src="/../assets/icons/tecnico.svg" class="me-2" alt="">Informacion del Tecnico
                </div>
                <div class="p-3 mt-3">
                    <!-- Mensaje de error -->
                    <?php
                        $mensajes = ['actualizado' => ['Tecnico Actualizado Correctamente.', 'primary'],
                                    'guardado' => ['Tecnico Guardado Correctamente.', 'success'],
                                    'eliminado' => ['Tecnico Eliminado Correctamente.', 'danger'],
                                    'sin_cambios' => ['No se realizaron cambios.', 'secondary'],
                                    'duplicada' => ['Ya existe un Tecnico con ese Cédula.', 'warning'],
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
                    <form action="index.php?accion=insertTecnico" method="post">
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
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required>
                            </div>

                            <div class="col mt-4">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" required>
                            </div>
                        </div>

                        <div class="mt-4">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" name="correo" id="correo" placeholder="brian@gmail.com" required>
                        </div>

                        <div class="form-group mt-4">
                            <label for="especialidad">Especialidad</label>
                            <select class="form-select" name="especialidad" id="especialidad" required>
                                <option value="">--Seleccione una opcion</option>
                                <?php foreach($especialidad as $esp): ?>
                                    <option value="<?= $esp['ID_ESPECIALIDAD']?>"> <?= $esp['NOMBRE']?> </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="mt-4">
                                <label for="fechaI">Fecha de Registro</label>
                                <input type="date" class="form-control" name="fechaI" id="fechaI" placeholder="brian@gmail.com" required>
                        </div>

                        <button type="submit" class="btn btn-success mt-3 w-100">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contenedor de la tabla -->
        <div class="col-auto text-center ml-3 w-75 overflow-auto">
            <div class="card" style="height: 553px; overflow-y: auto;">
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
                            <th scope="col" style="position: sticky; top: 0;">especialidad</th>
                            <th scope="col" style="position: sticky; top: 0;">Fecha de Registro</th>
                            <th scope="col" style="position: sticky; top: 0;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tecnicoData as $tecnico): ?>
                            <tr>
                                <td><?= $tecnico['ID_TECNICO'] ?></td>
                                <td><?= $tecnico['CEDULA'] ?></td>
                                <td><?= $tecnico['NOMBRE'] ?></td>
                                <td><?= $tecnico['APELLIDO'] ?></td>
                                <td><?= $tecnico['NOMBRE_COMPLETO'] ?></td>
                                <td><?= $tecnico['TELEFONO'] ?></td>
                                <td><?= $tecnico['CORREO'] ?></td>
                                <td><?= $tecnico['ESPECIALIDAD'] ?></td>
                                <td><?= $tecnico['FECHA_INGRESO'] ?></td>
                                <td>
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#actualizar<?= $tecnico['ID_TECNICO']?>">
                                        <i class="fa-solid fa-pen" style="color: #e69a0d;"></i>
                                    </button >
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#eliminar<?= $tecnico['ID_TECNICO'] ?>">
                                        <i class="fa-solid fa-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal actualizar-->
                            <div class="modal fade" id="actualizar<?= $tecnico['ID_TECNICO']?>"  tabindex="-1" role="dialog" aria-labelledby="editarLabel<?= $tecnico['ID_TECNICO']?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Datos del Técnico</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="index.php?accion=actualizarTecnico" method="post">
                                                <div class="row mt-3">
                                                    <div class="col">
                                                        <label for="id">Id</label>
                                                        <input type="text" name="ID_TECNICO" value="<?= $tecnico['ID_TECNICO']?>" class="form-control" id="ID_CLIENTE" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="cedula">Cedula</label>
                                                        <input type="text" name="cedula" value="<?= $tecnico['CEDULA']?>" class="form-control" id="cedula" placeholder="Cedula">
                                                    </div>
                                                    <div class="col">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" name="nombre" class="form-control" value="<?= $tecnico['NOMBRE']?>"  id="nombre" placeholder="Nombre">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <label for="apellido">Apellidos</label>
                                                        <input type="text" name="apellido" value="<?= $tecnico['APELLIDO']?> " class="form-control" id="apellido" placeholder="Apellido">
                                                    </div>
                                                    <div class="col">
                                                        <label for="telefono">Telefono</label>
                                                        <input type="text" name="telefono" class="form-control" value="<?= $tecnico['TELEFONO']?>"  id="telefono" placeholder="Telefono">
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                        <label for="correo">Correo</label>
                                                        <input type="email" name="correo" class="form-control" value="<?= $tecnico['CORREO']?>"  id="correo" placeholder="brian@gmail.com">
                                                </div>

                                                <div class="mt-4">
                                                    <label for="especialidad">Especialidad</label>
                                                    <select class="form-select" name="especialidad" id="especialidad" required>
                                                        <option value="<?= $tecnico['ID']?>"><?= $tecnico['ESPECIALIDAD']?></option>
                                                        <?php foreach($especialidad as $esp): ?>
                                                            <?php if($esp['ID_ESPECIALIDAD'] != $tecnico['ID']):?>
                                                                <option value="<?= $esp['ID_ESPECIALIDAD']?>"> <?= $esp['NOMBRE']?> </option>
                                                            <?php endif?>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                        <label for="fechaI">Fecha de Registro</label>
                                                        <input type="date" name="fechaI" class="form-control" value="<?= $tecnico['FECHA_INGRESO']?>"  id="fechaI">
                                                </div>

                                                <div class="modal-footer mt-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Actualizar Técnico</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Eliminar-->
                            <div class="modal" tabindex="-1" role="dialog" id="eliminar<?= $tecnico['ID_TECNICO']  ?>"  tabindex="-1" role="dialog" aria-labelledby="editarLabel<?= $tecnico['ID_TECNICO'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Estas seguro que quieres eliminar este Técnico?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <div class="modal-body text-start">
                                            <strong>Cédula: </strong><?= $tecnico['CEDULA'] ?> <br>
                                            <strong>Nombre: </strong><?= $tecnico['NOMBRE'] ?><br>
                                            <strong>Apellido: </strong><?= $tecnico['APELLIDO'] ?><br>
                                            <strong>Teléfono: </strong><?= $tecnico['TELEFONO'] ?><br>
                                            <strong>Correo: </strong><?= $tecnico['CORREO'] ?><br>
                                            <strong>Especialidad: </strong><?= $tecnico['ESPECIALIDAD'] ?><br>
                                            <strong>Fecha de Registro: </strong><?= $tecnico['FECHA_INGRESO'] ?><br>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <a href="index.php?accion=eliminarTecnico&id=<?= $tecnico['ID_TECNICO'] ?>" type="button" class="btn btn-primary">Eliminar Técnico</a>
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
