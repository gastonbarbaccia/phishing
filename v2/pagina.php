<?php 
require_once '../dbconexion.php';

$id = $_POST['victimid'];

echo $id;

if($_POST['victimid']== $id) {
    $clicked = 1;
    $click = "UPDATE phishing.attack_user SET link_clicked=?, captured_on = ? WHERE user_uid=?";
    $conexion->prepare($click)->execute([$clicked, null, $id]);
    }
?>