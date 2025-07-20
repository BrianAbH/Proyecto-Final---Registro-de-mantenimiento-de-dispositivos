<?php
    require_once __DIR__ . '/../models/ClienteModel.php';

    class ClienteControll{
        public function insertarCliente(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $cedula = trim($_POST['cedula']);
                $nombre = trim($_POST['nombre']);
                $apellido = trim($_POST['apellido']);
                $telefono = trim($_POST['telefono']);
                $correo = trim($_POST['correo']);
                $direccion = trim($_POST['direccion']);
                $genero = trim($_POST['ID_GENERO']);
                $sector = trim($_POST['ID_SECTOR']);
                $fecha = $_POST['fechaI'];

                $nombreCompleto = "$nombre $apellido";

                $clienteControll = new ClienteModel();
                $clienteC = new clienteControll();
                $cedulas = $clienteC -> verificarCedula($cedula);
                if($cedulas){
                    header('Location: index.php?accion=datoscliente&msg=duplicada');
                }else{
                    $clienteData = $clienteControll->IngresarCliente($cedula,$nombre,$nombreCompleto,$apellido,$telefono, $correo, $direccion, $genero, $sector, $fecha);
                    if($clienteData>0){
                        header('Location: index.php?accion=datoscliente&msg=guardado');
                    }else{
                        header('Location: index.php?accion=datoscliente&msg=sin_cambios');
                    }
                }
                exit;
            }
        }

        public function actualizarCliente(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $id = $_POST['ID_CLIENTE'];
                $cedula = trim($_POST['cedula']);
                $nombre = trim($_POST['nombre']);
                $apellido = trim($_POST['apellido']);
                $telefono = trim($_POST['telefono']);
                $correo = trim($_POST['correo']);
                $direccion = trim($_POST['direccion']);
                $direccion = trim($_POST['direccion']);
                $genero = trim($_POST['ID_GENERO']);
                $sector = trim($_POST['ID_SECTOR']);
                $fecha = $_POST['fechaI'];
                $nombreCompleto = "$nombre $apellido";

                $clienteControll = new ClienteModel();
                $filasAfectadas= $clienteControll->actualizarCliente(  $id,$cedula,$nombre, $nombreCompleto, $apellido,$telefono, $correo, $direccion, $genero, $sector, $fecha);
                if($filasAfectadas>0){
                    header('Location: index.php?accion=datoscliente&msg=actualizado');
                }else{
                    header('Location: index.php?accion=datoscliente&msg=sin_cambios');
                }
                
                exit;
            }
        }

        public function eliminarCliente($id){
            $clienteControll = new ClienteModel();
            $clienteData = $clienteControll->eliminar(  $id);
                
            if($clienteData>0){
                header('Location: index.php?accion=datoscliente&msg=eliminado');
            }else{
                header('Location: index.php?accion=datoscliente&msg=sin_cambios');
            }
        }

        public function obtenerTodos(){
            $clienteControll = new ClienteModel();
            return $clienteControll->obtenerTodos();
        }

        public function obtenerPorCedulaCliente(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $cedula = trim($_POST['obtCedula']);

                $clienteControll = new ClienteModel();
                return  $clienteControll->obtenerPorCedula($cedula);
            }
        }

        public function verificarCedula($cedula){
            $clienteControll = new ClienteModel();
            $cedulas = $clienteControll ->obtenerCedula();

            foreach($cedulas as $ced){
                if($cedula == $ced['CEDULA']){
                    return true;
                }
            }
            return false;
        }

        public function mostrarVentana(){
            require_once __DIR__ . '/../views/Cliente/DatosCliente.php';
        }

        public function obtenerSector(){
            $clienteControl = new ClienteModel();
            return $clienteControl ->obtenerSector();
        }

        public function obtenerGenero(){
            $clienteControl = new ClienteModel();
            return $clienteControl ->obtenerGenero();
        }



    }
?>