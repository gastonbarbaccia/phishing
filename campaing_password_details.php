<?php
require_once 'dbconexion.php';

$id = $_GET['user_id'];//tabla user

$smt = $conexion->prepare("SELECT * from phishing.attack_user join phishing.user on attack_user.user_uid = user.uid where user.id = ?");
$smt->execute([$id]);
$row = $smt->fetch();
    $uid = $row['user_uid'];
    $date = $row['captured_on'];
    $mail = $row['email_address'];
    $pass = $row['password'];
    $aid = $row['attack_id'];
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

    <form action="recibe_edit_pass.php" method="POST">
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
                        <input type="text" class="form-control" id="uid" value="<?php echo $uid?>" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="date" value="<?php echo $date?>" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="email" value="<?php echo $mail ?>" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Password captured</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="password_captured" name="password_captured" value="<?php echo $pass?>" readonly>
                        <input type="checkbox" onclick="myFunction()">Show Password
                    </div>
                </div>
            </div>
        </div>

        <div style="padding-left:3%;margin-bottom:5%">
            <a href="campaing_details.php?id=<?php echo $aid?>" class="btn btn-primary">Go Back</a>
        </div>
    </form>

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