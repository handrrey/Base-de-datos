<?php
include("../SGRY.php");

$conexion = mysqli_connect("localhost", "root", "1309", "SGRY");
$busqueda = "";

if (isset($_POST['buscar'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_POST['busqueda']);
    $query = "SELECT * FROM pedidos WHERE ID_PEDIDO LIKE '%$busqueda%'";
} else {
    $query = "SELECT * FROM pedidos";
}

$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Consultar Pedidos</title>
</head>
<body>
    <form method="POST">
        <label>Busqueda individual:</label><br>
        <input type="text" name="busqueda" placeholder="Buscar cliente" value="<?php echo htmlspecialchars($busqueda); ?>">
        <button type="submit" name="buscar">Buscar</button>
    </form>

    <table border="1">
        <tr><th>CODIGO</th> 
            <th>ZONA</th>
            <th>ID CLIENTE</th>
            <th>ID PRODUCTO</th>
            <th>CANTIDAD</th>
            <th>TOTAL</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $fila['ID_PEDIDO']; ?></td>
                <td><?php echo $fila['ZONA']; ?></td>
                <td><?php echo $fila['ID_CLIENTE']; ?></td>
                <td><?php echo $fila['ID_PRODUCTO']; ?></td>
                <td><?php echo $fila['CANTIDAD_PEDI']; ?></td>
                <td><?php echo $fila['VALOR_TOTAL']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
