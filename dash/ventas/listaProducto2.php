<?php 
 $menu='ventas';
 $titulo='Ventas';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  
  include ($ruta.'dao/Productos.php');
    $producto = new Productos('$id','$producto','$contenido','$precio','$id_categoria','$id_estado');
    $producto->setConexion($bd);
    

    //ID de la venta al que pertecen los productos
    $idVenta=$_POST['idVen'];

     if(isset($_GET["id"])){ //Saber si existe la variable
      $producto->setId($_GET["id"]);
      $producto->readProductoID();
    }
    
    $productos=$producto->readProducto();


    //Saber si existen unidades de un producto o no
    $estado=false;
    $cantidad=0;
    $num=$_POST['i'];

    for($i=0; $i<$num; $i++){
        $unidades=$_POST['unidades'.$i];
        if($unidades == 0){
            $cantidad++;
        }
    }
    

    //Cambia a true cuando las todos los productos tienen como unidades 0
    if($cantidad == $num){
        $estado=true;
    }

    
    include($ruta.'dao/Ventas.php');
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
                                
                                <?php
                                //Si es falso, significa que existe al menos 1 producto seleccionado
                                 if($estado ==  false) {?>
                                <div class="card-header ">
                                    <h4 class="card-title"> La venta ha sido actualizada</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Producto</th>
                                            <th>Unidades</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $num=$_POST['i'];
                                            $total = 0;

                                            //Obtener el total de la venta
                                            for($i=0; $i<$num; $i++){
                                                $unidades=$_POST['unidades'.$i];
                                                $idProducto=$_POST['idProducto'.$i];
                                                
                                                if($unidades != 0){
                                                    $producto->setId($idProducto);  
                                                    $producto->readProductoID();

                                                    $precio=$producto->getPrecio();
                                                    $subtotal=$precio * $unidades;

                                                    $total=$total+$subtotal;
                                                }
                                            }

                                            //
                                            for($i=0; $i<$num; $i++){
                                                
                                                $unidades=$_POST['unidades'.$i];
                                                $idProducto=$_POST['idProducto'.$i];
                                                
                                                if($unidades != 0){
                                                    $producto->setId($idProducto);  
                                                    $producto->readProductoID();

                                                    $precio=$producto->getPrecio();

                                                    $subtotal=$precio * $unidades;

                                                    $idP=$producto->getId();
                                                    ?>
                                                    <tr>
                                                        <td><?=$producto->getProducto()?></td>
                                                        <td><?=$unidades?></td>
                                                        <td>$ <?=$producto->getPrecio()?></td>
                                                        <td>$ <?=$subtotal?></td>
                                                    </tr>

                                                    
                                                    <?php

                                                    //Obtener el id de la venta y sobre ese mismo actualizar la tabla de ventas_productos

                                                    $ventaProduc = new Ventas_Productos($idP,$idVenta,$unidades,'');
                                                    $ventaProduc->setConexion($bd);
                                                    if($ventaProduc->updateVentaProducto()){
                                                        //echo "bien";
                                                    }else{
                                                        echo "Algo salio mal";
                                                    }


                                                //Si la unidad es igual a 0, entonces eliminar ese producto de la venta
                                                }else if($unidades == 0){

                                                    //obtener el id producto y el id de la venta

                                                    $ventaProduc = new Ventas_Productos($idProducto,$idVenta,'','');
                                                    $ventaProduc->setConexion($bd);
                                                    if($ventaProduc->deleteProductoVenta()){
                                                        //echo "bien";
                                                    }else{
                                                        echo "Algo salio mal";
                                                    }
                                                }
                                            }


                                            //Actualizar el total de la venta
                                            $venta= new Ventas($idVenta,$total,'');
                                            $venta->setConexion($bd);
                                            $venta->updateVenta();
                                            ?>
                                            <?php if($total != 0){ ?>
                                               <tr class="">
                                                    <td colspan="3" class="" align="right"><b>El total es de: </b></td>
                                                    <td class=""><b>$ <?=$total?></b></td>
                                                </tr>
                                           <?php }?>
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

                                <?php }else{ 





                                    for($i=0; $i<$num; $i++){
                                                
                                        //$unidades=$_POST['unidades'.$i];
                                        $idProducto=$_POST['idProducto'.$i];
                                        
                                        //$producto->setId($idProducto);  
                                        //$producto->readProductoID();

                                        //$precio=$producto->getPrecio();

                                        //$subtotal=$precio * $unidades;

                                        //$idP=$producto->getId();
                                        
                                        ?>
                                        <!--
                                        <tr>
                                            <td><?//=$producto->getProducto()?></td>
                                            <td><?=$unidades?></td>
                                            <td>$ <?//=$producto->getPrecio()?></td>
                                            <td>$ <?=$subtotal?></td>
                                        </tr>
                                        -->
                                                    
                                        <?php

                                                    //Obtener el id de la venta y sobre ese mismo actualizar la tabla de ventas_productos

                                        /*$ventaProduc = new Ventas_Productos($idProducto,$idVenta,'','');
                                        $ventaProduc->setConexion($bd);
                                        if($ventaProduc->updateVentaProducto()){
                                            //echo "bien";
                                        }else{
                                            echo "Algo salio mal";
                                        }*/


                                                //Si la unidad es igual a 0, entonces eliminar ese producto de la venta
                                        //}else if($unidades == 0){

                                                    //obtener el id producto y el id de la venta

                                        $ventaProduc = new Ventas_Productos($idProducto,$idVenta,'','');
                                        $ventaProduc->setConexion($bd);
                                        if($ventaProduc->deleteProductoVenta()){
                                            //echo "bien";
                                        }else{
                                            echo "Algo salio mal";
                                        }
                                        //}
                                    }

                                    $venta = new Ventas($idVenta,'','');
                                    $venta->setConexion($bd);
                                    
                                    if($venta->deleteVenta()){
                                        //echo "bien";
                                        //$x++;
                                    }else{
                                        echo "Lo siento chavo no se pudo :c";
                                    }

                                    ?>

                                    <div class="jumbotron alert-success">
                                          <h1 class="display-4">????xito!</h1>
                                          <hr class="my-4">
                                          <h4>Se ha borrado la venta</p>
                                          <a class="btn btn-primary btn-lg" href="index.php" role="button">Regresar al men?? principal</a>
                                    </div>
                                 <?php } ?>

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