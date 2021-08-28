<?php 
 $menu='dashboard';
 $titulo='Inicio';
 $ruta="../";
  include($ruta.'header/header_dashboard.php');
?>

            <div id="content" class="py-3">
                
                <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="form-group">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="card text-info p-2" style="border:none;">
                                    <h2 align="center" id="titulo1" style="font-family: Verdana;">
                                    <i>¿Qué quieres hacer hoy?</i></h2>
                                </div>                            
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Productos</h4>
                                        <p class="card-category">Visualiza, registra, actualiza y elimina</p>
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/productos/" title=""><img src="<?=$ruta?>assets/img/comida-rapida.png" alt="" with="300" height="300"></a>
                                        <hr>
                                        <div class="stats">
                                            <i class="nc-icon nc-bulb-63"></i> Haz clic para ir a los productos
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Pedidos</h4>
                                        <p class="card-category">Visualiza, registra, actualiza y elimina</p>
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/pedidos/" title=""><img src="<?=$ruta?>assets/img/sitio-web.png" alt="" with="300" height="300"></a>
                                        <hr>
                                        <div class="stats">
                                            <i class="nc-icon nc-bulb-63"></i>  Haz clic para ir a las pedidos
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Ventas</h4>
                                        <p class="card-category">Visualiza, registra, actualiza y elimina</p>
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/ventas/" title=""><img src="<?=$ruta?>assets/img/caja-registradora.png" alt="" with="300" height="300"></a>
                                        <hr>
                                        <div class="stats ">
                                            <i class="nc-icon nc-bulb-63"></i>  Haz clic para ir a las ventas
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Categorias</h4>
                                        <p class="card-category">Visualiza, registra, actualiza y elimina</p>
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/categoria/" title=""><img src="<?=$ruta?>assets/img/categoria.png" alt="" with="300" height="300"></a>
                                        <hr>
                                        <div class="stats">
                                            <i class="nc-icon nc-bulb-63"></i> Haz clic para ir a las categorias
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php  

                            if(isset($_SESSION['tipoUsuario'])){
                                if($_SESSION['tipoUsuario'] == 1){
                                    ?>

                                     <div class="col-md-4">
                                        <div class="card ">
                                            <div class="card-header ">
                                                <h4 class="card-title">Usuarios</h4>
                                                <p class="card-category">Visualiza, registra, actualiza y elimina</p>
                                            </div>
                                            <div class="card-body ">
                                                <a href="<?=$ruta?>dash/usuarios/" title=""><img src="<?=$ruta?>assets/img/usuarios.png" alt="" with="300" height="300"></a>
                                                <hr>
                                                <div class="stats">
                                                    <i class="nc-icon nc-bulb-63"></i>  Haz clic para ir a los usuarios
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php

                                }
                            }
                    ?>
                            
                        </div>
                    </div>
                        
                    
                    </div>
                </div>
            </div>
            


    
 <?php  
  include($ruta.'footer/footer_dashboard.php');
  ?>