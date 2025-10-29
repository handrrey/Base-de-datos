<?php
include("../SGRY.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Registro de Productos</title>
</head>
<body>
    <div class="header-yupi">
        <img src="../Imagenes/Logo_YUPI.webp" alt="Logo empresa" />
        <div class="header-text">
        Sistema Gestor de Rutas YUPI
        </div>
    </div>

    <div class="center-box">
        <h1> Bienvenido<br> Ingrese los datos del producto </h1>

        <form action ="registrarProductos.php" method ="post">  
            <label> Marca: </label><br>
            <input type="text" name="marca" required><br>

            <label> Sabor: </label><br>
            <input type="text" name="sabor" required><br>

            <label> Descripcion: </label><br>
            <input type="text" name="descripcion" ><br>

            <label> Cantidad disponible: </label><br>
            <input type="decimal" name="cantidad_disp" required><br>

            <label> Fecha de Vencimiento: </label><br>
            <input type="date" name="fecha_venc" required><br>

            <label> Precio Unidad: </label><br>
            <input type="decimal" name="precio" required><br>

            <input type="submit" value="Registrar Producto">

        </form>
    </div>

    <a href="../Proveedores/menuProveedor.php" class="btn-yupi">Volver al menú</a>

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



<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # Se ejecuta solo cuando se le da al boton

        $marca = $_POST["marca"];
        $sabor = $_POST["sabor"];
        $descripcion = $_POST["descripcion"];
        $cantidad_disp = $_POST["cantidad_disp"];
        $fecha_venc = $_POST["fecha_venc"];
        $precio = $_POST["precio"];
        
        if($cantidad_disp < 0) {
            echo "ERROR: No se pueden registrar valores negativos";
            echo "<meta http-equiv='refresh' content='1;url=registrarProductos.php'> ";
            exit();
        }

        $query = "INSERT INTO productos (MARCA, SABOR, DESCRIPCION, CANTIDAD_DISP, FECHA_VENCI, PRECIO_U)
                                        VALUES ('$marca', '$sabor', '$descripcion', $cantidad_disp, '$fecha_venc', '$precio')";

        if (mysqli_query($Tbase, $query)) {
            echo "Producto registrado con exito";
            echo "<meta http-equiv='refresh' content='1;url=../Proveedores/menuProveedor.php'> ";
            exit();
        }
        else {
            echo "ERROR: Producto no registrado." . mysqli_error($Tbase);
        }
    } 
?>