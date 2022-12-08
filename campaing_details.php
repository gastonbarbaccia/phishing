<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaing Details</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">


</head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Phishing'],
            ['', 0],
            ['', 0],
            ['Link clicked', 10],
            ['Link not opened', 7]
        ]);

        var options = {
            title: 'Phishing Status - Links opened',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_1'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Phishing'],
            ['', 0],
            ['Password exposed', 2],
            ['', 0],
            ['Password not exposed', 7]
        ]);

        var options = {
            title: 'Password Exposed',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_2'));
        chart.draw(data, options);
    }
</script>

<body>

    <?php

    include 'layouts/nav.php';

    ?>

    <br>
    <div style="padding-left:1%;padding-bottom:1%">
        <h3 style="color:blue">Cencosud Phishing Campang</h3>
    </div>
    <table>
        <tbody>
            <tr>
                <td>
                    <div id="piechart_3d_2" style="width: 650px; height: 300px;"></div>
                </td>
                <td>
                    <div id="piechart_3d_1" style="width: 650px; height: 300px;"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%">
        <tbody>
            <tr>
                <td>
                    <div style="padding-left:3%"><strong>Password Exposed:</strong> <input value="2" style="color:red;border: 0"></div>
                    <div style="padding-left:3%"><strong>Password not exposed: </strong><input value="7" style="color:green;border: 0"></div>
                </td>
                <td>
                    <div style="padding-left:3%"><strong>Link clicked: </strong><input value="10" style="color:orange;border: 0"></div>
                    <div style="padding-left:3%"><strong>Link not clicked:</strong> <input value="7" style="color:green;border: 0"></div>
                </td>
            </tr>
        </tbody>
    </table>


    <hr>

    <div style="margin: 3%">
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th scope="col">Victim UID</th>
                    <th scope="col">Datetime</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Email sent?</th>
                    <th scope="col">Link clicked?</th>
                    <th scope="col">Password seen?</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><a href="campaing_password_details.php">NS12PQ3</a></th>
                    <td>5/12/2022 17:07</td>
                    <td>gastonbarbaccia@hotmail.com</td>
                    <td>Yes</td>
                    <td>Yes</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <th><a href="campaing_password_details.php">MS2BPQ3</a></th>
                    <td>5/12/2022 17:07</td>
                    <td>gastonbarbaccia@hotmail.com</td>
                    <td>Yes</td>
                    <td>Yes</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <th><a href="campaing_password_details.php">OU2BPQ3</a></th>
                    <td>5/12/2022 12:07</td>
                    <td>gastonbarbaccia@hotmail.com</td>
                    <td>Yes</td>
                    <td>Yes</td>
                    <td>Yes</td>
                </tr>
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