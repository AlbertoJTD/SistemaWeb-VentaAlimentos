
<?php 
    session_start();
    if(!isset($_SESSION['id']) || !isset($_SESSION['nombre'])){
        header("location: ../index.php");
    }else{
        //Verificar que el nombre del usuario seal el mismo, sino cambiarlo
        //Verificar que el el tipo de usuario sea el mismo,sino cambiarlo
        
    }
?>

<?php 
 $menu='productos';
 $titulo='Productos';
 $ruta="../../";
  include($ruta.'config/Precarga.php');
  //include($ruta.'header/header_dashboard.php');
  include($ruta.'dao/Productos.php');
  
  $producto = new Productos('','','','','','');
  $producto->setConexion($bd);
  $productos=$producto->readProducto();

  include($ruta.'dao/Categoria.php');
  include($ruta.'dao/EstadoProducto.php');
  include($ruta.'dao/Ventas_Productos.php');


    //Buscar productos
  $categoriaForm=$_POST['categoria'];
  $nombre=$_POST['buscar'];

  //include($ruta.'dao/Categoria.php');
  $categoria = new Categoria('','');
  $categoria->setConexion($bd);
  
  
  if($categoriaForm != 'vacio' ){
    $categoria->setId($categoriaForm); 
    $categoria->readCategoriaID();
    $nombreCategoria=$categoria->getCategoria();
  }

  $categorias=$categoria->readCategoria();


  //Si ambas variables se mantienen en false, significa que tienen un valor
  $categoriaVacia=false;
  $nombreVacio=false;


  //No se selecciono ningun valor
  if($categoriaForm == 'vacio' && $nombre == ''){
    //echo "Ambos estan vacios<br>";
    $categoriaVacia=true;
    $nombreVacio=true;
  }

  //Solo el nombre tiene un valor
  if($categoriaForm == 'vacio' ){
    //echo "La categoria esta vacia<br>";
    $categoriaVacia=true;
  }

  //Solo se ha seleccionado una categoria
  if($nombre == ''){
    //echo "El nombre esta vacio";
    $nombreVacio=true;
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

                <a href="<?=$ruta?>dash/usuarios/" title="" class="d-block p-3 text-light">
                    <img src="<?=$ruta?>assets/img/usuario (1).png" alt="">  Usuarios
                </a>
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


                    <form action="<?=$ruta?>dash/productos/buscarProductos.php" method="post" class="form-inline my-2 my-lg-0">

                        <select name="categoria" class="form-control" >
                            <option value="vacio">Selecciona una categoría</option>
                            <?php
                            foreach ($categorias as $categoria3) {?>
                                <option value="<?=$categoria3->getId()?>"><?=$categoria3->getCategoria()?></option>
                            <?php } ?>
                        </select>

                        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="buscar" value="">

                        <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="icon ion-md-search"></i></button>
                    </form>

                   
                    
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
                                    <a class="dropdown-item" href="#">¿Necesitas ayuda?</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?=$ruta?>dash/cerrarSesion.php">Cerrar sesion</a>
                                </div>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>

                </div>
            </nav>


            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header alert-info">
                                    

                                            <?php  
                                            //No tienen valor 1
                                            if($categoriaVacia == true && $nombreVacio == true){
                                                ?>
                                                <h4 class="card-title" style="text-align: center;"> <strong>Búsqueda de productos</strong></h4>
                                                <?php

                                            //Ambas tienen un valor 2
                                            }else if($categoriaVacia == false && $nombreVacio == false){

                                                ?>
                                                <h4 class="card-title" style="text-align: center;"> <strong>Búsqueda de productos</strong></h4>
                                                <h5 class="card-title"> <strong>Categoria = </strong>  
                                                    <?=$nombreCategoria?></h5>
                                                <h5 class="card-title"> <strong>Nombre = </strong> <?=$nombre?></h5>
                                                <?php

                                            //Solo la categoria tien un valor 3
                                            }else if($categoriaVacia == false && $nombreVacio == true){

                                                ?>
                                                <h4 class="card-title" style="text-align: center;"><strong>Búsqueda de productos</strong></h4>
                                                <h5 class="card-title"> <strong>Categoria = </strong> 
                                                    <?=$nombreCategoria?></h5>
                                                <?php

                                            //Solo el nombre tiene un valor 4
                                            }else if($categoriaVacia == true && $nombreVacio == false){

                                                ?>
                                               <h4 class="card-title" style="text-align: center;"><strong>Búsqueda de productos</strong></h4>
                                                <h5 class="card-title"><strong>Nombre = </strong> <?=$nombre?></h5>
                                                <?php

                                            }
                                            ?>
                                   
                                </div>

                                <?php 
                                //No tienen valor 1
                                if($categoriaVacia == true && $nombreVacio == true){
                                    ?>

                                    <div class="jumbotron alert-warning">
                                        <h1 class="display-4">¡Oops!</h1>
                                        <hr class="my-4">
                                        <h3>Al parecer no se ha seleccionado una categoria ni tampoco se ha escrito un nombre..</h3>
                                        <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
                                    </div>


                                    <?php
                                //Ambas tienen un valor 2
                                }else if($categoriaVacia == false && $nombreVacio == false){
                                    
                                    $producto1 = new Productos('',$nombre,'','',$categoriaForm,'');
                                    $producto1->setConexion($bd);
                                    $existe=$producto1->nombreCategoriaSolicitado();
                                    if($existe == true){
                                        ?>

                                        <div class="card-body table-full-width table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>ID</th>
                                                    <th>Producto</th>
                                                    <th>Contenido</th>
                                                    <th>Precio</th>
                                                    <th>Categoria</th>
                                                    <th>Estado</th>
                                                </thead>
                                                <tbody>


                                                    <?php
                                                    $productosNC=$producto1->buscarNombreCategoria();

                                                    foreach ($productosNC as $producto) {
                                                        $idC=$producto->getId_Categoria();

                                                        $categoria->setConexion($bd);

                                                        $categoria->setId($idC);
                                                        $categoria->readCategoriaID();


                                                        //Instanciar los estados
                                                        $idE=$producto->getId_Estado();
                                                        $estado = new EstadoProducto('','');
                                                        $estado->setConexion($bd);

                                                        $estado->setId($idE);
                                                        $estado->readEstadoID();


                                                        ?>


                                                      <tr>
                                                        <td><?=$producto->getId()?></td>
                                                        <td><?=$producto->getProducto()?></td>
                                                        <td><?=$producto->getContenido()?></td>
                                                        <td>$ <?=$producto->getPrecio()?></td>
                                                        <td> <?=$categoria->getCategoria()?></td>
                                                        <td> <?=$estado->getEstado()?></td>
                                                        
                                                      </tr>
                                                <?php } ?>


                                                </tbody>
                                            </table>
                                        </div>

                                        <?php
                                    }else{
                                        ?>

                                        <div class="jumbotron alert-warning">
                                            <h1 class="display-4">¡Oops!</h1>
                                            <hr class="my-4">
                                            <h3>No se han encontrado coincidencias con la categoria <i><?=$nombreCategoria?> </i> y con el nombre <i><?=$nombre?></i></h3>
                                            <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
                                        </div>

                                        <?php
                                    }


                                //Solo la categoria tiene un valor 3
                                }else if($categoriaVacia == false && $nombreVacio == true){
                                    $producto1 = new Productos('','','','',$categoriaForm,'');
                                    $producto1->setConexion($bd);
                                    $existe=$producto1->categoriaSolicitada();
                                    if($existe == true){


                                        ?>

                                        <div class="card-body table-full-width table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>ID</th>
                                                    <th>Producto</th>
                                                    <th>Contenido</th>
                                                    <th>Precio</th>
                                                    <th>Categoria</th>
                                                    <th>Estado</th>
                                                </thead>
                                                <tbody>


                                                    <?php
                                                    $productosC=$producto1->buscarCategoria();

                                                    foreach ($productosC as $producto) {
                                                        $idC=$producto->getId_Categoria();

                                                        $categoria->setConexion($bd);

                                                        $categoria->setId($idC);
                                                        $categoria->readCategoriaID();


                                                        //Instanciar los estados
                                                        $idE=$producto->getId_Estado();
                                                        $estado = new EstadoProducto('','');
                                                        $estado->setConexion($bd);

                                                        $estado->setId($idE);
                                                        $estado->readEstadoID();


                                                        ?>


                                                      <tr>
                                                        <td><?=$producto->getId()?></td>
                                                        <td><?=$producto->getProducto()?></td>
                                                        <td><?=$producto->getContenido()?></td>
                                                        <td>$ <?=$producto->getPrecio()?></td>
                                                        <td> <?=$categoria->getCategoria()?></td>
                                                        <td> <?=$estado->getEstado()?></td>
                                                        
                                                      </tr>
                                                <?php } ?>


                                                </tbody>
                                            </table>
                                        </div>

                                        <?php


                                    }else{
                                        ?>

                                        <div class="jumbotron alert-warning">
                                            <h1 class="display-4">¡Oops!</h1>
                                            <hr class="my-4">
                                            <h3>No se han encontrado registros con la categoria <i><?=$nombreCategoria?> </i></h3>
                                            <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
                                        </div>

                                        <?php
                                    }


                                //Solo el nombre tiene un valor 4
                                }else if($categoriaVacia == true && $nombreVacio == false){
                                    $producto1 = new Productos('',$nombre,'','','','');
                                    $producto1->setConexion($bd);
                                    $existe=$producto1->nombreSolicitado();

                                    if($existe == true){
                                        ?>

                                        <div class="card-body table-full-width table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>ID</th>
                                                    <th>Producto</th>
                                                    <th>Contenido</th>
                                                    <th>Precio</th>
                                                    <th>Categoria</th>
                                                    <th>Estado</th>
                                                </thead>
                                                <tbody>


                                                    <?php
                                                    $productosN=$producto1->buscarNombre();

                                                    foreach ($productosN as $producto) {
                                                        $idC=$producto->getId_Categoria();

                                                        $categoria->setConexion($bd);

                                                        $categoria->setId($idC);
                                                        $categoria->readCategoriaID();


                                                        //Instanciar los estados
                                                        $idE=$producto->getId_Estado();
                                                        $estado = new EstadoProducto('','');
                                                        $estado->setConexion($bd);

                                                        $estado->setId($idE);
                                                        $estado->readEstadoID();


                                                        ?>


                                                      <tr>
                                                        <td><?=$producto->getId()?></td>
                                                        <td><?=$producto->getProducto()?></td>
                                                        <td><?=$producto->getContenido()?></td>
                                                        <td>$ <?=$producto->getPrecio()?></td>
                                                        <td> <?=$categoria->getCategoria()?></td>
                                                        <td> <?=$estado->getEstado()?></td>
                                                        
                                                      </tr>
                                                <?php } ?>


                                                </tbody>
                                            </table>
                                        </div>

                                        <?php


                                    }else{

                                        ?>

                                        <div class="jumbotron alert-warning">
                                            <h1 class="display-4">Oops!</h1>
                                            <hr class="my-4">
                                            <h3>No se han encontrado registros con el nombre: <i><?=$nombre?> </i></h3>
                                            <a class="btn btn-primary btn-fill btn-lg" href="<?=$ruta?>dash/productos/" role="button">Regresar al menú principal</a>
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


           
        </div>
    </div>

 <?php  
  include($ruta.'footer/footer_dashboard.php');
  ?>