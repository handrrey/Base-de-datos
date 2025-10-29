<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Menu Proveedores</title>
</head>
<body>
    <div class="header-yupi">
        <img src="../Imagenes/Logo_YUPI.webp" alt="Logo empresa" />
        <div class="header-text">
        Sistema Gestor de Rutas YUPI
        </div>
    </div>

    <div class="center-box">
        <h1>Bienvenido al Menu de Proveedores</h1><br>
        <button onclick="location.href='../Clientes/consultarClientes.php'"> Consultar Clientes </button>
        <button onclick="location.href='../Productos/registrarProductos.php'"> Registrar Productos </button>
        <button onclick="location.href='../Productos/consultarProductos.php'"> Consultar Productos </button>
        <button onclick="location.href='../Pedidos/consultarPedidos.php'"> Consultar Pedidos </button>
        <button onclick="location.href='../Reportes/Vencimiento.php'"> Reporte de Vencimientos </button>
        <button onclick="location.href='../Reportes/Agotados.php'"> Reporte de productos Agotados </button>
    </div>

    <div class="footer-yupi">
        <div class="footer-text">
        Bases de datos -- 2025 <br>
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

