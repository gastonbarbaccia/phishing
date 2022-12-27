<?php
require_once 'dbconexion.php' ;
$id = $_GET['id'];//id group

$mail = $_POST['mail'];

$stmt = $conexion->query("SELECT id,email_address FROM phishing.user join phishing.group_user on user.id = group_user.user_id where group_id='$id'");
$emails = "";
while($row=$stmt->fetch()){
$emails .= $row['email_address'];//trae los email del grupo
}

$umail = $conexion->query("SELECT email_address FROM phishing.user");
$uemails = "";
while($roww=$umail->fetch()){
$uemails .= $roww['email_address'];//trae los email de la tabla user que ya existen
}

$tmail = trim($mail);
$s = strpos($emails , strval($tmail));//compara el mail ingresado con el string que tiene los emails que estan en el grupo
$ss = strpos($uemails , strval($tmail)); //compara el mail ingresado con el string que tiene los emails de la tabla user

if($s === false){ //si el mail ingresado no existe en el grupo
    if($ss === false){ //si el mail ingresado no existe en la tabla user crear user y agregarlo al grupo

        $uniqid = uniqid();
        $sql = "INSERT INTO phishing.user (uid,email_address) VALUES (?,?)";
        $conexion->prepare($sql)->execute([$uniqid,$mail]);

        $user_id = $conexion->lastInsertId();

        $consulta_group = "SELECT id FROM phishing.mygroup where id='$id'";
        $con0 = $conexion->query($consulta_group)->fetchColumn();

        $sql1 = "INSERT INTO phishing.group_user (group_id, user_id) VALUES (?,?)";
        $conexion->prepare($sql1)->execute([$con0, $user_id]);
    }
    else   { //si el mail ingresado ya existe en la tabla user

        $cons = "SELECT id FROM phishing.user where email_address='$tmail'";
        $us_id = $conexion->query($cons)->fetchColumn();

        $sql1 = "INSERT INTO phishing.group_user (group_id, user_id) VALUES (?,?)";
        $conexion->prepare($sql1)->execute([$id, $us_id]);
    }
}
header("Location:users_groups.php?id=$id");