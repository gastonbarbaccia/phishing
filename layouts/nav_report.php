
<?php

include 'constants.php';

$url = $public_url;

?>

<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" width="100px" height="50px"> Phishing Platform</a>
            <button id="navbartoggler" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup" name="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="<?php echo $url.'/phishingBE/index.php'?>">Dashboard</a>
                    <a class="nav-link" href="<?php echo $url.'/phishingBE/campaing.php'?>">Campaings</a>
                    <a class="nav-link" href="<?php echo $url.'/phishingBE/users_groups.php'?>">Users & Groups</a>
                    <a class="nav-link" href="<?php echo $url.'/phishingBE/email_templates.php'?>">Email template</a>
                    <a class="nav-link" href="<?php echo $url.'/phishingBE/phishing_url_templates.php'?>">Phishing URL</a>
                    <button class="btn btn-secondary" style="margin-left: 200px;" id="button_print'?>"><i class='fa fa-print' aria-hidden='true' style='font-size:20px;padding-right:10px'></i> Print report</button>
                </div>
            </div>
        </div>
    </nav>
