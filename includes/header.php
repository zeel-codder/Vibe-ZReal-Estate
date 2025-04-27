<?php
require_once "includes/session_check.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Real Estate Management System</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="Real Estate Management System">

<!-- Adding Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="assets/style.css"/>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/modern-style.css"/>
<link rel="stylesheet" href="css/property-cards.css"/>
<link rel="stylesheet" href="css/property-detail.css"/>
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/notifications.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<script src="assets/jquery-1.9.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>
<script src="assets/script.js"></script>
<script src="js/auth.js"></script>

<link rel="stylesheet" href="assets/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="assets/owl-carousel/owl.theme.css">
<script src="assets/owl-carousel/owl.carousel.js"></script>

<link rel="stylesheet" type="text/css" href="assets/slitslider/css/style.css" />
<link rel="stylesheet" type="text/css" href="assets/slitslider/css/custom.css" />
<script type="text/javascript" src="assets/slitslider/js/modernizr.custom.79639.js"></script>
<script type="text/javascript" src="assets/slitslider/js/jquery.ba-cond.min.js"></script>
<script type="text/javascript" src="assets/slitslider/js/jquery.slitslider.js"></script>

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-home"></i> Real Estate
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'list-properties.php') echo 'class="active"'; ?>><a href="list-properties.php"><i class="fas fa-list"></i> Properties</a></li>
                <li class="dropdown <?php if(in_array(basename($_SERVER['PHP_SELF']), ['sale.php', 'rent.php'])) echo 'active'; ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-building"></i> Categories <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li <?php if(basename($_SERVER['PHP_SELF']) == 'sale.php') echo 'class="active"'; ?>><a href="sale.php"><i class="fas fa-tag"></i> For Sale</a></li>
                        <li <?php if(basename($_SERVER['PHP_SELF']) == 'rent.php') echo 'class="active"'; ?>><a href="rent.php"><i class="fas fa-key"></i> For Rent</a></li>
                    </ul>
                </li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'search.php') echo 'class="active"'; ?>><a href="search.php"><i class="fas fa-search"></i> Search</a></li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="active"'; ?>><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'class="active"'; ?>><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php 
                echo getLoginLogoutButton();
                ?>
            </ul>
        </div>
    </div>
</nav>

<div style="padding-top: 30px;"></div>
</body>
</html>