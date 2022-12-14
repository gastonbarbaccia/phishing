<?php
try {
     
    $conexion = new PDO('mysql:host = localhost; dbname = phishing', 'root','');
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "success <br>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>