<?php
require_once 'dbconexion.php' ;
$id = $_POST['id'];//id user
$id_group = $_POST['id_group'];

echo $id, $id_group;

$mail = $_POST['mail'];
$sql = "UPDATE phishing.user SET email_address=? WHERE id=?";
$conexion->prepare($sql)->execute([$mail, $id]);

header("Location:users_groups_targets.php?id=$id_group");
