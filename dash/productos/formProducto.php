
	<?php 
	$menu="productos";
    $titulo='Productos';
	$ruta="../../";
    include($ruta.'config/Precarga.php');
	include ($ruta.'header/header_dashboard.php');

    include ($ruta.'dao/Productos.php');
    $producto = new Productos('$id','$producto','$contenido','$precio','$id_categoria','$id_estado');
    $producto->setConexion($bd);
    
     if(isset($_GET["id"])){ //Saber si existe la variable
      $producto->setId($_GET["id"]);
      $producto->readProductoID();
      $busca1=$producto->getId_Categoria();
      $busca2=$producto->getId_Estado();
      //echo $producto;
    }
    
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


    //________________________EstadoProducto
    include($ruta.'dao/EstadoProducto.php');
    $estado = new EstadoProducto('$id','$estado');
    $estado->setConexion($bd);

    if(isset($_GET["id"])){ //Saber si existe la variable
      $estado->setId($busca2);
      $estado->readEstadoID();
    }
    
    $estados=$estado->readEstado();


    include($ruta.'dao/Ventas_Productos.php');
    include($ruta.'dao/Pedidos_Productos.php');
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
                            <div class="card border-dark">
                                <div class="card-header">
                                    <h3 class="card-title"><?=isset($_GET["id"])?"Editar":"Agregar"?> Producto</h3>
                                </div>
                                <div class="card-body">
                                    <form 
                                    action="<?=isset($_GET['id'])?'editarProducto.php':'agregarProducto.php'?>" method="post">
                                        <div class="row">

                                            <?php if (isset($_GET['id'])){?>
                                            <div class="col-md-12 pr-1">
                                              <div class="form-group">
                                                <label>Id Producto</label>
                                                <input type="text" name="id" class="form-control" value="<?=$producto->getId() ?>" readonly>
                                              </div>
                                            </div>
                                            <?php } ?>

                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Nombre del producto</label>
                                                    <input type="text" class="form-control" placeholder="Nombre" required name="nombre" 
                                                    <?php if(isset($_GET["id"])){
                                                                
                                                                //Instanciar los venta_productos
                                                                $idProduc=$producto->getId();
                                                                $ventaProduc = new Ventas_Productos('','','','');
                                                                $ventaProduc->setConexion($bd);

                                                                $ventaProduc->setId_producto($idProduc);
                                                                $existe=$ventaProduc->existeProducto();


                                                                 //Instanciar los pedidos_productos
                                                
                                                                $pedidoProduc2 = new Pedidos_Productos('','','','');
                                                                $pedidoProduc2->setConexion($bd);

                                                                $pedidoProduc2->setId_producto($idProduc);
                                                                $existe2=$pedidoProduc2->existeProducto();
                                                                
                                                                if($existe == true && $existe2 ==true){?>
                                                                    value="<?=$producto->getProducto()?>" readonly
                                                        <?php  }else{
                                                                    ?>
                                                                    value="<?=$producto->getProducto()?>"
                                                                    <?php
                                                                }
                                                            ?>
                                                            
                                                       <?php }?>
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6 px-1">
                                                <div class="form-group">
                                                    <label>Contenido</label>
                                                    <input type="text" class="form-control" placeholder="Contenido del producto" min="0" name="cont" 
                                                        <?php if(isset($_GET["id"])){?>
                                                                value="<?=$producto->getContenido()?>"
                                                           <?php } ?>
                                                    >
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Precio del producto</label>
                                                    <input type="number" class="form-control" placeholder="Precio" required="" min="0" name="precio" 
                                                        <?php if(isset($_GET["id"])){?>
                                                                value="<?=$producto->getPrecio()?>"
                                                           <?php } ?>
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Categoria</label>
                                                    <select name="id_categoria" class="form-control" required="">
                                                    <?php if(isset($_GET["id"])){?>
                                                            <option value="<?=$producto->getId_Categoria()?>">
                                                                <?php $categ= $categoria->getCategoria()?>
                                                                <?=$categoria->getCategoria()?> 
                                                            </option>
                                                    <?php }else{?>
                                                            <option value=""> Selecciona una categoria</option>
                                                                <?php } ?>
                                                        
                                                        <?php 
                                                        foreach ($categorias as $categoria){
                                                            if(isset($_GET["id"])){ ?>
                                                                <?php if($categ != $categoria->getCategoria()){ ?>
                                                                    <option value="<?=$categoria->getId()?>">
                                                                        <?=$categoria->getCategoria()?> 
                                                                    </option>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                
                                                                <option value="<?=$categoria->getId()?>">
                                                                    <?=$categoria->getCategoria()?> 
                                                                </option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Estado del producto</label>
                                                    <select name="id_estado" class="form-control" required="">
                                                    <?php if(isset($_GET["id"])){?>
                                                            <option value="<?=$producto->getId_Estado()?>">
                                                                <?php $esta= $estado->getEstado()?>
                                                                <?=$estado->getEstado()?> 
                                                            </option>
                                                    <?php }else{?>
                                                            <option value=""> Selecciona un estado</option>
                                                    <?php } ?>
                                                        
                                                         
                                                    <?php 
                                                        foreach ($estados as $estado){
                                                            if(isset($_GET["id"])){ ?>
                                                                <?php if($esta != $estado->getEstado()){ ?>
                                                                    <option value="<?=$estado->getId()?>">
                                                                        <?=$estado->getEstado()?> 
                                                                    </option>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                
                                                                <option value="<?=$estado->getId()?>">
                                                                    <?=$estado->getEstado()?> 
                                                                </option>
                                                            <?php } ?>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill btn-round"><?=isset($_GET["id"])?"Editar":"Agregar"?> producto</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php 
include($ruta.'footer/footer_dashboard.php');
 ?>
