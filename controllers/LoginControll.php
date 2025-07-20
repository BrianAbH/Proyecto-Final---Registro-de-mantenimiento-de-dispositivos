<?php
    require_once __DIR__ . '/../models/LoginModel.php';

    class LoginControll{
        public function autenticar(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $nombre = $_POST['nombre'];
                $contrasena = $_POST['contraseña'];


                $LoginModel = new LoginModel();
                $loginData = $LoginModel ->autenticar($nombre,$contrasena);
                if($loginData){
                    session_start();
                    $_SESSION['Usuario'] = $loginData['NOMBRE'];
                    header('Location: index.php?accion=menu');
                    }else{
                    header('Location: index.php?accion=login&msg=credencialesIncorrectas');
                }
            }else{
                $this -> mostrarFormularioLogin();
            }
        }

        public function crearUsuario(){
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $nombre = $_POST['nombre'];
                $contrasena = $_POST['contraseña'];
                $contrasenaCnf = $_POST['contraseCnf'];

                if($contrasena === $contrasenaCnf){
                    $LoginModel = new LoginModel();
                    $filasAfectadas = $LoginModel ->crearUsuario($nombre,  $contrasena);
                    if($filasAfectadas>0){
                        header('Location: index.php?accion=login');
                    }else{
                        header('Location: index.php?accion=login&msg=sin_cambios');
                    }
                }else{
                        header('Location: index.php?accion=registrar&msg=contraseña');
                }
            }else{
                $this -> mostrarFormularioRegistro();
            }
        }

        public function logout(){
            session_start();
            session_unset();
            session_destroy();
            header('Location: index.php?accion=login');
        }


        public function mostrarFormularioLogin(){
            require_once __DIR__ . '/../views/Login.php';
        }

        public function mostrarFormularioRegistro(){
            require_once __DIR__ . '/../views/Registro.php';
        }

    
    }
?>