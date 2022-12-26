<?php

include 'constants.php';

$url = $public_url;
?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php"><img src="assets/img/logo.png" width="100px" height="50px"> Phishing Platform</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <?php

        include 'layouts/navbar_base.php';

        ?>
      </div>
    </div>
  </div>
</nav>