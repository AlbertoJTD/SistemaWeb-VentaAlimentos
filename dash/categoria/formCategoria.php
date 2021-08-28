
	<?php 
	$menu="categoria";
    $titulo='Categorias';
	$ruta="../../";
    include($ruta.'config/Precarga.php');
	include ($ruta.'header/header_dashboard.php');

    include ($ruta.'dao/Categoria.php');
    $categoria = new Categoria('$id','$categoria');
    $categoria->setConexion($bd);
    

    $idCategoria="";
    if(isset($_GET["id"])){ //Saber si existe la variable
        $idCategoria=$_GET["id"];
      $categoria->setId($_GET["id"]);
      $categoria->readCategoriaID();
      //echo $categoria;
    }
    
    include ($ruta.'dao/Productos.php');
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
                            <div class="card border-dark">
                                <div class="card-header">
                                    <h3 class="card-title"><?=isset($_GET["id"])?"Editar":"Agregar"?> Categoria</h3>
                                </div>
                                <div class="card-body">
                                    <form 
                                    action="<?=isset($_GET['id'])?'editarCategoria.php':'agregarCategoria.php'?>" method="post">
                                        <div class="row">
                                            <?php if (isset($_GET['id'])){?>
                                            <div class="col-md-12 pr-1">
                                              <div class="form-group">
                                                <label>Id Categoria</label>
                                                <input type="text" name="id" class="form-control" value="<?=$categoria->getId() ?>" readonly>
                                              </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-md-12 pr-1">
                                                <div class="form-group">
                                                    <label>Categoria</label>
                                                    <input type="text" class="form-control" placeholder="categoria" required name="categoria" 
                                                        <?php if(isset($_GET["id"])){
                                                            $producto= new Productos('','','','','','');
                                                            $producto->setConexion($bd);

                                                            $producto->setId_Categoria($idCategoria);
                                                            $existe=$producto->existeCategoria();

                                                            if($existe == true){ ?>
                                                                    value="<?=$categoria->getCategoria()?>" readonly
                                                        <?php  }else{
                                                                    ?>
                                                                    value="<?=$categoria->getCategoria()?>"
                                                                    <?php
                                                                }
                                                            ?>
                                                            
                                                       <?php } ?>
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill btn-round">
                                            <?=isset($_GET["id"])?"Editar":"Agregar"?> categoria</button>
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
