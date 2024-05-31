<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../css/guardar_producto.css">
</head>
<body>
    <div class="form-container">
        <h2>Agregar Nuevo Producto</h2>
        <form action="guardar_producto.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" id="nombre" required><br><br>
            
            <label for="subcategoria">Subcategoría:</label>
            <select name="subcategoria" id="subcategoria">
                <?php
                include('../conexion.php');
                $query = "SELECT id, nombre FROM subcategorias";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                ?>
            </select><br><br>

            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" id="precio" required><br><br>

            <label for="modelo">Modelo:</label>
            <select name="modelo" id="modelo">
                <?php
                $query = "SELECT id, nombre FROM modelos";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                ?>
            </select><br><br>

            <label for="serie">Serie:</label>
            <input type="text" name="serie" id="serie" required><br><br>

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" ><br><br>
            
            <label for="descripcion">Descripción del Producto:</label>
            <textarea name="descripcion" id="descripcion" required></textarea><br><br>

            <input type="submit" name="submit" value="Guardar Producto">
        </form>
        <button onclick="window.location.href='../dashboard/index.php'">Regresar</button>
    </div>

    <?php
    include('../conexion.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $subcategoria = $_POST['subcategoria'];
        $modelo = $_POST['modelo'];
        $precio = $_POST['precio'];
        $serie = $_POST['serie'];
        $descripcion = $_POST['descripcion'];

        // Obtener datos binarios de la imagen
        $imagen_binaria = file_get_contents($_FILES['imagen']['tmp_name']);

        // Insertar la imagen en la base de datos
        $insertar_imagen = "INSERT INTO imagenes (nombre) VALUES (?)";
        $stmt = mysqli_prepare($con, $insertar_imagen);
        mysqli_stmt_bind_param($stmt, "b", $imagen_binaria);
        mysqli_stmt_send_long_data($stmt, 0, $imagen_binaria);
        mysqli_stmt_execute($stmt);

        // Obtener el ID de la imagen insertada
        $id_imagen = mysqli_insert_id($con);

        // Insertar el producto en la base de datos
        $insertar_producto = "INSERT INTO productos (nombre, idsubcategoria, precio, idmodelo, serie, idimagenes) 
                              VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertar_producto);
        mysqli_stmt_bind_param($stmt, "siisis", $nombre, $subcategoria, $precio, $modelo, $serie, $id_imagen);
        mysqli_stmt_execute($stmt);

        // Insertar la descripción del producto en la tabla informacionproductos
        $ultimo_producto_id = mysqli_insert_id($con);
        $insertar_descripcion = "INSERT INTO informacionproductos (idproducto, informacion, idtipoinformacion) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertar_descripcion);
        $idtipoinformacion = 1; // Asumiendo que 1 es el ID de la información de descripción
        mysqli_stmt_bind_param($stmt, "isi", $ultimo_producto_id, $descripcion, $idtipoinformacion);
        mysqli_stmt_execute($stmt);

        echo "Producto agregado correctamente.";
    }
    ?>

</body>
</html>
