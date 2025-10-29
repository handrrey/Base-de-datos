<?php
    include("../SGRY.php");

    // Exportar CSV si pulsaron los botones
    if (isset($_POST['exportar'])) {
        $tipo_export = $_POST['exportar'];

        if ($tipo_export == "proximos") {
            $query = "SELECT * FROM productos WHERE FECHA_VENCI BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) ORDER BY FECHA_VENCI ASC";
            $filename = "Productos_A_Vencer.csv";

        } elseif ($tipo_export == "vencidos") {
            $query = "SELECT * FROM productos WHERE FECHA_VENCI < CURDATE() ORDER BY FECHA_VENCI ASC";
            $filename = "Poductos_Vencidos.csv";
        } else {
            // no hace nada.
            exit;
        }

        $result = mysqli_query($Tbase, $query);

        // Headers para descargar CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$filename);

        $output = fopen('php://output', 'w');
        // Encabezado CSV
        fputcsv($output, array('ID_PRODUCTO', 'MARCA', 'SABOR', 'DESCRIPCION', 'CANTIDAD_DISP', 'FECHA_VENCI', 'PRECIO_U'));

        // Escribir datos
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, array(
                $row['ID_PRODUCTO'], 
                $row['MARCA'], 
                $row['SABOR'], 
                $row['DESCRIPCION'], 
                $row['CANTIDAD_DISP'], 
                $row['FECHA_VENCI'], 
                $row['PRECIO_U']
            ));
        }
        fclose($output);
        exit;
    }

    // Próximos a vencer
    $sql1 = "SELECT * FROM productos WHERE FECHA_VENCI BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) ORDER BY FECHA_VENCI ASC";
    $res1 = mysqli_query($Tbase, $sql1);

    // Vencidos
    $sql2 = "SELECT * FROM productos WHERE FECHA_VENCI < CURDATE() ORDER BY FECHA_VENCI ASC";
    $res2 = mysqli_query($Tbase, $sql2);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Vencimientos</title>
</head>
<body>
    <div class="header-yupi">
        <img src="../Imagenes/Logo_YUPI.webp" alt="Logo empresa" />
        <div class="header-text">
        Sistema Gestor de Rutas YUPI
        </div>
    </div>

    <div class="center-box">
        <h1>Productos cerca de su vencimiento</h1>

        <table border="1">
            <thead>
                <tr>
                    <th>ID PRODUCTO</th> 
                    <th>MARCA</th>
                    <th>SABOR</th>
                    <th>DESCRIPCION</th>
                    <th>CANTIDAD DISPONIBLE</th>
                    <th>FECHA DE VENCIMIENTO</th>
                    <th>PRECIO UNIDAD</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($res1)): ?>
                    <tr>
                        <td><?php echo $fila['ID_PRODUCTO']?? ''; ?></td>
                        <td><?php echo $fila['MARCA']?? ''; ?></td>
                        <td><?php echo $fila['SABOR']?? ''; ?></td>
                        <td><?php echo $fila['DESCRIPCION']?? ''; ?></td>
                        <td><?php echo $fila['CANTIDAD_DISP']?? ''; ?></td>
                        <td><?php echo $fila['FECHA_VENCI']?? ''; ?></td>
                        <td><?php echo $fila['PRECIO_U']?? ''; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>


        <h1>Prodcutos vencidos</h1>

        <table border="1">
            <thead>
                <tr>
                    <th>ID PRODUCTO</th> 
                    <th>MARCA</th>
                    <th>SABOR</th>
                    <th>DESCRIPCION</th>
                    <th>CANTIDAD DISPONIBLE</th>
                    <th>FECHA DE VENCIMIENTO</th>
                    <th>PRECIO UNIDAD</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($res2)): ?>
                    <tr>
                        <td><?php echo $fila['ID_PRODUCTO']?? ''; ?></td>
                        <td><?php echo $fila['MARCA']?? ''; ?></td>
                        <td><?php echo $fila['SABOR']?? ''; ?></td>
                        <td><?php echo $fila['DESCRIPCION']?? ''; ?></td>
                        <td><?php echo $fila['CANTIDAD_DISP']?? ''; ?></td>
                        <td><?php echo $fila['FECHA_VENCI']?? ''; ?></td>
                        <td><?php echo $fila['PRECIO_U']?? ''; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <form class="sinFondo" method="POST">
            <button type="submit" name="exportar" value="proximos">Exportar cercanos a vencer</button>
            <button type="submit" name="exportar" value="vencidos">Exportar Vencidos</button>
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