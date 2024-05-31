<?php
require '../../assets/conections/conexionbd.php';
require 'assets/controllers/index/index.php';

$conexion = new ConexionBD();
$bd = $conexion->getConexion();
$controladorindex = new ControladorIndex();
$secciones = $controladorindex->ConsultarSecciones($bd);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inner Page - Gp Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
          .a{
                text-decoration: none;
                color: black;
                font-weight: bolder;
                font-size:1.1em;
            }
    </style>

    <!-- Template Main CSS File -->

    <!-- =======================================================
  * Template Name: Gp
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


</head>

<body>

    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="../../index.html" class="navbar-brand d-flex align-items-center">
                <i class="bi bi-house-fill"></i><strong>Inicio</strong>
                </a>
            </div>
        </div>
    </header>

    <main class="main-container" id="main">

        <div class="container mt-5">
            <?php
        while ($seccion = $secciones->fetch_assoc()) { 
          echo '<div class="list-container">
              <div>
                  <h4><a class="a" href="views/catalogoseccion.php?id=' . $seccion['id'] . '">' . $seccion['nombre'] . '</a></h4>';
                  echo '<ul class="">';
                  
                    $controladorindex = new ControladorIndex();
                    $categorias = $controladorindex->ConsultarCategorias($bd, $seccion['id']);
                    while ($categoria = $categorias->fetch_assoc()) {
                        echo '<li class=""><a class="a" href="views/catalogocategoria.php?id=' . $categoria['id'] . '">' . $categoria['nombre'] . '</a><ul class="">';
                        $controladorindex = new ControladorIndex();
                        $subcategorias = $controladorindex->ConsultarSubCategorias($bd, $categoria['id']);
                        while ($subcategoria = $subcategorias->fetch_assoc()) {
                            echo '<li class=""><a class="a" href="views/catalogo.php?id=' . $subcategoria['id'] . '">' . $subcategoria['nombre'] . '</a></li>';
                        }
                        echo '</ul></li>';
                    }
          echo '</ul>
                </div>';
        }
    ?>
        </div>
    </main><!-- End #main -->

    <footer class="footer">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>


    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>
