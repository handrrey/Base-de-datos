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
    <div class="header-yupi">
        <img src="../Imagenes/Logo_YUPI.webp" alt="Logo empresa" />
        <div class="header-text">
        Sistema Gestor de Rutas YUPI
        </div>
    </div>

    <div class="center-box">
        <form method="POST">
            <label>Busqueda individual:</label><br><br>
            <input type="text" name="busqueda" placeholder="Buscar Pedido..." value="<?php echo htmlspecialchars($busqueda); ?>">
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
    </div>

    <div class="footer-yupi">
        <div class="footer-text">
        Bases de datos -- 2025 <br><br>
        Carlos Alberto Ocampo Sepulveda
        </div>

        <div class="footer-carousel">
        <img id="carousel-img" src="../Imagenes/golpe-bbq.png" alt="Imagen 1">
        </div>
    </div>

    <script>
    const images = ['../Imagenes/golpe-bbq.png', '../Imagenes/golpe-ranchero.png', '../Imagenes/rizadas-pollo.png', 
    '../Imagenes/rizadas-tomate.png', '../Imagenes/tosti-arepa.png', '../Imagenes/tosti-empanada-limon.png', 
    '../Imagenes/tosti-nachos-bbq.png', '../Imagenes/yupi_salado-1.png', '../Imagenes/yupis_queso_horneados01_50g.png', '../Imagenes/copelia-panelitas.png']; // Rutas de tus imágenes
    let idx = 0;
    setInterval(() => {
    idx = (idx + 1) % images.length;
    document.getElementById('carousel-img').src = images[idx];
    }, 2300); // Cambia cada 2.3 segundos
    </script>
</body>

</html>


