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
    <div class="header-yupi">
        <img src="../Imagenes/Logo_YUPI.webp" alt="Logo empresa" />
        <div class="header-text">
        Sistema Gestor de Rutas YUPI
        </div>
    </div>

    <div class="center-box">
        <h1> Bienvenido a registro de Clientes <br> Ingrese las credenciales de registro </h1>

        <form action ="registroClientes.php" method ="post">  
            <label> Nombre: </label><br>
            <input type="text" name="usuario" required><br><br>

            <label> Contraseña: </label><br>
            <input type="password" name="contraseña" required><br><br>

            <label> Zona: </label><br>
            <input type="text" name="zona" required><br><br>

            <label> Direccion: </label><br>
            <input type="text" name="direccion" required><br><br>

            <label> Celular: </label><br>
            <input type="number" name="celular" required><br><br>

            <input type="submit" value="Ingresar">

        </form>
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

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # Se ejecuta solo cuando se le da al boton

        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        $zona = $_POST["zona"];
        $direccion = $_POST["direccion"];
        $celular = $_POST["celular"];

        $res = mysqli_fetch_assoc(mysqli_query($Tbase, "SELECT * FROM proveedores WHERE ZONA = '$zona'"));

        $idProvedor = $res["ID_PROV"];

        if(!$idProvedor){
            echo "ERROR: No tenemos actualmente proveedores en su zona. Esperenos proximamente!";
            echo  "<meta http-equiv='refresh' content='1;url=../entrada.php'> ";
            exit();
        }


        $query = "INSERT INTO clientes (NOMBRE_CLIE, CONTRASEÑA, ZONA, ID_PROVEEDOR, DIRECCION, NUM_CELULAR)
                                        VALUES ('$usuario', '$contraseña', '$zona', $idProvedor, '$direccion', $celular)";

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