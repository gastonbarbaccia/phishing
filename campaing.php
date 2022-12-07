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

    <form action="index.php" method="POST">
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
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="description">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Active</label>
                    <div class="col-sm-5">
                        <input type="checkbox" id="description" style="margin-top:15px">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Target</label>
                    <div class="col-sm-5">
                        <select type="text" class="form-control" id="openssl_verify_mode">
                            <option>-</option>
                            <option>Target 1</option>
                            <option>Target 2</option>
                            <option>Target 3</option>
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
                        <select type="text" class="form-control" id="template">
                            <option>-</option>
                            <option>Linkedin</option>
                            <option>O365</option>
                            <option>Hotmail</option>
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
                        <input type="text" class="form-control" id="smtp_server">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMPT Username</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_username">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMPT Password</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_password">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">SMPT Port</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="smtp_port">
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
                        <input type="text" class="form-control" id="subject">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">From</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="from">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Display</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="display">
                    </div>
                </div>
            </div>
            <div style="padding-left:3%">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Phishing URL</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="phishing_URL">
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-left:3%;margin-bottom:5%">
            <button class="btn btn-primary">Create campaign</button>
        </div>
    </form>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>