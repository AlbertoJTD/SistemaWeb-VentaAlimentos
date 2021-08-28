<?php
 $menu='resumen';
 $titulo='Resumen';
 $ruta="../../";
 include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');

  include($ruta.'dao/Productos.php');
  include($ruta.'dao/Usuarios.php');
  include($ruta.'dao/Categoria.php');
  include($ruta.'dao/Ventas.php');
  include($ruta.'dao/Pedidos.php');
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
                                    <i>Recuento de lo que se ha hecho..</i></h2>
                                </div>                            
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Productos Registrados</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/productos/" title=""><img src="<?=$ruta?>assets/img/comida-rapida.png" alt="" with="200" height="200"></a>
                                        <hr>
                                        <div class="stats">

                                            <?php 
                                            $producto= new Productos('','','','','','');
                                            $producto->setConexion($bd);
                                            $totalProductos=$producto->totalProductos();
                                             ?>

                                             <h3><?=$totalProductos?> producto(s)</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Pedidos Realizados</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/pedidos/" title=""><img src="<?=$ruta?>assets/img/sitio-web.png" alt="" with="200" height="200"></a>
                                        <hr>
                                        <div class="stats">

                                             <?php 
                                            $pedido= new Pedidos('','','','','','');
                                            $pedido->setConexion($bd);
                                            $totalpedidos=$pedido->totalPedidos();
                                             ?>

                                              <h3><?=$totalpedidos?> pedido(s)</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Ventas Realizadas</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/ventas/" title=""><img src="<?=$ruta?>assets/img/caja-registradora.png" alt="" with="200" height="200"></a>
                                        <hr>
                                        <div class="stats ">

                                             <?php 
                                            $venta= new Ventas('','','');
                                            $venta->setConexion($bd);
                                            $totalventas=$venta->totalVentas();
                                             ?>

                                              <h3><?=$totalventas?> venta(s)</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Categorías Registradas</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                        <a href="<?=$ruta?>dash/categoria/" title=""><img src="<?=$ruta?>assets/img/categoria.png" alt="" with="200" height="200"></a>
                                        <hr>
                                        <div class="stats">

                                             <?php 
                                            $categoria= new Categoria('','');
                                            $categoria->setConexion($bd);
                                            $totalcategorias=$categoria->totalCategorias();
                                             ?>

                                             <h3><?=$totalcategorias?> categoría(s)</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                     <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card ">
                                    <div class="card-header ">
                                        <h4 class="card-title">Usuarios registrados</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                        <a 
                                            <?php  
                                            if(isset($_SESSION['tipoUsuario'])){
                                                if($_SESSION['tipoUsuario'] == 1){
                                                    ?>
                                                    href="<?=$ruta?>dash/usuarios/" 
                                                    <?php
                                                }else{
                                                    ?>
                                                    href="#" 
                                                    <?php
                                                }
                                            }


                                            ?>href="<?=$ruta?>dash/usuarios/" 

                                            title=""><img src="<?=$ruta?>assets/img/usuarios.png" alt="" with="200" height="200"></a>
                                        <hr>
                                        <div class="stats">

                                             <?php 
                                            $usuario= new Usuarios('','','','','','','');
                                            $usuario->setConexion($bd);
                                            $totalusuarios=$usuario->totalUsuarios();
                                             ?>

                                             <h3><?=$totalusuarios?> usuario(s)</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                        
                    
                    </div>
                </div>
            </div>
            


    
 <?php  
  include($ruta.'footer/footer_dashboard.php');
  ?>