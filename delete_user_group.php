<?php
require_once 'dbconexion.php' ;
$id = $_GET['id'];
$id_group = $_GET['id_group'];

//delete user from group

$deleted = 'yes';

$sql = "UPDATE phishing.user SET deleted=? WHERE id=?";
$conexion->prepare($sql)->execute([$deleted, $id]);

$sql1 = "DELETE FROM phishing.group_user WHERE user_id=?";
$conexion->prepare($sql1)->execute([$id]);

header("Location:users_groups_targets.php?id=$id_group");