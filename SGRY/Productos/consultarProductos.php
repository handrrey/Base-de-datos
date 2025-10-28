<?php
include("../SGRY.php");

$conexion = mysqli_connect("localhost", "root", "1309", "SGRY");
$busqueda = "";

if (isset($_POST['buscar'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_POST['busqueda']);
    $query = "SELECT * FROM productos WHERE ID_PRODUCTO LIKE '%$busqueda%'";
} else {
    $query = "SELECT * FROM productos";
}

$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Consultar Productos</title>
</head>
<body>
    <form method="POST">
        <label>Busqueda individual:</label><br>
        <input type="text" name="busqueda" placeholder="Buscar cliente" value="<?php echo htmlspecialchars($busqueda); ?>">
        <button type="submit" name="buscar">Buscar</button>
    </form>

    <table border="1">
        <tr><th>ID PRODUCTO</th> 
            <th>MARCA</th>
            <th>SABOR</th>
            <th>DESCRIPCION</th>
            <th>CANTIDAD DISPONIBLE</th>
            <th>PRECIO UNIDAD</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $fila['ID_PRODUCTO']; ?></td>
                <td><?php echo $fila['MARCA']; ?></td>
                <td><?php echo $fila['SABOR']; ?></td>
                <td><?php echo $fila['DESCRIPCION']; ?></td>
                <td><?php echo $fila['CANTIDAD_DISP']; ?></td>
                <td><?php echo $fila['PRECIO_U']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
