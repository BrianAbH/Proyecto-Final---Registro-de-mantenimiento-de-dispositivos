<?php
    require_once __DIR__ . '/../config/Conexion.php';

    class TecnicoModel{
        public function ingresarTecnico($cedula, $nombre, $apellido, $nombreCompleto, $telefono, $correo, $especialidad, $fechaI){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();
                $sql = "INSERT INTO TB_DATOSTECNICO(CEDULA,NOMBRE,NOMBRE_COMPLETO,APELLIDO,TELEFONO,CORREO,ID_ESPECIALIDAD,FECHA_INGRESO,ACTIVO)
                        VALUES(:CEDULA,:NOMBRE,:NOMBRE_COMPLETO,:APELLIDO,:TELEFONO,:CORREO,:ESPECIALIDAD,:FECHA_INGRESO,:ACTIVO);";
                $stmt = $conexion ->prepare($sql);
                $params =  [':CEDULA' => $cedula,
                            ':NOMBRE' => $nombre,
                            ':NOMBRE_COMPLETO' => $nombreCompleto,
                            ':APELLIDO' => $apellido,
                            ':TELEFONO' => $telefono,
                            ':CORREO' => $correo,
                            ':ESPECIALIDAD' => $especialidad,
                            ':FECHA_INGRESO' => $fechaI,
                            ':ACTIVO' => 1];

                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function actualizarTecnico($id, $cedula, $nombre, $apellido, $nombreCompleto,$telefono, $correo, $especialidad, $fechaI){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql ="UPDATE TB_DATOSTECNICO SET CEDULA = :CEDULA,
                                                NOMBRE = :NOMBRE,
                                                NOMBRE_COMPLETO = :NOMBRE_COMPLETO,
                                                APELLIDO = :APELLIDO,
                                                TELEFONO = :TELEFONO,
                                                CORREO = :CORREO,
                                                ID_ESPECIALIDAD = :ESPECIALIDAD,
                                                FECHA_INGRESO = :FECHA_INGRESO
                        WHERE ID_TECNICO = :ID_TECNICO";
                $stmt = $conexion->prepare($sql);
                $params = [':ID_TECNICO' => $id,
                        ':CEDULA' => $cedula,
                        ':NOMBRE' => $nombre,
                        ':NOMBRE_COMPLETO' => $nombreCompleto,
                        ':APELLIDO' => $apellido,
                        ':TELEFONO' => $telefono,
                        ':CORREO' => $correo,
                        ':ESPECIALIDAD' => $especialidad,
                        ':FECHA_INGRESO' => $fechaI];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function eliminarTecnico($id){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql =  "UPDATE TB_DATOSTECNICO  
                        SET ACTIVO = 0
                        WHERE ID_TECNICO = :ID_TECNICO";
                $stmt = $conexion->prepare($sql);
                $params = [':ID_TECNICO' => $id];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerEspecialidad(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT ID_ESPECIALIDAD,NOMBRE
                        FROM TB_ESPECIALIDAD
                        WHERE ACTIVO =1;";
                $stmt = $conexion -> prepare($sql);
                $stmt ->execute();
                return $stmt ->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerTodosTecnicos(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DT.ID_TECNICO,
                                DT.CEDULA, 
                                DT.NOMBRE,
                                DT.APELLIDO,
                                DT.NOMBRE_COMPLETO,
                                DT.TELEFONO,
                                DT.CORREO,
                                ES.ID_ESPECIALIDAD AS ID,
                                DT.FECHA_INGRESO,
                                ES.NOMBRE as ESPECIALIDAD
                        FROM TB_DATOSTECNICO DT, TB_ESPECIALIDAD ES
                        WHERE DT.ID_ESPECIALIDAD = ES.ID_ESPECIALIDAD
                        AND DT.ACTIVO = 1;";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerPorCedulaTecnico($cedula){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DT.ID_TECNICO,
                                DT.CEDULA, 
                                DT.NOMBRE,
                                DT.APELLIDO,
                                DT.NOMBRE_COMPLETO,
                                DT.TELEFONO,
                                DT.CORREO,
                                ES.ID_ESPECIALIDAD AS ID,
                                DT.FECHA_INGRESO,
                                ES.NOMBRE AS ESPECIALIDAD
                        FROM TB_DATOSTECNICO DT, TB_ESPECIALIDAD ES
                        WHERE DT.CEDULA LIKE '$cedula%'
                        AND DT.ID_ESPECIALIDAD = ES.ID_ESPECIALIDAD
                        AND DT.ACTIVO = 1;";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerCedulaTecnico(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT CEDULA
                        FROM TB_DATOSTECNICO 
                        WHERE ACTIVO = 1;";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }
    }
?>