<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

  <?php

  include 'layouts/nav.php';

  ?>

  <div style="padding-top:2%;padding-left:1%;padding-bottom:2%">
    <h3>Cencosud Phishing Campaing</h3>
  </div>
  <div style="margin: 3%">
    <table class="table table-hover">
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
        <tr>
          <th>1</th>
          <td>5/12/2022 15:56</td>
          <td><a href="campaing_details.php">Cencosud Phishing Test</a></td>
          <td>Prueba de phishing</td>
          <td>Yes</td>
          <td>
            <a href="#">Edit</a>
            <a href="#">Delete</a>
          </td>
          <td><a href="campaing_details.php" style="color:red"><strong>Launch Campaing!</strong></a></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>