<?php
    require_once __DIR__ . '/../config/Conexion.php';

    class ClienteModel{
        public function IngresarCliente($cedula, $nombre, $nombreCompleto, $apellido, $telefono,$correo, $direccion, $genero, $sector, $fecha){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();
                $sql = "INSERT INTO TB_DATOSCLIENTE(CEDULA, 
                                                    NOMBRE, 
                                                    NOMBRE_COMPLETO,
                                                    APELLIDO, 
                                                    TELEFONO, 
                                                    CORREO,
                                                    DIRECCION,
                                                    ID_GENERO,
                                                    ID_SECTOR,
                                                    FECHA_INGRESO,
                                                    ACTIVO)
                                            VALUES(:CEDULA,
                                                :NOMBRE,
                                                :NOMBRE_COMPLETO,
                                                :APELLIDO,
                                                :TELEFONO,
                                                :CORREO,
                                                :DIRECCION,
                                                :ID_GENERO,
                                                :ID_SECTOR,
                                                :FECHA_INGRESO,
                                                :ACTIVO);";
                $stmt = $conexion ->prepare($sql);
                $params = [':CEDULA' => $cedula,
                        ':NOMBRE' => $nombre,
                        ':NOMBRE_COMPLETO' => $nombreCompleto,
                        ':APELLIDO' => $apellido,
                        ':TELEFONO' => $telefono,
                        ':CORREO' => $correo,
                        ':DIRECCION' => $direccion,
                        ':ID_GENERO' => $genero,
                        ':ID_SECTOR' => $sector,
                        ':FECHA_INGRESO' => $fecha,
                        ':ACTIVO' => 1];

                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function actualizarCliente($id, $cedula, $nombre, $nombreCompleto, $apellido, $telefono,$correo, $direccion, $genero, $sector, $fecha){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql ="UPDATE TB_DATOSCLIENTE SET CEDULA = :CEDULA,
                                                NOMBRE = :NOMBRE,
                                                NOMBRE_COMPLETO = :NOMBRE_COMPLETO,
                                                APELLIDO = :APELLIDO,
                                                TELEFONO = :TELEFONO,
                                                CORREO = :CORREO,
                                                DIRECCION = :DIRECCION,
                                                ID_GENERO = :ID_GENERO,
                                                ID_SECTOR = :ID_SECTOR,
                                                FECHA_INGRESO = :FECHA_INGRESO
                        WHERE ID_CLIENTE = :ID_CLIENTE";
                $stmt = $conexion->prepare($sql);
                $params = [':ID_CLIENTE' => $id,
                        ':CEDULA' => $cedula,
                        ':NOMBRE' => $nombre,
                        'NOMBRE_COMPLETO' => $nombreCompleto,
                        ':APELLIDO' => $apellido,
                        ':TELEFONO' => $telefono,
                        ':CORREO' => $correo,
                        ':DIRECCION' => $direccion,
                        ':ID_GENERO' => $genero,
                        ':ID_SECTOR' => $sector,
                        ':FECHA_INGRESO' => $fecha];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function eliminar($id){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql =  "UPDATE TB_DATOSCLIENTE  
                        SET ACTIVO = 0
                        WHERE ID_CLIENTE = :ID_CLIENTE";
                $stmt = $conexion->prepare($sql);
                $params = [':ID_CLIENTE' => $id];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerTodos(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DT.ID_CLIENTE,
                                DT.CEDULA, 
                                DT.NOMBRE,
                                DT.APELLIDO,
                                DT.NOMBRE_COMPLETO,
                                DT.TELEFONO,
                                DT.CORREO,
                                DT.DIRECCION,
                                GE.NOMBRE AS GENERO,
                                GE.ID_GENERO,
                                SC.NOMBRE AS SECTOR,
                                SC.ID_SECTOR,
                                DT.FECHA_INGRESO
                        FROM TB_DATOSCLIENTE DT, TB_GENERO GE, TB_SECTOR SC
                        WHERE DT.ACTIVO = 1
                        AND DT.ID_GENERO =  GE.ID_GENERO
                        AND DT.ID_SECTOR = SC.ID_SECTOR;";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerPorCedula($cedula){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DT.ID_CLIENTE,
                                DT.CEDULA, 
                                DT.NOMBRE,
                                DT.APELLIDO,
                                DT.NOMBRE_COMPLETO,
                                DT.TELEFONO,
                                DT.CORREO,
                                DT.DIRECCION,
                                GE.NOMBRE AS GENERO,
                                GE.ID_GENERO,
                                SC.NOMBRE AS SECTOR,
                                SC.ID_SECTOR,
                                DT.FECHA_INGRESO
                        FROM TB_DATOSCLIENTE DT, TB_GENERO GE, TB_SECTOR SC
                        WHERE CEDULA LIKE '$cedula%'
                        AND DT.ID_GENERO =  GE.ID_GENERO
                        AND DT.ID_SECTOR = SC.ID_SECTOR
                        AND DT.ACTIVO = 1;";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerCedula(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT CEDULA
                        FROM TB_DATOSCLIENTE 
                        WHERE ACTIVO = 1;";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerSector(){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql = "SELECT ID_SECTOR, NOMBRE
                        FROM TB_SECTOR
                        WHERE ACTIVO = 1";
                $stmt = $conexion->prepare($sql);
                $stmt ->execute();

                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
            

        }

        public function obtenerGenero(){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql = "SELECT ID_GENERO, NOMBRE
                        FROM TB_GENERO
                        WHERE ACTIVO = 1";
                $stmt = $conexion->prepare($sql);
                $stmt ->execute();

                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
            

        }

    }
?>