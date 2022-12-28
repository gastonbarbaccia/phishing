<?php
require_once 'dbconexion.php';

$smt = $conexion->prepare("SELECT name,group_deleted,id FROM phishing.mygroup");
$smt->execute();
$data = $smt->fetchAll();

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

    <form action="recibe_campaign.php" method="POST">
        <br>
        <div>
            <div style="padding-left:3%">
                <h3>New Campaing</h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="campaign_name">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="description" name="campaign_description">
                    </div>
                </div>
             <!--   <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Active</label>
                    <div class="col-sm-5">
                        <input type="checkbox" id="description" style="margin-top:15px" name="is_active" value="1">
                    </div>
                </div>
-->
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Target</label>
                    <div class="col-sm-5">
                        <select name="group" type="text" class="form-control" id="openssl_verify_mode">
                            <?php foreach ($data as $row) : 
                             if($row['group_deleted'] == ''){
                                ?>
                                <option><?= $row["name"] ?></option>
                            <?php 
                            
                             }
                             endforeach 
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
                            $smt1 = $conexion->prepare("SELECT id,name, email_deleted FROM phishing.email_template");
                            $smt1->execute();
                            $data1 = $smt1->fetchAll();
                            foreach ($data1 as $row) : 
                                if($row['email_deleted'] == ''){
                                ?>
                                    <option><?= $row["name"]?></option>
                                <?php
                                }
                            endforeach 
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!--STMP Settings-->

        <br>
        <div>
            <div style="padding-left:3%">
                <h3>SMTP Settings</h3>
            </div>
            <hr>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Server</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_server" name="server" value="in-v3.mailjet.com">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Username</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_username" name="username" value="3aa698d4cd8be5e66d472936cca34626">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="smtp_password" name="passw" value="d5ae76ec81d3c6fd52af3ff04c608960">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMTP Port</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_port" name="port" value="587">
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
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="from" name="from">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Display</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="display" name="display">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Phishing URL</label>
                    <div class="col-sm-5">
                        <select type="text" class="form-control" id="phishing_URL" name="phishing_URL">
                            <?php
                            $smtp2 = $conexion->prepare("SELECT url FROM phishing.phishing_url");
                            $smtp2->execute();
                            $data2 = $smtp2->fetchAll();
                            foreach ($data2 as $row) : ?>
                                <option value="<?= $row["url"] ?>"><?= $row["url"] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-left:3%;margin-bottom:5%">
            <button class="btn btn-primary" style="width:15%;">Create campaign</button>
        </div>
    </form>

    
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
</body>

</html>