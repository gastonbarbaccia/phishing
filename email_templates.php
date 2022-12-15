<?php
require_once 'dbconexion.php' ;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email templates</title>
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

    <form action="recibe_email_template.php" method="POST">
        <br>
        <div>
            <div style="padding-left:3%">
                <h3>Email templates</h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="name0">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="description" name="description0">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-5">
                        <textarea type="text" class="form-control" id="email_template" name="content0" style="height:200px"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div style="padding-left:3%;margin-bottom:5%">
            <a href="index.php" class="btn btn-primary">Cancel</a>
            <button class="btn btn-primary" style="width:5%">Save</button>
        </div>
    </form>


    <div style="margin: 3%">
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Message</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
            <?php                  
            $stmt = $conexion->prepare('select id,name, description,email_deleted from phishing.email_template  where deleted = "no"');
            $stmt->execute();
            while($row = $stmt->fetch()){
                    $id = $row['id'];

                    if($row["email_deleted"] != 'yes'){

                    echo "<tr>".
                        "<td>".$row["id"]."</td>".
                        "<td>".$row["name"]."</td>".
                        "<td>".$row["description"]."</td>".
                        '<td>'. "<a href='email_template_details.php?id=$id'>View</a></td>".
                        "<td>" . "<a href='email_template_edit.php?id=$id' style='padding-right:3%'>Edit </a>" . "  ".
                        '<a href="delete_email_template.php?id='.$id.'"> Delete</a>' . '</td>' .
                        '<td>'. "<a href='email_template_details.php?id=$id'>View</a></td>".
                        "<td>" . "<a href='edit_template.php?id=$id'>Edit </a>" . "  ".
                        "<a href='delete_template.php?id=$id'> Delete</a>" . '</td>' .
                        "</tr>";

                    } 
              } ?>
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