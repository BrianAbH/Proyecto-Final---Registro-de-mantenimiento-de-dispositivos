<?php
    require_once __DIR__ . '/../config/Conexion.php';

    class ReparacionModel{
        public function ingresarReparacion($idDispositivo,$idTecnico,$repuestos,$totalR,$servicio,$totalS,$fechaR){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();
                $sql = "INSERT INTO TB_REPARACION(ID_DISPOSITIVO,ID_TECNICO,REPUESTOS,TOTAL_REPUESTOS,SERVICIO,TOTAL_SERVICIO,FECHA_REPARACION,ACTIVO) 
                        VALUES( :ID_DISPOSITIVO, :ID_TECNICO, :REPUESTOS, :TOTAL_REPUESTOS, :SERVICIO, :TOTAL_SERVICIO, :FECHA_REPARACION, :ACTIVO);";
                $stmt = $conexion ->prepare($sql);
                $params =  [':ID_DISPOSITIVO' => $idDispositivo,
                            ':ID_TECNICO' => $idTecnico,
                            ':REPUESTOS' => $repuestos,
                            ':TOTAL_REPUESTOS' => $totalR,
                            ':SERVICIO' => $servicio,
                            ':TOTAL_SERVICIO' => $totalS,
                            ':FECHA_REPARACION' => $fechaR,
                            ':ACTIVO' => 1];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function actualizarReparacion($id,$idDispositivo,$idTecnico,$repuestos,$totalR,$servicio,$totalS,$fechaR){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql ="UPDATE TB_REPARACION SET ID_DISPOSITIVO = :ID_DISPOSITIVO,
                                                ID_TECNICO = :ID_TECNICO,
                                                REPUESTOS = :REPUESTOS,
                                                TOTAL_REPUESTOS = :TOTAL_REPUESTOS,
                                                SERVICIO = :SERVICIO,
                                                TOTAL_SERVICIO = :TOTAL_SERVICIO,
                                                FECHA_REPARACION = :FECHA_REPARACION
                        WHERE ID_REPARACION = :ID_REPARACION";
                $stmt = $conexion->prepare($sql);
                $params = [':ID_DISPOSITIVO' => $idDispositivo,
                        ':ID_TECNICO' => $idTecnico,
                        ':REPUESTOS' => $repuestos,
                        ':TOTAL_REPUESTOS' => $totalR,
                        ':SERVICIO' => $servicio,
                        ':TOTAL_SERVICIO' => $totalS,
                        ':FECHA_REPARACION' => $fechaR,
                        ':ID_REPARACION' => $id];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                $s = $e ->getMessage();
                return  $s;
            }
        }

        public function eliminarReparacion($id){
            try{
                $conn = new Conexion();
                $conexion = $conn->conectar();

                $sql =  "UPDATE TB_REPARACION  
                        SET ACTIVO = 0
                        WHERE ID_REPARACION = :ID_REPARACION";
                $stmt = $conexion->prepare($sql);
                $params = [':ID_REPARACION' => $id];
                $stmt ->execute($params);
                return $stmt ->rowCount();
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerTodasReparacions(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT RP.ID_REPARACION, DC.ID_CLIENTE, DC.NOMBRE_COMPLETO AS CLIENTE, DP.ID_DISPOSITIVO, DP.MODELO, DT.ID_TECNICO, DT.NOMBRE_COMPLETO AS TECNICO, RP.REPUESTOS, RP.TOTAL_REPUESTOS, RP.SERVICIO, RP.TOTAL_SERVICIO, RP.FECHA_REPARACION
                        FROM TB_REPARACION RP, TB_DISPOSITIVO DP, TB_DATOSCLIENTE DC, TB_DATOSTECNICO DT
                        WHERE RP.ID_DISPOSITIVO = DP.ID_DISPOSITIVO 
                        AND RP.ID_TECNICO = DT.ID_TECNICO
                        AND DP.ID_CLIENTE = DC.ID_CLIENTE
                        AND RP.ACTIVO = 1";
                $stmt = $conexion ->prepare($sql);
                $stmt ->execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerDispositivo(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DP.ID_DISPOSITIVO, DC.ID_CLIENTE, DC.NOMBRE_COMPLETO, DP.MODELO
                        FROM TB_DISPOSITIVO DP, TB_DATOSCLIENTE DC
                        WHERE DP.ID_CLIENTE = DC.ID_CLIENTE
                        AND DP.ACTIVO =1;";
                $stmt = $conexion -> prepare($sql);
                $stmt ->execute();
                return $stmt ->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerTecnico(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT DT.ID_TECNICO, DT.NOMBRE_COMPLETO
                        FROM TB_DATOSTECNICO DT
                        WHERE DT.ACTIVO =1;";
                $stmt = $conexion -> prepare($sql);
                $stmt ->execute();
                return $stmt ->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("A ocurrido un error" . $e ->getMessage());
                return false;
            }
        }

        public function obtenerPorClienteReparacion($nombre){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT RP.ID_REPARACION, DC.NOMBRE_COMPLETO AS CLIENTE, DP.MODELO, DT.NOMBRE_COMPLETO AS TECNICO, RP.REPUESTOS, RP.TOTAL_REPUESTOS, RP.SERVICIO, RP.TOTAL_SERVICIO, RP.FECHA_REPARACION
                        FROM TB_REPARACION RP, TB_DISPOSITIVO DP, TB_DATOSCLIENTE DC, TB_DATOSTECNICO DT
                        WHERE RP.ID_DISPOSITIVO = DP.ID_DISPOSITIVO
                        AND DC.NOMBRE_COMPLETO LIKE '$nombre%'
                        AND RP.ID_TECNICO = DT.ID_TECNICO
                        AND DP.ID_CLIENTE = DC.ID_CLIENTE
                        AND RP.ACTIVO = 1;";
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
