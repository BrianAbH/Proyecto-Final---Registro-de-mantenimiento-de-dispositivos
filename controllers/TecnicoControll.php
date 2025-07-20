<?php
    require_once __DIR__ . '/../models/TecnicoModel.php';

    class TecnicoControll{
        public function insertarTecnico(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $cedula = trim($_POST['cedula']);
                $nombre = trim($_POST['nombre']);
                $apellido = trim($_POST['apellido']);
                $telefono = trim($_POST['telefono']);
                $correo = trim($_POST['correo']);
                $especialidad = trim($_POST['especialidad']);
                $fecha = $_POST['fechaI'];
                $nombreCompleto = "$nombre $apellido";

                $tecnicoControll = new TecnicoModel();
                $tecnicoC = new TecnicoControll();
                $cedulas = $tecnicoC -> verificarCedulaTecnico($cedula);
                if($cedulas){
                    header('Location: index.php?accion=datostecnico&msg=duplicada');
                }else{
                    $filasAfectadas = $tecnicoControll->ingresarTecnico($cedula,$nombre,$apellido, $nombreCompleto,$telefono, $correo, $especialidad, $fecha);
                    if($filasAfectadas>0){
                        header('Location: index.php?accion=datostecnico&msg=guardado');
                    }else{
                        header('Location: index.php?accion=datostecnico&msg=sin_cambios');
                    }
                }
                exit;
            }
        }

        public function actualizarTecnico(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $id = trim($_POST['ID_TECNICO']);
                $cedula = trim($_POST['cedula']);
                $nombre = trim($_POST['nombre']);
                $apellido = trim($_POST['apellido']);
                $telefono = trim($_POST['telefono']);
                $correo = trim($_POST['correo']);
                $especialidad = trim($_POST['especialidad']);
                $fecha = $_POST['fechaI'];
                $nombreCompleto = "$nombre $apellido";
                
                $tecnicoControll = new TecnicoModel();
                $filasAfectadas = $tecnicoControll->actualizarTecnico(  $id,$cedula,$nombre,$apellido,$nombreCompleto, $telefono,$correo,$especialidad,$fecha);
                if($filasAfectadas>0){
                    header('Location: index.php?accion=datostecnico&msg=actualizado');
                }else{
                    header('Location: index.php?accion=datostecnico&msg=sin_cambios');
                }
                
                exit;
            }
        }

        public function eliminarTecnico($id){
            $tecnicoControll = new TecnicoModel();
                $filasAfectadas = $tecnicoControll->eliminarTecnico(  $id);
                
            if($filasAfectadas>0){
                header('Location: index.php?accion=datostecnico&msg=eliminado');
            }else{
                header('Location: index.php?accion=datostecnico&msg=sin_cambios');
            }
        }

        public function obtenerTodosTecnico(){
            $tecnicoControll = new TecnicoModel();
            return $tecnicoControll->obtenerTodosTecnicos();
        }

        public function verificarCedulaTecnico($cedula){
            $tecnicoControll = new TecnicoModel();
            $cedulas = $tecnicoControll ->obtenerCedulaTecnico();

            foreach($cedulas as $ced){
                if($cedula == $ced['CEDULA']){
                    return true;
                }
            }
            return false;
        }

        public function obtenerEspecialidad(){
            $tecnicoControll = new TecnicoModel();
            return $tecnicoControll ->obtenerEspecialidad();
        }
        
        public function obtenerPorCedulaTecnico(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $cedula = trim($_POST['obtCedula']);

               $tecnicoControll = new TecnicoModel();
                //$this ->mostrarVentana();
                return  $tecnicoControll->obtenerPorCedulaTecnico($cedula);
            }
        }

        public function mostrarVentanaTecnico(){
            require_once __DIR__ . '/../views/Tecnico/DatosTecnico.php';
        }
    }
?>