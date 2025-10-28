<?php
include("SGRY.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Log In</title>
</head>
<body>
    <h1> Bienvenido a Inicio de sesión </h1>

    <form action ="index.php" method ="post" >  
        <label> Usuario: </label><br>
        <input type="text" name="usuario" required><br><br>

        <label> Contraseña: </label><br>
        <input type="pasword" name="contraseña" required><br><br>

        <label> Tipo de Usuario: </label><br>
        <select name="tipo_user" required>  
            <option value="proveedores" > Proveedor </option>
            <option value="clientes" > Cliente </option>
        </select><br><br><br>

        <input type="submit" value="Ingresar">

    </form>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { # Se ejecuta solo cuando se le da al boton

    $usuario = $_POST["usuario"] ?? "";
    $contraseña = $_POST["contraseña"] ?? "";
    $tipo_user = $_POST["tipo_user"];

    # Verificación existencia correcta de datos de proveedores
    if($_POST["tipo_user"] == "proveedores"){
        $query = "SELECT * FROM proveedores WHERE NOMBRE_PROV = '$usuario' ";
        $resultado = mysqli_fetch_assoc(mysqli_query($Tbase, $query));

        if(!$resultado and $usuario != ""){
            echo "Usuario no encontrado";
            exit();
        }

        if ($resultado["CONTRASEÑA"] == $contraseña) {
            echo "<meta http-equiv='refresh' content='1;url=Proveedores/menuProveedor.php'> ";
        }
        else {
            echo "Contraseña incorrecta. Verifique.";
        }
    }

    # Verificación existencia correcta de datos de clientes
    if($_POST["tipo_user"] == "clientes"){
        $query = "SELECT * FROM clientes WHERE NOMBRE_CLIE = '$usuario' ";
        $resultado = mysqli_fetch_assoc(mysqli_query($Tbase, $query));

        if(!$resultado and $usuario != ""){
            echo "Usuario no encontrado";
            exit();
        }

        if ($resultado["CONTRASEÑA"] == $contraseña) {
            echo "<meta http-equiv='refresh' content='1;url=Clientes/menuClientes.php'> ";
        }
        else {
            echo "Contraseña incorrecta. Verifique.";
        }
    }

}
?>