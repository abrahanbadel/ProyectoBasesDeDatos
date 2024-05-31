<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../css/editar_producto.css">
</head>
<body>
    <div class="form-container">
        <h2>Editar Producto</h2>
        <?php
        include('../conexion.php');

        if (!$con) {
            echo "<p>Error en la conexión a la base de datos.</p>";
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
                $id = intval($_POST['id']);
                $nombre = $_POST['nombre'];
                $subcategoria = $_POST['subcategoria'];
                $modelo = $_POST['modelo'];
                $precio = $_POST['precio'];
                $serie = $_POST['serie'];
                $descripcion = $_POST['descripcion'];
                
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                    $imagen_binaria = file_get_contents($_FILES['imagen']['tmp_name']);
                    $insertar_imagen = "INSERT INTO imagenes (nombre) VALUES (?)";
                    $stmt = mysqli_prepare($con, $insertar_imagen);
                    mysqli_stmt_bind_param($stmt, "b", $imagen_binaria);
                    mysqli_stmt_execute($stmt);
                    $id_imagen = mysqli_insert_id($con);
                    $update_query = "UPDATE productos SET nombre=?, idsubcategoria=?, precio=?, idmodelo=?, serie=?, idimagenes=? WHERE id=?";
                    $stmt = mysqli_prepare($con, $update_query);
                    mysqli_stmt_bind_param($stmt, "siisisi", $nombre, $subcategoria, $precio, $modelo, $serie, $id_imagen, $id);
                } else {
                    $update_query = "UPDATE productos SET nombre=?, idsubcategoria=?, precio=?, idmodelo=?, serie=? WHERE id=?";
                    $stmt = mysqli_prepare($con, $update_query);
                    mysqli_stmt_bind_param($stmt, "siissi", $nombre, $subcategoria, $precio, $modelo, $serie, $id);
                }
                
                $update_desc_query = "UPDATE informacionproductos SET informacion=? WHERE idproducto=?";
                $stmt_desc = mysqli_prepare($con, $update_desc_query);
                mysqli_stmt_bind_param($stmt_desc, "si", $descripcion, $id);
                
                if (mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt_desc)) {
                    echo "<p>Producto actualizado correctamente.</p>";
                } else {
                    echo "<p>Error al actualizar el producto: " . mysqli_error($con) . "</p>";
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $query = "SELECT p.id, p.nombre, p.idsubcategoria, p.precio, p.idmodelo, p.serie, i.informacion
                          FROM productos p
                          LEFT JOIN informacionproductos i ON p.id = i.idproducto
                          WHERE p.id = $id";
                $result = mysqli_query($con, $query);
                $producto = mysqli_fetch_assoc($result);
                if ($producto) {
                    ?>
                    <form action="editar_producto.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                        
                        <label for="nombre">Nombre del Producto:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $producto['nombre']; ?>" required><br><br>
                        
                        <label for="subcategoria">Subcategoría:</label>
                        <select name="subcategoria" id="subcategoria">
                            <?php
                            $query = "SELECT id, nombre FROM subcategorias";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = $row['id'] == $producto['idsubcategoria'] ? 'selected' : '';
                                echo "<option value='{$row['id']}' $selected>{$row['nombre']}</option>";
                            }
                            ?>
                        </select><br><br>

                        <label for="precio">Precio:</label>
                        <input type="number" step="0.01" name="precio" id="precio" value="<?php echo $producto['precio']; ?>" required><br><br>

                        <label for="modelo">Modelo:</label>
                        <select name="modelo" id="modelo">
                            <?php
                            $query = "SELECT id, nombre FROM modelos";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = $row['id'] == $producto['idmodelo'] ? 'selected' : '';
                                echo "<option value='{$row['id']}' $selected>{$row['nombre']}</option>";
                            }
                            ?>
                        </select><br><br>

                        <label for="serie">Serie:</label>
                        <input type="text" name="serie" id="serie" value="<?php echo $producto['serie']; ?>" required><br><br>

                        <label for="imagen">Imagen:</label>
                        <input type="file" name="imagen" id="imagen"><br><br>
                        
                        <label for="descripcion">Descripción del Producto:</label>
                        <textarea name="descripcion" id="descripcion" required><?php echo $producto['informacion']; ?></textarea><br><br>

                        <input type="submit" name="submit" value="Guardar Cambios">
                    </form>
                    <button onclick="window.location.href='../vistas/panel_admin.php'">Regresar</button>
                    <?php
                } else {
                    echo "<p>Producto no encontrado.</p>";
                }
            } else {
                // Muestra una lista de productos para seleccionar
                $query = "SELECT id, nombre FROM productos";
                $result = mysqli_query($con, $query);
                if ($result) {
                    echo "<form method='get' action='editar_producto.php'>";
                    echo "<label for='id'>Selecciona un producto para editar:</label>";
                    echo "<select name='id' id='id'>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                    }
                    echo "</select>";
                    echo "<input type='submit' value='Editar'>";
                    echo "</form>";
                    echo "<button onclick=\"window.location.href='../dashboard/index.php'\">Regresar</button>";
                } else {
                    echo "<p>Error al realizar la consulta: " . mysqli_error($con) . "</p>";
                }
            }
        }
        ?>
    </div>
</body>
</html>
