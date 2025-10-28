<?php
include("../SGRY.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1> Bienvenido a registro de Proveedor <br> Ingrese las credenciales de registro </h1>

    <form action ="registroProveedor.php" method ="post">  
        <label> Usuario: </label><br>
        <input type="text" name="usuario" required><br><br>

        <label> Contraseña: </label><br>
        <input type="password" name="contraseña" required><br><br>

        <label> Zona: </label><br>
        <input type="text" name="zona" required><br><br>

        <input type="submit" value="Ingresar">

    </form>

</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # Se ejecuta solo cuando se le da al boton

        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        $zona = $_POST["zona"];

        $res = mysqli_fetch_assoc(mysqli_query($Tbase, "SELECT * FROM proveedores WHERE ZONA = '$zona'"));
        
        # Verificación zona no utilizada
        if ($res["ZONA"] == $zona) {
            echo "Zona ya cubierta por otro proveedor";
            exit();
        }

        $query = "INSERT INTO proveedores (ZONA, NOMBRE_PROV, CONTRASEÑA)
                                        VALUES ('$zona', '$usuario', '$contraseña')";

        if (mysqli_query($Tbase, $query)){
            echo "Usuario registrado con exito";
            echo " <meta http-equiv='refresh' content='1;url=../entrada.php'> ";
            exit();
        }
        else {
            echo "ERROR: " . mysqli_error($Tbase);
        }
    } 
?>