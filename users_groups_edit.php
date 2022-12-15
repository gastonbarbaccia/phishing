<?php
require_once 'dbconexion.php';

$id=$_GET['id'];
$stmt = $conexion->query("select * from phishing.mygroup where id ='$id'");
$row = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add user & groups</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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

    <form action="users_group_update.php" method="POST">
        <br>
        <div>
            <div style="padding-left:3%">
                <h3>User & groups - Edit</h3>
            </div>
            <hr>
            <input type="text"  id="id" name="id" value="<?php echo $row['id'];?>" readonly hidden>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name'];?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="description" name="description" value="<?php echo $row['description'];?>">
                    </div>
                </div>
               
            </div>
        </div>
        <div style="padding-left:3%;margin-bottom:5%">
            <a href="users_groups.php" class="btn btn-primary" style="width:10%;">Cancel</a>
            <button class="btn btn-primary" style="width:10%;">Save</button>
        </div>
    </form>

    <style>
        footer {

            position: absolute;
            width: 100%;
            bottom: 0;

        }
    </style>

    <footer class="bg-light text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 Copyright:
            <a class="text-dark" href="#">Cencosud</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
</body>

</html>