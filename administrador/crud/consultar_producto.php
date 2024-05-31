<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Productos</title>
    <link rel="stylesheet" href="../css/consultar_producto.css">
</head>
<body>
    <div class="table-container">
        <h2>Lista de Productos</h2>
        <?php
        include('../conexion.php');

        if (!$con) {
            echo "<p>Error en la conexión a la base de datos.</p>";
        } else {
            $query = "SELECT p.id, p.nombre AS producto, s.nombre AS subcategoria, m.nombre AS modelo, i.id AS imagen, p.precio, p.serie, ip.informacion AS descripcion
                      FROM productos p
                      INNER JOIN subcategorias s ON p.idsubcategoria = s.id
                      INNER JOIN modelos m ON p.idmodelo = m.id
                      INNER JOIN imagenes i ON p.idimagenes = i.id
                      LEFT JOIN informacionproductos ip ON p.id = ip.idproducto";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Subcategoría</th>
                                <th>Modelo</th>
                                <th>Imagen</th>
                                <th>Precio</th>
                                <th>Serie</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['producto']}</td>";
                    echo "<td>{$row['subcategoria']}</td>";
                    echo "<td>{$row['modelo']}</td>";
                    echo "<td>{$row['imagen']}</td>";
                    echo "<td>{$row['precio']}</td>";
                    echo "<td>{$row['serie']}</td>";
                    echo "<td>{$row['descripcion']}</td>";
                    echo "</tr>";
                }
                echo "</tbody>
                      </table>";
            } else {
                echo "<p>No se encontraron productos en la base de datos.</p>";
            }
        }
        ?>
        <button onclick="window.location.href='../dashboard/index.php'">Regresar</button>
    </div>
</body>
</html>
