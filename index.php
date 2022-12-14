<?php
require_once 'dbconexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

</head>

<body>

  <?php

  include 'layouts/nav.php';

  ?>

  <div style="padding-top:2%;padding-left:1%;">
    <h3>Cencosud Phishing Campaing</h3>
  </div>
  <div style="margin: 3%">
    <table class="table table-hover" id="datatable">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Created date</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Active</th>
          <th scope="col">Options</th>
          <th scope="col">Attack</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $stmt = $conexion->query('select * from phishing.campaign');
      while($row = $stmt->fetch()) 
        {
          if($row["is_active"] == null){
            $active = 'no';
          }
          else
            $active = 'yes';
            $id = $row['id'];
             echo "<tr>".
                  "<td>".$row["id"]."</td>".
                  "<td>".$row["date_created"]."</td>".
                  "<td>".$row["name"]."</td>".
                  "<td>".$row["description"]."</td>".
                  "<td>".$active. "</td>".
                  "<td>". 
                          "<a href='edit_campaign.php?id=$id' style='padding-right:5% !important'>Edit </a> " . ' '. 
                          "<a href='delete_campaign.php?id=$id'>Delete</a>".
                  "</td>".
                "<td>"."<a href='campaing_details.php?id=$id'style='color:red'><strong>Launch Campaing!</strong></a></td>"
                 . "</tr>";
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