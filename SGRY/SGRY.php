<?php

# Informacion de entrada
$host = "localhost";
$user = "root";
$contraseña = "1309";
$base = "sgry";

# Conexión
try {
    $Tbase = mysqli_connect($host, $user, $contraseña, $base);
} catch (Exception $e) {
    echo "Error de conexión";
}

?>