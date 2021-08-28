<?php 
 $menu='ventas';
 $titulo='Ventas';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Ventas.php');
  $venta = new Ventas('','','','','');
  $venta->setConexion($bd);

    if(isset($_GET["idV"])){ //Saber si existe la variable
        $venta->setId($_GET["idV"]);
        $venta->readVentaID();
        $total=$venta->getTotal();
        $fecha=$venta->getFecha();
    }
                                    
  $ventas=$venta->readVenta();

  include($ruta.'dao/Productos.php');
  include($ruta.'dao/Ventas_Productos.php');


?>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        
                    </div>

                </div>
            </nav>


            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                


                                <div class="card-header alert-info">
                                    <h3 class="card-title " style="text-align: center;"><strong>Detalles de venta</strong> </h3>
                                    <h4> <strong>ID: </strong>   <?=$_GET['idV']?> </h4>
                                    <h4> <strong>Total de la venta: </strong>  $ <?=$total?></h4>
                                    <h4><strong>Fecha y hora: </strong>  <?=$fecha?> </h4>
                                </div>


                                <div class="card-body table-full-width table-responsive">
                                    
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Unidades</th>
                                            <th>Productos</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                        </thead>
                                        <tbody>
                                        <?php 
                                          
                                        $ventaProduc = new Ventas_Productos('','','','');
                                        $ventaProduc->setConexion($bd);
                                        $ventaProduc->setId_venta($_GET['idV']);
                                        $ventaPro=$ventaProduc->readVentaProductoID();

                                        foreach($ventaPro as $ventaP) {
                                            
                                            $idP=$ventaP->getId_producto();
                                            $unidades=$ventaP->getUnidades();
                                            $precio=$ventaP->getPrecio();
                                            
                                            $producto = new Productos('','','','','','');
                                            $producto->setConexion($bd);
                                            $producto->setId($idP);
                                            $producto->readProductoID();

                                            $nombre=$producto->getProducto();
                                            //$precio=$producto->getPrecio();

                                            $subtotal= $precio * $unidades;
                                            
                                            ?>
                                            <tr>
                                                <td><?=$unidades?></td>
                                                <td><?=$nombre?></td>
                                                <td>$ <?=$precio?></td>
                                                <td>$ <?=$subtotal?></td>
                                              </tr>
                                            
                                            <?php
                                            
                                        }
                                        ?>
                                        

                                        </tbody>
                                    </table>
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