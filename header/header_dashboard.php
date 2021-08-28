<?php 
    session_start();
    if(!isset($_SESSION['id']) || !isset($_SESSION['nombre'])){
        header("location: ../index.php");
    }else{
        //Verificar el el nombre del usuario seal el mismo, sino cambiarlo
        //Verificar que el el tipo de usuario sea el mismo,sino camiarlo

    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, maximun-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?=$ruta?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$ruta?>assets/css/style.css">

    <!-- Iconos -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    


</head>
<body>
    <div class="d-flex">
        
        <!-- Dashboard -->
        <div id="sidebar-container" class="bg-primary sidebar-wrapper">
            <div class="logo">
                <h4 class="text-light font-weight-bold" style="text-align: center;"> 
                    
                    <a href="<?=$ruta?>dash/" class="simple-text text-light">
                        New York Café 
                    </a>
                </h4>
            </div>
            <div class="menu">
                <a href="<?=$ruta?>dash/" title="" class="d-block p-3 text-light">
                    <img src="<?=$ruta?>assets/img/hogar2.png" alt=""> Inicio
                </a>

                <a href="<?=$ruta?>dash/resumen/" title="" class="d-block p-3 text-light">
                    <img src="<?=$ruta?>assets/img/reporte.png" alt=""> Resumen
                </a>

                <a href="<?=$ruta?>dash/productos/" title="" class="d-block p-3 text-light">
                    <img src="<?=$ruta?>assets/img/plato.png" alt=""> Productos
                </a>

                <a href="<?=$ruta?>dash/categoria/" title="" class="d-block p-3 text-light">
                    <img src="<?=$ruta?>assets/img/lista.png" alt="">  Categorias
                </a>

                <a href="<?=$ruta?>dash/ventas/" title="" class="d-block p-3 text-light">
                    <img src="<?=$ruta?>assets/img/monedas.png" alt="">  Ventas
                </a>

                <a href="<?=$ruta?>dash/pedidos/" title="" class="d-block p-3 text-light">
                    <img src="<?=$ruta?>assets/img/bolsa-de-la-compra.png" alt="">  Pedidos
                </a>
                

                <?php  

                if(isset($_SESSION['tipoUsuario'])){
                    //echo "Si existe";
                    if($_SESSION['tipoUsuario'] == 1){
                        //echo "El tipo de usuario es-> ".$_SESSION['tipoUsuario'];
                        ?>
                         <a href="<?=$ruta?>dash/usuarios/" title="" class="d-block p-3 text-light">
                        <img src="<?=$ruta?>assets/img/usuario (1).png" alt="">  Usuarios
                    </a>
                        <?php

                    }
                }
                    ?>
                    
                
            </div>
        </div>

        <!-- Navbar -->
        <div class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class=" container">
                    
                    <h5 class="mr-2"><?=$titulo?></h5>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?=$ruta?>assets/img/usuario.png" alt="" class="img-fluid rounded-cricle mr-2 avatar">
                                    
                                    <?php  
                                        echo $_SESSION['nombre'];
                                    ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?=$ruta?>dash/ayuda/ManualDeUsuario-NewYorkCafe.pdf" target="_blank">¿Necesitas ayuda?</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?=$ruta?>dash/cerrarSesion.php">Cerrar sesion</a>
                                </div>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>