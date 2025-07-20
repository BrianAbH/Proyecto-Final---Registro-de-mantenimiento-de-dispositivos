<?php

    require_once __DIR__ . '/../config/Conexion.php';

    class LoginModel{
        public function autenticar($nombre, $contrasena){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT NOMBRE,CONTRASENA 
                        FROM TB_USUARIOS 
                        WHERE NOMBRE= :NOMBRE
                        AND   CONTRASENA = :CONTRASENA";
                $stmt = $conexion -> prepare($sql);
                $params = ['NOMBRE' => $nombre,
                        'CONTRASENA' => $contrasena];
                $stmt -> execute($params);

                return $stmt -> fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log('A ocurrido un error');
                return false;
            }
        }

        public function crearUsuario($nombre, $contrasena){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "INSERT INTO TB_USUARIOS(NOMBRE,CONTRASENA) VALUES(:NOMBRE,:CONTRASENA)";
                $stmt = $conexion -> prepare($sql);
                $params = ['NOMBRE' => $nombre,
                        'CONTRASENA' => $contrasena];
                $stmt -> execute($params);

                return $stmt -> rowCount();
            }catch(PDOException $e){
                error_log('A ocurrido un error');
                return false;
            }
        }

        public function obtenerContrasena(){
            try{
                $conn = new Conexion();
                $conexion = $conn ->conectar();

                $sql = "SELECT CONTRASENA
                        FROM TB_USUARIOS";
                $stmt = $conexion -> prepare($sql);
                $stmt -> execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log('A ocurrido un error');
                return false;
            }
        }
    }
?>