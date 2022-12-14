<?php
require_once 'dbconexion.php' ;
$id = $_GET['id'];

$grup = $conexion->prepare("SELECT name FROM phishing.mygroup");
$grup->execute();
$data = $grup->fetchAll();

$smt = $conexion->prepare("SELECT * FROM phishing.campaign  join phishing.email_settings on  campaign.id = email_settings.campaign_id where campaign.id = ?");
$smt->execute([$id]);
$row = $smt->fetch();
    $server = $row['smtp_server'];
    $name =$row['smtp_username'];
    $pass = $row['smtp_password'];
    $port = $row['smtp_port'];
    $subj = $row['subject'];
    $from = $row['email_from'];
    $display = $row['display'];
    $url = $row['phishing_url'];
    $cid = $row['campaign_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Campaing</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

    <form action="recibe_edit_campaign.php" method="POST">
        <br>
        <div>
            <div style="padding-left:3%">
                <h3>New Campaing</h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="campaign_name" value="<?php echo $row['name']?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="description" name="campaign_description" value="<?php echo $row['description']?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Active</label>
                    <div class="col-sm-5">
                        <input type="checkbox" id="is_active" style="margin-top:15px" name="is_active" <?php if($row['is_active'] !== null){echo "checked";}?>>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Target</label>
                    <div class="col-sm-5">
                        <select name="group" type="text" class="form-control" id="openssl_verify_mode">
                        <?php foreach ($data as $row): ?>
                            <option><?=$row["name"]?></option>
                        <?php endforeach
                        ?>
                    </select>
                    </div>
                </div>
            </div>
        </div>

        <!--Template selection-->

        <br>
        <div>
            <div style="padding-left:3%">
                <h3>Template selection</h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Template Email</label>
                    <div class="col-sm-5">
                        <select name="template" type="text" class="form-control" id="template">
                            <?php 
                            //traer el template seleccionado en la campaña ya creada
                            $smt1 = $conexion->prepare("SELECT name FROM phishing.email_template");
                            $smt1->execute();
                            $data1 = $smt1->fetchAll();
                            foreach ($data1 as $row): ?>
                                <option><?=$row["name"]?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!--STMP Settings-->

        <br>
        <div>
            <div style="padding-left:3%">
                <h3>STMP Settings</h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMPT Server</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_server" name="server" value="<?php  echo $server?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMPT Username</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_username" name="username" value="<?php echo $name;?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMPT Password</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_password" name="passw" value="<?php echo $pass;?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMPT Port</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_port" name="port" value="<?php echo $port;?>">
                    </div>
                </div>
            </div>

        </div>
        <!--Email Settings-->

        <br>
        <div>
            <div style="padding-left:3%">
                <h3>Email Settings</h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $subj ;?>">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="from" name="from" value="<?php echo $from ;?>">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Display</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="display" name="display" value="<?php echo $display;?>">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Phishing URL</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="phishing_URL" name="phishing_URL" value="<?php echo $url;?>">
                    </div>
                </div>
            </div>
        </div>
        <input type="text" name="id" value="<?php echo $cid ?>" readonly hidden>
        <div style="padding-left:3%;margin-bottom:5%">
            <button class="btn btn-primary">Edit campaign</button>
        </div>
    </form>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>