<?php

require_once 'dbconexion.php';

$name = $_POST['name'];
$description = $_POST['description'];
$targets = $_POST['targets'];

$consulta_group = "SELECT MAX(id) FROM phishing.mygroup";
$con0 = $conexion->query($consulta_group)->fetchColumn();

$consulta_user = "SELECT MAX(id) FROM phishing.user";
$con1 = $conexion->query($consulta_user)->fetchColumn();

$sql1 = "INSERT INTO phishing.mygroup (name, description) VALUES (?,?)";
$conexion->prepare($sql1)->execute([$name, $description]);

$separador = ",";

$stmt = $conexion->query("SELECT email_address FROM phishing.user");
$emails = "";
while($row=$stmt->fetch()){
$emails .= $row['email_address'];//trae los email de la tabla user que ya existen
}

$email = explode($separador, $targets);
$array_mail = array_unique($email);

foreach ($array_mail as $mail) {
    $tmail = trim($mail);
    $s = strpos($emails , strval($tmail));//devuelve la posicion donde esta el string
    if($s === false){
    echo $s."<br>";
    $uniqid = uniqid();
    $sql2 = "INSERT INTO phishing.user (uid, email_address ) VALUES (?,?)";
    $conexion->prepare($sql2)->execute([$uniqid, $tmail]);

    $consulta_group = "SELECT MAX(id) FROM phishing.mygroup";
    $con0 = $conexion->query($consulta_group)->fetchColumn();
    
    $consulta_user = "SELECT MAX(id) FROM phishing.user";
    $con1 = $conexion->query($consulta_user)->fetchColumn();
    
    $sql3 = "INSERT INTO phishing.group_user (group_id, user_id) VALUES (?,?)";
    $conexion->prepare($sql3)->execute([$con0, $con1]);    
    }
    else{    
        echo $s  . "<br />";
        $stmt = $conexion->prepare("SELECT id from phishing.user where email_address =?");
        $stmt->execute([$tmail]); 
        $user = $stmt->fetch();
        if ($user) {        
            $id = $user['id'];
            echo $uid. "<br />";
            $uniqid = uniqid();
            $sql = "UPDATE phishing.user SET uid =? WHERE email_address=?";
            $conexion->prepare($sql)->execute([$uniqid, $tmail]);
            echo $uniqid. "<br />";
            //traer el ultimo grupo creado y asignarlo al usuario
            $consulta_group = "SELECT MAX(id) FROM phishing.mygroup";
            $con0 = $conexion->query($consulta_group)->fetchColumn();
            $sql3 = "INSERT INTO phishing.group_user (group_id, user_id) VALUES (?,?)";
            $conexion->prepare($sql3)->execute([$con0, $id]);
        }
    }
}
header('Location:users_groups.php');
?>