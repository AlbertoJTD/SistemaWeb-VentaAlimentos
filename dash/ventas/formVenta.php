<?php 
 $menu='ventas';
 $titulo='Ventas';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Productos.php');
  $producto = new Productos('','','','','','');
  $producto->setConexion($bd);
  $productos=$producto->readProducto();


  //________________________Categoria
    include($ruta.'dao/Categoria.php');
    $categoria = new Categoria('$id','$categoria');
    $categoria->setConexion($bd);

    if(isset($_GET["id"])){ //Saber si existe la variable
      $categoria->setId($busca1);
      $categoria->readCategoriaID();
    }
    
    $categorias=$categoria->readCategoria();
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
                                <div class="card-header ">
                                    <h3 class="card-title"><?=isset($_GET["id"])?"Editar":"Registrar"?> venta</h3>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Contenido</th>
                                            <th>Precio</th>
                                            <th>Categoria</th>
                                            <th>Unidades</th>
                                        </thead>
                                        <tbody>


                                            <?php
                                            $i=0;

                                            $palabra='unidades';
                                            $palabra2='idProducto';

                                            foreach ($productos as $producto) {

                                                $idC=$producto->getId_Categoria();

                                                //Instanciar las categorias
                                                //$categoria = new Categoria('','');
                                                $categoria->setConexion($bd);

                                                $categoria->setId($idC);
                                                $categoria->readCategoriaID();

                                                ?>
                                              <tr>
                                                <td><?=$producto->getId()?></td>
                                                <td><?=$producto->getProducto()?></td>
                                                <td><?=$producto->getContenido()?></td>
                                                <td>$ <?=$producto->getPrecio()?></td>
                                                <td>  <?=$categoria->getCategoria()?></td>
                                                <form action="listaProducto.php" method="POST">
                                                    <td>
                                                        <input class="form-control" type="number" min="0" value="0" 
                                                        name="<?=$palabra.$i?>"> 
                                                    
                                                        <input type="hidden" name="<?=$palabra2.$i?>" 
                                                            value="<?=$producto->getId()?>">
                                                    </td>
                                              </tr>
                                                
                                                
                                            <?php 

                                                $i++;
                                            } ?>


                                        </tbody>
                                    </table>
                                        <input type="hidden" name="i" value="<?=$i?>">
                                        <button type="submit" class="btn btn-primary btn-fill btn-round "> Visualizar venta</button>

                                    </form>

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