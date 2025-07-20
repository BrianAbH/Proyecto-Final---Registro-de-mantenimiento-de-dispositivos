<?php
    require_once __DIR__ .'/controllers/LoginControll.php';
    require_once __DIR__ .'/controllers/ClienteControll.php';
    require_once __DIR__ .'/controllers/TecnicoControll.php';
    require_once __DIR__ .'/controllers/DispositivoControll.php';
    require_once __DIR__ .'/controllers/ReparacionControll.php';
    session_start();

    $login = new LoginControll;
    $cliente = new ClienteControll;
    $tecnico = new TecnicoControll;
    $dispositivo = new DispositivoControll;
    $reparacion = new ReparacionControll;
    
    $accion = $_GET['accion']??'default';
    // Opcional: proteger acciones que requieren sesión
    $accionesProtegidas = ['datoscliente','insertCliente','actualizarCliente','eliminarCliente','obtenerPorCedulaCliente',
                            'datostecnico','insertTecnico','actualizarTecnico','eliminarTecnico','obtenerPorCedulaTecnico',
                            'datosdispositivo','insertarDispositivo','actualizarDispositivo','eliminarDispositivo','obtenerPorCliente',
                            'datosreparacion','insertaReparacion','actualizaReparacion','eliminarReparacion','obtenerPorClienteReparacion',
                            'menu'];
    if (in_array($accion, $accionesProtegidas)) {
        if (!isset($_SESSION['Usuario'])) {
            header("Location: index.php?accion=login");
            exit;
        }
    }
    
    // Si ya hay sesión activa y va al login o inicio, redirigir al menú
    if (isset($_SESSION['Usuario']) && in_array($accion, ['login', 'inicio','default',''])) {
        header("Location: index.php?accion=menu");
        exit;
    }

            
    switch($accion){
        //Cliente
        case 'datoscliente':
            $cliente ->mostrarVentana();
            break;

        case 'insertCliente':
            $cliente ->insertarCliente();
            break;

        case 'actualizarCliente':
            $cliente ->actualizarCliente();
            break;
            
        case 'eliminarCliente':
            $cliente ->eliminarCliente($_GET['id']);
            break;

        case 'obtenerPorCedulaCliente':
            $cliente ->obtenerPorCedulaCliente();
            $cliente ->mostrarVentana();
            break;

        //Tecnico
        case 'datostecnico':
            $tecnico ->mostrarVentanaTecnico();
            break;
        
        case 'insertTecnico':
            $tecnico ->insertarTecnico();
            break;
            
        case 'actualizarTecnico':
            $tecnico ->actualizarTecnico();
            break;
            
        case 'eliminarTecnico':
            $tecnico ->eliminarTecnico($_GET['id']);
            break;

        case 'obtenerPorCedulaTecnico':
            $tecnico ->obtenerPorCedulaTecnico();
            $tecnico ->mostrarVentanaTecnico();
            break;
        
        //Dispositivo
        case 'datosdispositivo':
            $dispositivo ->mostrarVentanaDispositivo();
            break;
        
        case 'insertarDispositivo':
            $dispositivo ->insertarDispositivo();
            break;
            
        case 'actualizarDispositivo':
            $dispositivo ->actualizarDispositivo();
            break;
            
        case 'eliminarDispositivo':
            $dispositivo ->eliminarDispositivo($_GET['id']);
            break;
            
        case 'obtenerPorCliente':
            $dispositivo ->obtenerPorClienteDispositivo();
            $dispositivo ->mostrarVentanaDispositivo();
            break;

        //Reparacion
        case 'datosreparacion':
            $reparacion ->mostrarVentanaReparacion();
            break;
        
        case 'insertaReparacion':
            $reparacion ->insertarReparacion();
            break;
            
        case 'actualizaReparacion':
            $reparacion ->actualizarReparacion();
            break;
            
        case 'eliminarReparacion':
            $reparacion ->eliminarReparacion($_GET['id']);
            break;
            
        case 'obtenerPorClienteReparacion':
            $reparacion ->obtenerPorClienteReparacion();
            $reparacion ->mostrarVentanaReparacion();
            break;

        //
        case 'menu':
            require_once __DIR__ .'/views/Menu.php';
            break;
    
        case 'inicio':
            require_once __DIR__ .'/views/Inicio.php';
            break;
        
        //Login y Registro
        case 'login':
            $login ->autenticar();
            break;
        case 'logout':
            $login ->logout();
            break;
        
        case 'registrar':
            $login ->crearUsuario();
            break;

        default:
            require_once __DIR__ .'/views/Inicio.php';
            break;
    }
?>