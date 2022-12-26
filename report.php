<?php
require_once 'dbconexion.php';

include 'constants.php';

$url = $public_url;

$cid = $_GET['id']; //campaign id
$cons1 = "SELECT group_id FROM phishing.campaign where id = ? ";
$con1 = $conexion->prepare($cons1);
$con1->execute([$cid]);
$group_id = $con1->fetchColumn();

$sql3 = "SELECT * FROM phishing.user JOIN phishing.group_user ON user.id = group_user.user_id WHERE group_id= ?";
$con2 = $conexion->prepare($sql3);
$con2->execute([$group_id]);
$user_id = $con2->fetchAll();

$que2 = $conexion->prepare("SELECT * from phishing.attack where attack.campa_id = ?");
$que = $que2->execute([$cid]);
$attack_exist = $que2->fetchColumn();

$cons21 = "SELECT attack.id FROM phishing.attack JOIN phishing.campaign ON attack.campa_id = campaign.id WHERE attack.campa_id= ? ORDER BY attack.id DESC LIMIT 1";
$con21 = $conexion->prepare($cons21);
$con21->execute([$cid]);
$attack_id = $con21->fetchColumn();

$estado = "SELECT attack.status FROM phishing.attack JOIN phishing.campaign ON attack.campa_id = campaign.id WHERE attack.campa_id= ? ORDER BY attack.id DESC LIMIT 1";
$status = $conexion->prepare($estado);
$status->execute([$cid]);
$consulta = $status->fetchColumn();

if ($consulta == 1) {
    $astatus = 'In progress...';
} elseif ($consulta == 2) {
    $astatus = 'Completed ';
} else if ($consulta == 3) {
    $astatus = 'Error sending emails';
} else {
    $astatus = 'Launch Attack! ';
}

$click_counts = 0;
$pass_counts = 0;
$clickno_counts = 0;
$passno_counts = 0;

$cons = "SELECT name FROM phishing.campaign where id = ? ";
$con = $conexion->prepare($cons);
$con->execute([$cid]);
$consult = $con->fetchColumn();

$cons = "SELECT mygroup.name FROM phishing.mygroup JOIN phishing.campaign ON mygroup.id = campaign.group_id WHERE campaign.id=? ";
$con = $conexion->prepare($cons);
$con->execute([$cid]);
$consult2 = $con->fetchColumn();

$cons00 = "SELECT email_template.name FROM phishing.email_template join phishing.campaign on email_template.id = campaign.email_template_id where campaign.id = ? ";
$con00 = $conexion->prepare($cons00);
$con00->execute([$cid]);
$consult00 = $con00->fetchColumn();

$cons1 = "SELECT date_time FROM phishing.attack JOIN phishing.campaign ON campa_id = campaign.id WHERE campaign.id=? ORDER BY date_time DESC LIMIT 1";
$con1 = $conexion->prepare($cons1);
$con1->execute([$cid]);
$consult1 = $con1->fetchColumn();

$cons_ = "SELECT phishing_url FROM phishing.email_settings  WHERE email_settings.campaign_id= ?";
$cons_ = $conexion->prepare($cons_);
$cons_->execute([$cid]);
$_resultado = $cons_->fetchColumn();


$stmt = $conexion->prepare('select COUNT(user.id) from phishing.user JOIN phishing.attack_user ON user.uid = attack_user.user_uid where attack_id=?');
$stmt->execute([$attack_id]);
$user_count = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report <?php echo $consult ?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href="assets/css/toastr.css" rel="stylesheet" type="text/css" />
</head>



