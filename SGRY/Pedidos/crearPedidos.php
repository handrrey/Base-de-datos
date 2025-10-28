<?php
include("../SGRY.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Registro</title>
</head>
<body>
    <h1> Bienvenido<br> Haga su pedido! </h1>

    <form action ="crearPedidos.php" method ="post">  
        <label> Id Cliente: </label><br>
        <input type="text" name="usuario" required><br><br>

        <label> Id Producto: </label><br>
        <input type="decimal" name="producto" required><br><br>

        <label> Cantidad: </label><br>
        <input type="decimal" name="cantidad" required><br><br>

        <input type="submit" value="Finalizar Pedido">

    </form>

</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # Se ejecuta solo cuando se le da al boton

        $usuario = $_POST["usuario"];
        $producto = $_POST["producto"];
        $cantidad = $_POST["cantidad"];

        # Tomar zona e ingresar a los datos -------
        $query_total = mysqli_fetch_assoc(mysqli_query($Tbase, "SELECT * FROM productos WHERE ID_PRODUCTO = '$producto'"));
        
        if($query_total && isset($query_total["PRECIO_U"])){
            $total = $cantidad * $query_total["PRECIO_U"];
        }
        else{
            echo "ERROR: Producto no existente.";
            echo " <meta http-equiv='refresh' content='1;url=crearPedidos.php'> ";
            exit();
        }
        # -----------------------------------------

        # Comprobar que el cliente exista -------
        $comp_clie = mysqli_fetch_assoc(mysqli_query($Tbase, "SELECT * FROM clientes WHERE CEDULA = '$usuario'"));
        
        if(empty($comp_clie)){
            echo "ERROR: Cliente no existente.";
            echo " <meta http-equiv='refresh' content='1;url=crearPedidos.php'> ";
            exit();
        }

        $zona = $comp_clie["ZONA"];
        # --------------------------------------

        # Evitar ingreso de cantidades negativas -------
        if($cantidad < 0){
            echo "ERROR: No se pueden pedir valores negativos";
            echo "<meta http-equiv='refresh' content='1;url=crearPedidos.php'> ";
            exit();
        }
        # ----------------------------------------------

        # Comprueba que si haya productos en stock -------
        $cant_disp = $query_total["CANTIDAD_DISP"];

        if($cant_disp < $cantidad){
            echo "ERROR: No hay productos suficientes";
            echo "<meta http-equiv='refresh' content='1;url=crearPedidos.php'> ";
            exit();
        }
        # ------------------------------------------------

        # Comprobar que el producto exista -------
        $existencia = $query_total["ID_PRODUCTO"];

        if(!$existencia){
            echo "ERROR: Producto no existente.";
            echo " <meta http-equiv='refresh' content='1;url=crearPedidos.php'> ";
            exit();
        }
        # ----------------------------------------

        # Ajuste cantidad disponible del producto -------
        $query_update = "UPDATE productos 
                        SET CANTIDAD_DISP = CANTIDAD_DISP - $cantidad
                        WHERE ID_PRODUCTO = $producto";

        mysqli_query($Tbase, $query_update);
        # -----------------------------------------------


        $query = "INSERT INTO pedidos (ZONA, ID_CLIENTE, ID_PRODUCTO, CANTIDAD_PEDI, VALOR_TOTAL)
                                      VALUES ('$zona', '$usuario', '$producto', $cantidad, '$total')";

        if (mysqli_query($Tbase, $query)){
            echo "Pedido registrado con exito";
            echo " <meta http-equiv='refresh' content='2;url=../Clientes/menuClientes.php'> ";
            exit();
        }
        else {
            echo "ERROR: Pedido no finalizado" . mysqli_error($Tbase);
        }
    }
?>