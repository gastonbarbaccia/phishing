<?php
require_once 'dbconexion.php';
$id = $_GET['id'];//id del grupo                    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users & Groups Targets</title>
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


    <div style="margin: 3%">
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $stmt = $conexion->prepare('select id,email_address from phishing.user JOIN phishing.group_user ON user.id = group_user.user_id WHERE group_id=?');
                $stmt->execute([$id]);
                while($row = $stmt->fetch()){
                    $usid = $row["id"];
                       echo "<tr>".
                            "<td>".$row["id"]."</td>".
                            "<td>".$row["email_address"]."</td>".
                            "<td>" . "<a href='edit_user.php?id=$usid&id_group=$id' style='padding-right:3%'>Edit </a>" . 
                            "<a href='delete_user_group.php?id=$usid&id_group=$id'> Delete</a>' . '</td>" .
                            "</tr>";
                  } ?>
            </tbody>
        </table>
    </div>

    <?php

    include 'layouts/footer.php';

    ?>
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