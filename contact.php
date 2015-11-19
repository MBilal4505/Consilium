<?php 
    
    require_once 'phpmailer/PHPMailerAutoload.php';

    $phpmailer = new PHPMailer();

    if(isset($_POST['mm_hidden'])) {
        $sender = $_POST['email'];
        $name = $_POST['name'];
        $message = $_POST['message'];
        $subject = $_POST['subject'];

        $phpmailer->IsSMTP();
        $phpmailer->Host = "mail.consiliumleadership.com";
        $phpmailer->SMTPAuth = true;
        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->Port = 26;
        $phpmailer->Username = "hello@consiliumleadership.com";
        $phpmailer->Password = "EJ(nDmpKncs)";

        $phpmailer->From = $sender;
        $phpmailer->FromName = $name;
        $phpmailer->addAddress('info@consiliumleadership.com', 'Consilium Contacted');
        $phpmailer->addReplyTo($sender, 'Reply Info');

        $phpmailer->Subject = $subject;
        $phpmailer->Body = $message;


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
            <div style="margin-bottom: 30px;">
            </div>
            <div class="col-md-4">
            	<h3 style="color: #34ACA0">Get in touch</h3>
            	<table class="table">
            		<tr>
            			<td><i style="color: #34ACA0" class="fa fa-envelope"></i></td>
            			<td>info@consiliumleadership.com</td>
            		</tr>
            		<tr>
            			<td><i style="color: #34ACA0" class="fa fa-phone"></i></td>
            			<td>+44 7780699695</td>
            		</tr>
            		<tr>
            			<td><i style="color: #34ACA0" class="fa fa-location-arrow"></i></td>
            			<td>Consilium, Mallard House, St John’s Wood, London, NW8 7AN</td>
            		</tr>
            	</table>
            	<!-- <h5> info@consiliumleadership.com</h5>
            	<h5> +44 7780699695</h5>
            	<h5> Consilium, Mallard House, St John’s Wood, London, NW8 7AN</h5> -->
            </div>
            <div class="col-md-7 col-md-offset-1">
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
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <?php require_once('includes/footer.html') ?>
</body>
</html>