<?php
    require_once __DIR__ . '/../models/DispositivoModel.php';

    class DispositivoControll{
        public function insertarDispositivo(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $idCliente = trim($_POST['ID_CLIENTE']);
                $idTipo = trim($_POST['ID_TIPO']);
                $idSistema = trim($_POST['ID_SISTEMA']);
                $marca = trim($_POST['marca']);
                $modelo = trim($_POST['modelo']);
                $anio = trim($_POST['anio']);
                $fecha = $_POST['fechaI'];

                $dispositivoControll = new DispositivoModel();
                $filasAfectadas = $dispositivoControll->ingresarDispositivo($idCliente,$idTipo,$idSistema,$marca,$modelo,$anio, $fecha);
                
                if($filasAfectadas>0){
                    header('Location: index.php?accion=datosdispositivo&msg=guardado');
                }else{
                    header('Location: index.php?accion=datosdispositivo&msg=sin_cambios');
                }
                
                exit;
            }
        }

        public function actualizarDispositivo(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $id = trim($_POST['ID_DISPOSITIVO']);
                $idCliente = trim($_POST['ID_CLIENTE']);
                $idTipo = trim($_POST['ID_TIPO']);
                $idSistema = trim($_POST['ID_SISTEMA']);
                $marca = trim($_POST['marca']);
                $modelo = trim($_POST['modelo']);
                $anio = trim($_POST['anio']);
                $fecha = $_POST['fechaI'];

                $dispositivoControll = new DispositivoModel();
                $filasAfectadas = $dispositivoControll->actualizarDispositivo($id,$idCliente,$idTipo,$idSistema,$marca,$modelo,$anio, $fecha);
                if($filasAfectadas>0){
                    header('Location: index.php?accion=datosdispositivo&msg=actualizado');
                }else{
                    header('Location: index.php?accion=datosdispositivo&msg=sin_cambios');
                }
                exit;
            }
        }

        public function eliminarDispositivo($id){
            $dispositivoControll = new DispositivoModel();
            $filasAfectadas = $dispositivoControll->eliminarDispositivo(  $id);
                
            if($filasAfectadas>0){
                header('Location: index.php?accion=datosdispositivo&msg=eliminado');
            }else{
                header('Location: index.php?accion=datosdispositivo&msg=sin_cambios');
            }
        }

        public function obtenerTodosDispositivo(){
            $dispositivoControll = new DispositivoModel();
            return $dispositivoControll->obtenerTodosDispositivos();
        }


        public function obtenerClientes(){
            $dispositivoControll = new DispositivoModel();
            return $dispositivoControll ->obtenerClientes();
        }

        public function obtenerTipos(){
            $dispositivoControll = new DispositivoModel();
            return $dispositivoControll ->obtenerTipo();
        }

        public function obtenerSistema(){
            $dispositivoControll = new DispositivoModel();
            return $dispositivoControll ->obtenerSistema();
        }
        
        public function obtenerPorClienteDispositivo(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $nombre = trim($_POST['obtNombre']);

               $dispositivoControll = new DispositivoModel();
                return  $dispositivoControll->obtenerPorClienteDispositivo($nombre);
            }
        }

        public function mostrarVentanaDispositivo(){
            require_once __DIR__ . '/../views/Dispositivo/DatosDispositivo.php';
        }
    }
?>