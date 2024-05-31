<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="../css/eliminar_producto.css">
</head>
<body>
    <div class="table-container">
        <h2>Eliminar Productos</h2>
        <?php
        include('../conexion.php');

        if (!$con) {
            echo "<p>Error en la conexión a la base de datos.</p>";
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
                $id = intval($_POST['id']);
                $delete_info_query = "DELETE FROM informacionproductos WHERE idproducto = $id";
                $delete_info_result = mysqli_query($con, $delete_info_query);

                if ($delete_info_result) {
                    $delete_query = "DELETE FROM productos WHERE id = $id";
                    $delete_result = mysqli_query($con, $delete_query);

                    if ($delete_result) {
                        echo "<p>Producto eliminado correctamente.</p>";
                    } else {
                        echo "<p>Error al eliminar el producto: " . mysqli_error($con) . "</p>";
                    }
                } else {
                    echo "<p>Error al eliminar la información del producto: " . mysqli_error($con) . "</p>";
                }
            }

            $query = "SELECT p.id, p.nombre, s.nombre AS subcategoria, p.precio, m.nombre AS modelo, p.serie
                      FROM productos p
                      JOIN subcategorias s ON p.idsubcategoria = s.id
                      JOIN modelos m ON p.idmodelo = m.id";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Subcategoría</th>
                                <th>Precio</th>
                                <th>Modelo</th>
                                <th>Serie</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['nombre']}</td>";
                    echo "<td>{$row['subcategoria']}</td>";
                    echo "<td>{$row['precio']}</td>";
                    echo "<td>{$row['modelo']}</td>";
                    echo "<td>{$row['serie']}</td>";
                    echo "<td>
                            <form method='post' action='eliminar_producto.php' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este producto?\");'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <input type='submit' value='Eliminar'>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                echo "</tbody>
                      </table>";
            } else {
                echo "<p>Error al realizar la consulta: " . mysqli_error($con) . "</p>";
            }
        }
        ?>
        <button onclick="window.location.href='../dashboard/index.php'">Regresar</button>
    </div>
</body>
</html>
