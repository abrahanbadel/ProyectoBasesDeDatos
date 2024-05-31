<?php
$idsubcategoria = $_GET['id'];
require '../../../assets/conections/conexionbd.php';
require '../assets/controllers/catalogo/catalogo.php';
$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$controladorcatalogo = new ControladorCatalogo();
$productos = $controladorcatalogo->ConsultarProductosSubCategorias($bd,$idsubcategoria);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Album example for Bootstrap</title>

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/catalogo.css" rel="stylesheet">
</head>

<body>

    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="../index.php" class="navbar-brand d-flex align-items-center">
                    <i class="bi bi-house-fill"></i><strong>Inicio</strong>
                </a>
            </div>
        </div>
    </header>

    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php
                        while ($producto = $productos->fetch_assoc()) {
                            $controladorcatalogo = new ControladorCatalogo();
                            $imgagenesproductos = $controladorcatalogo->ConsultarimagenesProductos($bd,$producto['id']);
                            $imgagenesproducto = $imgagenesproductos->fetch_assoc();
                            echo '<div class="col-md-4">
                                        <div class="card mb-4 box-shadow">
                                            <img  class="card-img-top"
                                            style="width: 8em; height: 16em;"
                                            src="'.$imgagenesproducto['ruta'].'"
                                            alt="Card image cap">
                                            <div class="card-body">
                                            <h4>'.$producto['nombre'].'</h4>
                                            <h5><small>$'.$producto['precio'].'</small></h5>
                                            </div>
                                        </div>
                                    </div>';
                                    
                        }
                    ?>
                </div>
            </div>
        </div>

    </main>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script>
    window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/vendor/holder.min.js"></script>
</body>

</html>