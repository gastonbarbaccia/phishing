<?php

require_once 'dbconexion.php';

$id=$_POST['id'];
$name=$_POST['name'];
$description=$_POST['description'];
$stmt = $conexion->query("update phishing.mygroup set name='$name',description='$description' where id ='$id'");

header('Location: users_groups.php');


?>