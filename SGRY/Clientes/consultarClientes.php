<?php
include("../SGRY.php");

$conexion = mysqli_connect("localhost", "root", "1309", "SGRY");
$busqueda = "";

if (isset($_POST['buscar'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_POST['busqueda']);
    $query = "SELECT * FROM clientes WHERE CEDULA LIKE '%$busqueda%'";
} else {
    $query = "SELECT * FROM clientes";
}

$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Consultar Clientes</title>
</head>
<body>
    <form method="POST">
        <label>Busqueda individual:</label><br>
        <input type="text" name="busqueda" placeholder="Buscar cliente" value="<?php echo htmlspecialchars($busqueda); ?>">
        <button type="submit" name="buscar">Buscar</button>
    </form>

    <table border="1">
        <tr><th>ID</th> 
            <th>NOMBRE</th>
            <th>ZONA</th>
            <th>DIRECCION</th>
            <th>ID PROVEEDOR</th>
            <th>CELULAR</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $fila['CEDULA']; ?></td>
                <td><?php echo $fila['NOMBRE_CLIE']; ?></td>
                <td><?php echo $fila['ZONA']; ?></td>
                <td><?php echo $fila['DIRECCION']; ?></td>
                <td><?php echo $fila['ID_PROVEEDOR']; ?></td>
                <td><?php echo $fila['NUM_CELULAR']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
