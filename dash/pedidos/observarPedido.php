<?php 
  $menu='pedidos';
 $titulo='Pedidos';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Pedidos.php');
  $pedido = new Pedidos('','','','','','');
  $pedido->setConexion($bd);

    if(isset($_GET["idV"])){ //Saber si existe la variable
        $pedido->setId($_GET["idV"]);
        $pedido->readPedidoID();
        $total=$pedido->getMontoFinal();
        $fecha=$pedido->getFecha();
        $nombre=$pedido->getNombreCliente();
        $tel=$pedido->getTelefono();
        $estadoPedido=$pedido->getId_estado();
    }
                                    
  $pedidos=$pedido->readPedidos();

  include($ruta.'dao/Productos.php');
  include($ruta.'dao/EstadoPedido.php');
  include($ruta.'dao/Pedidos_Productos.php');

  $estado = new EstadoPedido('','');
  $estado->setConexion($bd);
  if(isset($_GET["idV"])){
    $estado->setId($estadoPedido);
    $estado->readEstadoID();
    $nomEstado=$estado->getEstado();
  }
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
                                    <h3 class="card-title " style="text-align: center;"><strong>Detalles del pedido</strong> </h3>
                                    <h4> <strong>ID: </strong>   <?=$_GET['idV']?> </h4>
                                    <h4> <strong>Cliente: </strong>  <?=$nombre?></h4>  
                                    <h4><strong>Tel??fono: </strong>  <?=$tel?> </h4>
                                    <h4><strong>Estado del pedido: </strong>  <?=$nomEstado?> </h4>
                                    <h4> <strong>Total de la venta: </strong>  $ <?=$total?> </h4> 
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
                                          
                                        $pedidoProduc = new Pedidos_Productos('','','','');
                                        $pedidoProduc->setConexion($bd);
                                        $pedidoProduc->setId_pedido($_GET['idV']);
                                        $pedidoPro=$pedidoProduc->readPedidoProductoID();

                                        foreach($pedidoPro as $pedidoP) {
                                            
                                            $idP=$pedidoP->getId_producto();
                                            $unidades=$pedidoP->getUnidades();
                                            $precio=$pedidoP->getPrecio();

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

                                    <div class="col-md-5">
                                                <br>
                                                <h3>Dinero recibido: </h3>
                                                <form action="cambio.php" method="post" accept-charset="utf-8">
                                                    <input type="number" name="pago" min="<?=$total?>" value="" class="form-control" placeholder="$ Dinero" required>
                                                    <br>

                                                
                                                    <input type="hidden" name="total" value="<?=$total?>">
                                                    <button type="submit" name="" class="btn btn-primary btn-fill btn-round"> Finalizar venta</button>
                                                </form>
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