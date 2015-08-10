<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Consilium</title>
    <link rel="shortcut icon" href="assets/img/Consilium.svg">
    <link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/custom.min.css" />
</head>
<body id="home-page">
    <?php require_once('includes/header.html') ?>

    <div class="c-container">
        <?php
            require_once 'includes/curPageScript.php';
            if (isset($_SESSION['username']) && $_SESSION['access'] === "admin") {
                ?>
                <div id="edit-page" class="pull-right">
                    <a href="admin/index.php">Admin Panel</a>
                </div>
                
                <?php
            }
        ?>
        
            <div><?php require_once('includes/slider.php') ?></div>
        <div class="special-p" style="text-align: center; font-size: 16px; background-color: #f4a74b; margin-bottom: 50px;" align="center">
            <div class="heading-container">
              <h2>Who We Are</h2>
              <div style="position: relative"><hr class="fancy-line"></div>
            </div>
            <p style="margin-bottom: 32px; color: #000;">
                We aim to help individuals expand their understanding and applications of Leadership, and empower them with new thinking and a process that will enable them to transform themselves and their organisations. Our teaching will serve to expand the definition of what Leadership is, who does it, where, when and how.
            </p>
            <a href="who-we-are.php"><button class="btn btn-consilium-o">More About Us</button></a>
        </div>
            <?php require_once('includes/video-carousel.php') ?>
        <div class="video-slider"><?php require_once 'includes/video.php'; ?></div>
        <div class="heading" style="margin-top: 18px;">
            <h1 class="text-center" style="font-size: 24px;">
                <a href="features-videos.php" style="color: #000;">
                    <button class="btn btn-consilium-o-green" style="font-size: 20px;">
                        More Videos
                    </button>
                </a>
            </h1>
        </div>
        <div class="firm-tiles-container" align="center">
            <ul>
                <li class="firm-tiles">
                    <div class="firm-img-container"><div><img src="assets/img/hbs.png"></div></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </li>
                <li class="firm-tiles">
                    <div class="firm-img-container"><div><img src="assets/img/newcastle.png"></div></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </li>
                <li class="firm-tiles">
                    <div class="firm-img-container"><div><img src="assets/img/capgemini.png"></div></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </li>
                <li style="border-right: none;" class="firm-tiles">
                    <div class="firm-img-container"><div><img src="assets/img/ibm.png"></div></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </li>
            </ul>
        </div>
        
        <?php require_once('includes/footer.html') ?></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/slider-data.js"></script>
    <script type="text/javascript" src="assets/js/main-slider-pause.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
