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
    <h1> Bienvenido<br> Ingrese los datos del producto </h1>

    <form action ="registrarProductos.php" method ="post">  
        <label> Marca: </label><br>
        <input type="text" name="marca" required><br><br>

        <label> Sabor: </label><br>
        <input type="text" name="sabor" required><br><br>

        <label> Descripcion: </label><br>
        <input type="text" name="descripcion" ><br><br>

        <label> Cantidad disponible: </label><br>
        <input type="decimal" name="cantidad_disp" required><br><br>

        <label> Fecha de Vencimiento: </label><br>
        <input type="date" name="fecha_venc" required><br><br>

        <label> Precio Unidad: </label><br>
        <input type="decimal" name="precio" required><br><br>

        <input type="submit" value="Registrar Producto">

    </form>

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