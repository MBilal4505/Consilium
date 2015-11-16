<?php 
    
    require_once 'phpmailer/PHPMailerAutoload.php';

    $phpmailer = new PHPMailer();

    if(isset($_POST['mm_hidden'])) {
        $sender = $_POST['email'];
        $name = $_POST['name'];
        $message = $_POST['message'];

        $phpmailer->IsSMTP();
        $phpmailer->Host = "smtp.gmail.com";
        $phpmailer->SMTPAuth = true;
        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->Port = 587;
        $phpmailer->Username = "ahmadnauroz@gmail.com";
        $phpmailer->Password = "";

        $phpmailer->From = "thenewdawn1994@hotmail.com";
        $phpmailer->FromName = $name;
        $phpmailer->addAddress('thenewdawn1994@yahoo.com', 'Nauroz Ahmad');
        $phpmailer->addReplyTo('thenewdawn1994@hotmail.com', 'Reply Info');

        $phpmailer->Subject = 'Consultancy Contacted';
        $phpmailer->Body = "Sender Email: " . $sender . " Name: " . $name . "\r\n \r\n" . $message;


        if(!$phpmailer->Send()) {
            echo "Mailer Error: " . $phpmailer->ErrorInfo;

        }
        else {
            header("Location: contact-thanks.php");
        }


    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="assets/img/Consilium.svg">
	<title>Consilium - Contact Us</title>
    <link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/custom.min.css">
</head>
<body class="contact-body">
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
        <div class="container">
            <div class="heading-container">
              <h2>Contact Us</h2>
              <div style="position: relative"><hr class="fancy-line"></div>
            </div>
            <form class="form-horizontal" role="form" name="contact-form" method="post" action="contact.php">
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" placeholder="Your Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="email" class="form-control" name="email" placeholder="Your Email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea rows="10" cols="40" class="form-control" placeholder="Your Message" name="message"></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-consilium-round">Submit</button>
                    <input type="hidden" name="mm_hidden" value="mm_hidden">
                </div>
                
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <?php require_once('includes/footer.html') ?>
</body>
</html>