<?php
require_once 'dbconexion.php';

$id = $_GET['user_id']; //tabla user

$campaign_id = $_GET['cid'];

$smt = $conexion->prepare("SELECT * from phishing.attack_user join phishing.user on attack_user.user_uid = user.uid where user.id = ?");
$smt->execute([$id]);
$row = $smt->fetch();
if($row !== false){ //si no se creo el ataque, esta vacio y da error
    $uid = $row['user_uid'];
    $date = $row['captured_on'];
    $username = $row['user_username'];
    $mail = $row['email_address'];
    $pass = $row['user_password'];
    $aid = $row['attack_id'];
}else{
    $cons = $conexion->prepare("SELECT * from phishing.user where user.id = ?");
    $cons->execute([$id]);
    $roww = $cons->fetch();


    $uid = $roww['uid'];
    $date = '';
    $username = '';
    $mail = $roww['email_address'];
    $pass = '';    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaings Password Details</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>


<style>
    .row {
        --bs-gutter-x: 0rem !important;
    }
</style>

<body>

    <?php

    include 'layouts/nav.php';

    ?>


    <br>
    <div>
        <div style="padding-left:3%">
            <h3>Password captured</h3>
        </div>
        <hr>
        <div style="padding-left:3%">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">UID</label>
                <div class="col-sm-5">
                    <input type="text" name="uid" class="form-control" id="uid" value="<?php echo $uid ?>" readonly disabled>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="date" id="date" value="<?php echo $date ?>" readonly disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="mail" id="email" value="<?php echo $mail ?>" readonly disabled>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Username captured</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $username ?>" readonly disabled>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Password captured</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="password_captured" name="password_captured" value="<?php echo $pass ?>" readonly disabled>
                    <input type="checkbox" onclick="myFunction()">Show Password
                </div>
            </div>
        </div>
    </div>

    <div style="padding-left:3%;margin-bottom:5%">
        <a href="campaing_details.php?id=<?php echo $campaign_id?>" class="btn btn-primary">Go Back</a>
    </div>


    <?php

    include 'layouts/footer.php';

    ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("password_captured");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>