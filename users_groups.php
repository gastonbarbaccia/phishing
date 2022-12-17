<?php
require_once 'dbconexion.php';
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
    <link rel="stylesheet" href="assets/css/font-awesome.min.css"> 
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

    <form action="recibe_user_groups.php" method="POST">
        <br>
        <div>
            <div style="padding-left:3%">
                <h3>Add user & groups</h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Targets</label>
                    <div class="col-sm-5">
                        <textarea type="text" class="form-control" id="target" name="targets" placeholder="example@hotmail.com, example2@hotmail.com ..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-left:3%;margin-bottom:5%">
            <button class="btn btn-primary">Add User & Group</button>
        </div>
    </form>

    <div style="margin: 3%">
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Targets</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $stmt = $conexion->query('select * from phishing.mygroup');
                while($row = $stmt->fetch()){
                      $id = $row['id'];

                    if($row['group_deleted'] != 'yes'){                      
                       echo "<tr>".
                            "<td>".$row["id"]."</td>".
                            "<td>".$row["name"]."</td>".
                            "<td>".$row["description"]."</td>".
                            '<td>'. "<a href='users_groups_targets.php?id=$id'><i class='fa fa-eye' aria-hidden='true' style='font-size:20px;padding-left:10%'></i></a></td>".
                            "<td>" . "<a href='users_groups_edit.php?id=$id' style='padding-right:3%'><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:20px;padding-left:10%;color:black'></i></a>" . "  ".
                            '<a href="users_groups_delete.php?id='.$id.'"><i class="fa fa-trash" aria-hidden="true" style="font-size:20px;padding-left:10%;color:#B02203"></i></a>' . '</td>' .
                            "</tr>";
                   } 
                  
                }?>                              
            </tbody>
        </table>
    </div>

    <style>
        footer {

            position: absolute;
            width: 100%;

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