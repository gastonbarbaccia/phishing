<?php

function netflix($victim_url){

$body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Aguante tere!!!</h1>
<a href='.$victim_url.'>Link de prueba</a>
</body>
</html>';

return $body;

}


?>


