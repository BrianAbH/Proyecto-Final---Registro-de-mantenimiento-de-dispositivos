<?php
    require_once __DIR__ . '/../config/Conexion.php';

    class DispositivoModel{
        public function ingresarDispositivo($idCliente, $idTipo, $idSistema, $marca, $modelo, $anio, $fecha){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();
                $sql = "INSERT INTO TB_DISPOSITIVO(ID_CLIENTE, ID_TIPO, ID_SISTEMA, MARCA, MODELO, ANIO, FECHA_INGRESO, ACTIVO) 
                        VALUES(:ID_CLIENTE,:ID_TIPO,:ID_SISTEMA,:MARCA,:MODELO,:ANIO,:FECHA_INGRESO,:ACTIVO);";
                $stmt = $conexion ->prepare($sql);
                $params =  [':ID_CLIENTE' => $idCliente,
                            ':ID_TIPO' => $idTipo,
                            ':ID_SISTEMA' => $idSistema,
                            ':MARCA' => $marca,
                            ':MODELO' => $modelo,
                            ':ANIO' => $anio,
                            ':FECHA_INGRESO' => $fecha,
                            ':ACTIVO' => 1];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return 'd   ';
            }
        }

        public function actualizarDispositivo($id,$idCliente,$idTipo,$idSistema,$marca,$modelo,$anio,$fecha){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql ="UPDATE TB_DISPOSITIVO SET ID_CLIENTE = :ID_CLIENTE,
                                                ID_TIPO = :ID_TIPO,
                                                ID_SISTEMA = :ID_SISTEMA,
                                                MARCA = :MARCA,
                                                MODELO = :MODELO,
                                                ANIO = :ANIO,
                                                FECHA_INGRESO = :FECHA_INGRESO
                        WHERE ID_DISPOSITIVO = :ID_DISPOSITIVO";
                $stmt = $conexion->prepare($sql);
                $params = [':ID_DISPOSITIVO' => $id,
                        ':ID_CLIENTE' => $idCliente,
                        ':ID_TIPO' => $idTipo,
                        ':ID_SISTEMA' => $idSistema,
                        ':MARCA' => $marca,
                        ':MODELO' => $modelo,
                        ':ANIO' => $anio,
                        ':FECHA_INGRESO' => $fecha];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                $s = $e -> getMessage();
                return $s;
            }
        }

        public function eliminarDispositivo($id){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql =  "UPDATE TB_DISPOSITIVO  
                        SET ACTIVO = 0
                        WHERE ID_DISPOSITIVO = :ID_DISPOSITIVO";
                $stmt = $conexion->prepare($sql);
                $params = [':ID_DISPOSITIVO' => $id];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerTodosDispositivos(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DP.ID_DISPOSITIVO, DC.ID_CLIENTE, DC.NOMBRE_COMPLETO, TD.ID_TIPO, TD.NOMBRE, TS.ID_SISTEMA, TS.NOMBRE AS SISTEMA, DP.MARCA, DP.MODELO, DP.ANIO, DP.FECHA_INGRESO
                        FROM TB_DISPOSITIVO DP, TB_DATOSCLIENTE DC, TB_TIPODISPOSITIVO TD, TB_TIPOSISTEMA TS
                        WHERE DP.ID_CLIENTE = DC.ID_CLIENTE
                        AND DP.ID_TIPO = TD.ID_TIPO
                        AND DP.ID_SISTEMA = TS.ID_SISTEMA
                        AND DP.ACTIVO = 1;";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerPorClienteDispositivo($nombre){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DP.ID_DISPOSITIVO, DC.ID_CLIENTE, DC.NOMBRE_COMPLETO, TD.ID_TIPO, TD.NOMBRE, TS.ID_SISTEMA, TS.NOMBRE AS SISTEMA, DP.MARCA, DP.MODELO, DP.ANIO, DP.FECHA_INGRESO
                        FROM TB_DISPOSITIVO DP, TB_DATOSCLIENTE DC, TB_TIPODISPOSITIVO TD, TB_TIPOSISTEMA TS
                        WHERE DC.NOMBRE_COMPLETO LIKE '$nombre%'
                        AND DP.ID_CLIENTE = DC.ID_CLIENTE
                        AND DP.ID_TIPO = TD.ID_TIPO
                        AND DP.ID_SISTEMA = TS.ID_SISTEMA
                        AND DP.ACTIVO = 1;";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerClientes(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DC.ID_CLIENTE, DC.NOMBRE_COMPLETO
                        FROM TB_DATOSCLIENTE DC
                        WHERE ACTIVO =1;";
                $stmt = $conexion -> prepare($sql);
                $stmt ->execute();
                return $stmt ->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerTipo(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT ID_TIPO, NOMBRE
                        FROM TB_TIPODISPOSITIVO 
                        WHERE ACTIVO =1;";
                $stmt = $conexion -> prepare($sql);
                $stmt ->execute();
                return $stmt ->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerSistema(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT ID_SISTEMA, NOMBRE
                        FROM TB_TIPOSISTEMA 
                        WHERE ACTIVO =1;";
                $stmt = $conexion -> prepare($sql);
                $stmt ->execute();
                return $stmt ->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }


    }
?>