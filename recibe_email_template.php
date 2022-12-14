<?php
require_once 'dbconexion.php' ;

    // Get editor content
    $name = $_POST['name0'];
    $description = $_POST['description0'];
    $editorContent = $_POST['content0'];

   
    $consulta = "SELECT MAX(id) FROM phishing.campaign";
    $con = $conexion->query($consulta)->fetchColumn();
    print_r($con);//muestra el id de campaigm
    // Check whether the editor content is empty
    if(!empty($editorContent)){
        // Insert editor content in the database

        $sql = "INSERT INTO phishing.email_template (name, description, content ) VALUES (?,?,?)";
        $conexion->prepare($sql)->execute([$name, $description, $editorContent]);
    }

?>