<?php
    class Conexion{
        public function conectar(){
            try{
                $host = "localhost\MSSQLSERVER01";
                $port = "1431";
                $dbname = "PROYECTO";
                $user = "Brian";
                $password = "123456";

                $pdo = new PDO("sqlsrv: Server=$host;Database=$dbname",$user,$password);
                $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }catch(PDOException $e){
                die("Error de conexion " . $e->getMessage());
            }
        }
    }
?>