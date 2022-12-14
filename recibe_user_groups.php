<?php
require_once 'dbconexion.php' ;

$name = $_POST['name'];
$description = $_POST['description'];
$targets = $_POST['targets'];

print_r($_POST);

$sql1 = "INSERT INTO phishing.mygroup (name, description) VALUES (?,?)";
$conexion->prepare($sql1)->execute([$name, $description]);

$separador = ",";
$email = explode($separador, $targets);
foreach($email as $mail){
    $uniqid = uniqid();
    $sql2 = "INSERT INTO phishing.user (uid, email_address ) VALUES (?,?)";
    $conexion->prepare($sql2)->execute([$uniqid, $mail]);

    $consulta_group = "SELECT MAX(id) FROM phishing.mygroup";
    $con0 = $conexion->query($consulta_group)->fetchColumn();
    
    $consulta_user = "SELECT MAX(id) FROM phishing.user";
    $con1 = $conexion->query($consulta_user)->fetchColumn();
    
    $sql3 = "INSERT INTO phishing.group_user (group_id, user_id) VALUES (?,?)";
    $conexion->prepare($sql3)->execute([$con0, $con1]);
}
header('Location:users_groups.php');
?>