<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php"><img src="assets/img/logo.png" width="100px" height="50px"> Phishing Platform</a>
            <button id="navbartoggler" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup" name="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php

                    include 'layouts/navbar_base.php';

                    ?>
                    <button class="btn btn-secondary" style="margin-left: 200px;" id="button_print"><i class='fa fa-print' aria-hidden='true' style='font-size:20px;padding-right:10px'></i> Print report</button>
                </div>
            </div>
        </div>
    </nav>


    <br>

    <style>
        .row {
            --bs-gutter-x: 0rem !important;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
        }
    </style>
    <table style="width:100%">
        <tbody>
            <tr>
                <td>
                    <div style="padding-left:10%;padding-bottom:8%;">
                        <div class="mb-3">
                            <label for="staticEmail" class="col-sm-5 col-form-label"><b>Campaign name:</b></label>
                            <div>
                                <label style="border: 0;"><?php echo $consult; ?></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="staticEmail" class="col-sm-5 col-form-label"><b>Campaign launched: </b></label>
                            <div>
                                <label style="border: 0;"><?php echo $consult1; ?></label>
                            </div>
                        </div>
                    </div>
                    </div>
                </td>
                <td>
                    <div style="padding-left:3%;padding-bottom:10%;">
                        <div class="mb-3">
                            <label for="staticEmail" class="col-sm-5 col-form-label"><b>Target group: </b></label>
                            <div>
                                <label style="border: 0;"><?php echo $consult2; ?></label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="staticEmail" class="col-sm-5 col-form-label"><b>Email template: </b></label>
                            <div>
                                <label style="border: 0;"><?php echo $consult00; ?></label>
                            </div>
                        </div>

                    </div>
                </td>
                <td>
                    <div style="padding-left:3%;padding-bottom:8%;">
                        <div class="mb-3">
                            <label for="staticEmail" class="col-sm-5 col-form-label"><b>URL Phishing: </b></label>
                            <div>
                                <label style="border: 0;"><a href="<?php echo 'http://' . $_resultado ?>" target="blank"><?php echo $_resultado; ?></a></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="staticEmail" class="col-sm-5 col-form-label"><b>Total targets : </b></label>
                            <div>
                                <label style="border: 0;"><?php echo $user_count; ?></label>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table>
        <tbody>
            <tr>
                <td>
                    <div id="piechart_3d_2" style="width: 450px; height: 300px;"></div>
                </td>
                <td>
                    <div id="piechart_3d_1" style="width: 450px; height: 300px;"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%">
        <tbody>
            <tr>
                <td>
                    <div style="padding-left:3%"><strong>Password Exposed:</strong> <input id="passcount" style="color:red;border: 0"></div>
                    <div style="padding-left:3%"><strong>Password not exposed: </strong><input id="passnocount" style="color:green;border: 0"></div>
                </td>
                <td>
                    <div style="padding-left:3%"><strong>Link clicked: </strong><input id="clickcount" style="color:orange;border: 0"></div>
                    <div style="padding-left:3%"><strong>Link not clicked:</strong> <input id="clicknocount" style="color:green;border: 0"></div>
                </td>
            </tr>
        </tbody>
    </table>


    <hr>


    <div style="margin: 3%">
        <h3 id="link_clicked_count"></h3>
        <table class="table table-hover">
            <thead>
                <tr id="table_email_2">
                    <th scope="col">Email Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($attack_exist) {
                    $stmt = $conexion->prepare('select user.id, user.uid,email_address, email_sent, link_clicked, password_seen from phishing.user JOIN phishing.attack_user ON user.uid = attack_user.user_uid where attack_id=?');
                    $stmt->execute([$attack_id]);
                    $roww = $stmt->fetchAll();

                    foreach ($roww as $row) {

                        $email_ad = $row['email_address'];

                        if ($row["link_clicked"] == 0) {
                            $click = 'no';
                            $clickno_counts++;
                        } else {
                            $click = 'yes';
                            $click_counts++;
                        }
                        if ($row["password_seen"] == 0) {
                            $pass = 'no';
                            $passno_counts++;
                        } else {
                            $pass = 'yes';
                            $pass_counts++;
                        }

                        if ($row["link_clicked"] == 1) {
                            echo "<tr><td>" . $email_ad . "</td>";
                        }
                    }
                }

                ?>
            </tbody>
        </table>
    </div>


    <div style="margin: 3%">
        <h3 id="password_exposed_count"></h3>
        <table class="table table-hover">
            <thead>
                <tr id="table_email_1">
                    <th scope="col">Email Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($attack_exist) {
                    $stmt = $conexion->prepare('select user.id, user.uid,email_address, email_sent, link_clicked, password_seen from phishing.user JOIN phishing.attack_user ON user.uid = attack_user.user_uid where attack_id=?');
                    $stmt->execute([$attack_id]);
                    $roww = $stmt->fetchAll();

                    foreach ($roww as $row) {

                        $email_ad = $row['email_address'];

                        if ($row["password_seen"] == 1) {
                            echo "<tr><td>" . $email_ad . "</td>";
                        }
                    }
                }

                ?>
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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="assets/js/toastr.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Phishing'],
                ['', 0],
                ['Password exposed', <?php echo $pass_counts; ?>],
                ['', 0],
                ['Password not exposed', <?php echo $passno_counts; ?>]
            ]);

            var options = {
                title: 'Password Exposed',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_2'));
            chart.draw(data, options);
            document.getElementById('passcount').value = <?php echo $pass_counts ?>;
            document.getElementById('passnocount').value = <?php echo $passno_counts ?>;

            document.getElementById("password_exposed_count").innerHTML = "Password exposed: <?php echo $pass_counts ?>";

            var pass_exp = <?php echo $pass_counts; ?>

            if (pass_exp == 0) {
                $('#table_email_1').hide();
            }
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
                ['', 0],
                ['Link clicked', <?php echo $click_counts; ?>],
                ['Link not opened', <?php echo $clickno_counts; ?>]
            ]);

            var options = {
                title: 'Phishing Status - Links opened',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_1'));
            chart.draw(data, options);
            document.getElementById('clickcount').value = <?php echo $click_counts ?>;
            document.getElementById('clicknocount').value = <?php echo $clickno_counts ?>;

            document.getElementById("link_clicked_count").innerHTML = "Link clicked: <?php echo $click_counts ?>";

            var click_count = <?php echo $click_counts; ?>

            if (click_count == 0) {
                $('#table_email_2').hide();
            }
        }
    </script>

    <script>
        $("#formulario").submit(function(event) {
            event.preventDefault(); //almacena los datos sin refrescar el sitio web

            var datos = $("#formulario").serialize(); //toma los datos "name" y los lleva a un arreglo

            $.ajax({
                type: "post",
                url: "send_email.php",
                data: datos,
                beforeSend: function() {

                    toastr["success"]("Sending emails...", "Attack in progess");

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                    setTimeout(() => {
                        console.log("Esperando 7 segundos");
                        location.reload();
                    }, 7000);


                },
                /*    success: function(texto) {

                        var result = texto.trim();

                        if (result == "ok") {
                            console.log("Mensajes enviados!");

                        } else {
                            console.log("Mensajes no enviados!!");

                        }
                    }*/
            })


        })
    </script>
    <script>
        $('#button_print').click(function() {
            $('#navbartoggler').hide();
            window.print();
        });
    </script>

</body>

</html>