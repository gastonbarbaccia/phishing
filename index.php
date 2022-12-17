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
  <link rel="stylesheet" href="assets/css/font-awesome.min.css"> 
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
          <th scope="col">Phishing URL</th>
          <th scope="col">Options</th>
          <th scope="col">Preview</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt = $conexion->query('select * from phishing.campaign');
        while ($row = $stmt->fetch()) {

          $id = $row['id'];

          $cons_status = "SELECT creado FROM phishing.attack JOIN phishing.campaign ON attack.campa_id = campaign.id WHERE attack.campa_id= '$id' ";
          $cons_status = $conexion->prepare($cons_status);
          $cons_status->execute([$id]);
          $creado = $cons_status->fetchColumn();

          $cons_ = "SELECT phishing_url FROM phishing.email_settings  WHERE email_settings.campaign_id= '$id' ";
          $cons_ = $conexion->prepare($cons_);
          $cons_->execute([$id]);
          $_resultado = $cons_->fetchColumn();   
       
        
          if ($row["deleted"] != 'yes') {

            echo "<tr>" .
              "<td>" . $row["id"]. "</td>" .
              "<td>" . $row["date_created"] . "</td>" .
              "<td>" . $row["name"] . "</td>" .
              "<td>" . $row["description"] . "</td>" .
              "<td><a href='$_resultado' target='blank'>" . $_resultado  . "</a></td>" .
              "<td>" .
              "<a href='edit_campaign.php?id=$id' style='padding-right:5% !important'><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:20px;padding-left:10%;color:black'></i></a> " . ' ' .
              "<a href='delete_campaign.php?id=$id'><i class='fa fa-trash' aria-hidden='true' style='font-size:20px;padding-left:10%;color:#B02203'></i></a>" .
              "</td>" .
              "<td>" . "<a href='campaing_details.php?id=$id'style='color:black'><i class='fa fa-eye' aria-hidden='true' style='font-size:20px;padding-left:10%'></i></a></td>"
              . "</tr>";

            } 
 
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