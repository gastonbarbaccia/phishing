<?php
require_once 'dbconexion.php' ;
$id = $_GET['id'];//id group

echo $id;

$mail = $_POST['mail'];

$stmt = $conexion->query("SELECT email_address FROM phishing.user join phishing.group_user on user.id = group_user.user_id where group_id='$id'");
$emails = "";
while($row=$stmt->fetch()){
$emails .= $row['email_address'];//string con los email de los usuarios de ese grupo
}

$umail = $conexion->query("SELECT id,email_address FROM phishing.user");
$uemails = "";
while($row=$umail->fetch()){
$uemails .= $row['email_address'];//trae los email de la tabla user que ya existen
$us_id=$row['id'];
}

$tmail = trim($mail);
$s = strpos($emails , strval($tmail));//devuelve la posicion donde esta el string
$ss = strpos($uemails , strval($tmail));
if($s === false && $ss === false){

$uniqid = uniqid();
$sql = "INSERT INTO phishing.user (uid,email_address) VALUES (?,?)";
$conexion->prepare($sql)->execute([$uniqid,$mail]);

$user_id = $conexion->lastInsertId();

$consulta_group = "SELECT id FROM phishing.mygroup where id='$id'";
$con0 = $conexion->query($consulta_group)->fetchColumn();

$sql1 = "INSERT INTO phishing.group_user (group_id, user_id) VALUES (?,?)";
$conexion->prepare($sql1)->execute([$con0, $user_id]);
}
else{
    $uniqid = uniqid();
    $sql = "UPDATE phishing.user SET uid =? WHERE email_address=?";
    $conexion->prepare($sql)->execute([$uniqid, $tmail]);

    $sql3 = "INSERT INTO phishing.group_user (group_id, user_id) VALUES (?,?)";
    $conexion->prepare($sql3)->execute([$id, $us_id]);
}
echo $ss;
//header("Location:users_groups.php?id=$id");