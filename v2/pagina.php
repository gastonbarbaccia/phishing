<?php 
require_once '../dbconexion.php';


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");



$id = $_POST['victimid'];

echo $id;

if($_POST['victimid']== $id) {
    $clicked = 1;
    $click = "UPDATE phishing.attack_user SET link_clicked=?, captured_on = ? WHERE user_uid=?";
    $conexion->prepare($click)->execute([$clicked, null, $id]);
    }
?>