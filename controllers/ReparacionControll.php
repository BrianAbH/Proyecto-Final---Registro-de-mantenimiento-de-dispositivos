<?php
    require_once __DIR__ . '/../models/ReparacionModel.php';

    class ReparacionControll{

        public function insertarReparacion(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $idDispositivo = trim($_POST['ID_DISPOSITIVO']);
                $idTecnico = trim($_POST['ID_TECNICO']);
                $repuestos = trim($_POST['repuestos']);
                $totalR = trim($_POST['totalR']);
                $servicio = trim($_POST['servicio']);
                $totalS = trim($_POST['totalS']);
                $fechaR = trim($_POST['fechaR']);
                
                $reparacionControll = new ReparacionModel();
                $filasAfectadas = $reparacionControll->ingresarReparacion($idDispositivo, $idTecnico, $repuestos, $totalR, $servicio, $totalS, $fechaR);
                
                if($filasAfectadas>0){
                    header('Location: index.php?accion=datosreparacion&msg=guardado');
                }else{
                    echo ($fechaR);
                }
                
                exit;
            }
        }

        public function actualizarReparacion(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $id = trim($_POST['ID_REPARACION']);
                $idDispositivo = trim($_POST['ID_DISPOSITIVO']);
                $idTecnico = trim($_POST['ID_TECNICO']);
                $repuestos = trim($_POST['repuestos']);
                $totalR = trim($_POST['totalR']);
                $servicio = trim($_POST['servicio']);
                $totalS = trim($_POST['totalS']);
                $fechaR = trim($_POST['fechaR']);
                
                $reparacionControll = new ReparacionModel();
                $filasAfectadas = $reparacionControll->actualizarReparacion($id,$idDispositivo, $idTecnico, $repuestos, $totalR, $servicio, $totalS, $fechaR);
                if($filasAfectadas>0){
                    header('Location: index.php?accion=datosreparacion&msg=actualizado');
                }else{
                    header('Location: index.php?accion=datosreparacion&msg=sin_cambios');
                }
                exit;
            }
        }

        public function eliminarReparacion($id){
           $reparacionControll = new ReparacionModel();
                $filasAfectadas = $reparacionControll->eliminarReparacion(  $id);
                
            if($filasAfectadas>0){
                header('Location: index.php?accion=datosreparacion&msg=eliminado');
            }else{
                header('Location: index.php?accion=datosreparacion&msg=sin_cambios');
            }
        }

        public function obtenerTodasReparacions(){
            $reparacionControll = new ReparacionModel();
            return $reparacionControll ->obtenerTodasReparacions();
        }


        public function obtenerDispositivo(){
            $reparacionControll = new ReparacionModel();
            return $reparacionControll ->obtenerDispositivo();
        }

        public function obtenerTecnico(){
            $reparacionControll = new ReparacionModel();
            return $reparacionControll ->obtenerTecnico();
        }
        
        public function obtenerPorClienteReparacion(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $nombre = trim($_POST['obtNombre']);

                $reparacionControll = new ReparacionModel();
                return  $reparacionControll->obtenerPorClienteReparacion($nombre);
            }
        }

        public function mostrarVentanaReparacion(){
            require_once __DIR__ .'/../views/Reparacion/DatosReparacion.php';
        }

    }
?>