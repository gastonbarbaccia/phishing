<?php
require_once 'dbconexion.php';

$id = $_GET['id'];
$cons1 = "SELECT group_id FROM phishing.campaign where id = ? ";
$con1 = $conexion->prepare($cons1);
$con1->execute([$id]);
$group_id = $con1->fetchColumn();

//print_r("Id del grupo ".$group_id);

$cons22 = "SELECT creado FROM phishing.attack JOIN phishing.campaign ON attack.campa_id = campaign.id WHERE attack.campa_id= ? ORDER BY date_time DESC LIMIT 1";
$con22 = $conexion->prepare($cons22);
$con22->execute([$id]);
$creado = $con22->fetchColumn();

//print_r("Creado ".$group_id);

$cons21 = "SELECT attack.id FROM phishing.attack JOIN phishing.campaign ON attack.campa_id = campaign.id WHERE attack.campa_id= ? ORDER BY attack.id DESC LIMIT 1";
$con21 = $conexion->prepare($cons21);
$con21->execute([$id]);
$attack_id = $con21->fetchColumn();

if ($creado == 0) {
    $creado = 1;
    $sql1 = "INSERT INTO phishing.attack (mygroup_id, campa_id,creado) VALUES (?,?,?)";
    $conexion->prepare($sql1)->execute([$group_id, $id, $creado]);

    $attack_id = $conexion->lastInsertId();

    $sql3 = "SELECT uid FROM phishing.user JOIN phishing.group_user ON user.id = group_user.user_id WHERE group_id= ?";
    $con2 = $conexion->prepare($sql3);
    $con2->execute([$group_id]);
    $user_id = $con2->fetchAll();

    foreach ($user_id as $uid) {
        $sql2 = "INSERT INTO phishing.attack_user (attack_id, user_uid) VALUES (?,?)";
        $conexion->prepare($sql2)->execute([$attack_id, $uid[0]]);
    }
}


$click_counts = 0;
$pass_counts = 0;
$clickno_counts = 0;
$passno_counts = 0;


$id = $_GET['id'];
$cons = "SELECT name FROM phishing.campaign where id = ? ";
$con = $conexion->prepare($cons);
$con->execute([$id]);
$consult = $con->fetchColumn();

$cons = "SELECT mygroup.name FROM phishing.mygroup JOIN phishing.campaign ON mygroup.id = campaign.group_id WHERE campaign.id=? ";
$con = $conexion->prepare($cons);
$con->execute([$id]);
$consult2 = $con->fetchColumn();

$cons00 = "SELECT email_template.name FROM phishing.email_template join phishing.campaign on email_template.id = campaign.email_template_id where campaign.id = ? ";
$con00 = $conexion->prepare($cons00);
$con00->execute([$id]);
$consult00 = $con00->fetchColumn();

$id = $_GET['id'];
$cons1 = "SELECT date_time FROM phishing.attack JOIN phishing.campaign ON campa_id = campaign.id WHERE campaign.id=? ORDER BY date_time DESC LIMIT 1";
$con1 = $conexion->prepare($cons1);
$con1->execute([$id]);
$consult1 = $con1->fetchColumn();


?>

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
    <link rel="stylesheet" href="assets/css/font-awesome.min.css"> 

</head>




<body>

    <?php

    include 'layouts/nav.php';

    ?>

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
                <td >
                    <div style="padding-left:3%;padding-bottom:1%;">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label"><b>Campaign: </b></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="campaign_name" value="<?php echo $consult; ?>" readonly disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="color:red"><b>Launched: </b></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="email_template" name="email_template" value="<?php echo $consult1; ?>" readonly disabled>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div style="padding-left:10%;padding-bottom:13%;">
                        <div class="mb-3 row" style="padding-left:20%;">
                            <button class="btn btn-danger" style="width: 50%;"><i class='fa fa-bullseye' aria-hidden='true' style='font-size:20px;'></i> Launch Attack!</button>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

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
    <div style="padding-left:1%">

        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label"><b>Target group: </b></label>
            <div class="col-sm-5" style="margin-left:-7%">
                <input type="text" class="form-control" id="target_group" name="target_group" value="<?php echo $consult2; ?>" readonly disabled>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label"><b>Email template: </b></label>
            <div class="col-sm-5" style="margin-left:-7%">
                <input type="text" class="form-control" id="email_template" name="email_template" value="<?php echo $consult00; ?>" readonly disabled>
            </div>
        </div>



    </div>
    <div style="margin: 3%">
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th scope="col">Victim UID</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Email sent?</th>
                    <th scope="col">Link clicked?</th>
                    <th scope="col">Password seen?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conexion->prepare('select user.id, user.uid,email_address, email_sent, link_clicked, password_seen from phishing.user JOIN phishing.attack_user ON user.uid = attack_user.user_uid where attack_id=?');
                $stmt->execute([$attack_id]);
                $roww = $stmt->fetchAll();

                foreach ($roww as $row) {

                    //enviar email
                    //hacer un update del email_sent

                    $mail->Subject = 'Here is the subject';
                    $mail->addAddress($row["email_address"], '');

                    $mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
                                    <p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>";

                    $mail->Body = $mailContent;

                    $user_uid = $row["uid"];

                    if ($row["email_sent"] == 0) {
                        $sent = 'no';
                    } else {
                        $sent = 'yes';
                    }
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

                    $id = $row["id"];

                    echo "<tr>" .
                        "<td><a href='campaing_password_details.php?user_id=$id'>" . $row["uid"] . "</a></td>" .
                        "<td>" . $row["email_address"] . "</td>" .
                        "<td>" . $sent . "</td>" .
                        "<td>" . $click . "</td>" .
                        "<td>" . $pass . "</td>" .
                        "</tr>";
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
        }
    </script>
</body>

</html>