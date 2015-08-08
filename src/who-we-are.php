<?php session_start(); ?>
<?php
require_once 'connections/connection.php';

$query = "SELECT * FROM wwa";
$result = mysqli_query($con, $query);
$record = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" href="assets/img/Consilium.svg">
	<title>Consilium - Who we are</title>
	<link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="./assets/css/custom.min.css" />

</head>
<body class="wwa-body">
	<?php require_once('includes/header.html') ?>
	<div class="c-container">
		<?php
		require_once 'includes/curPageScript.php';
		if (isset($_SESSION['username']) && $_SESSION['access'] === "admin") {
			?>
			<div id="edit-page" class="pull-right">
				<a href="redirect-to.php?redirect-to=<?php echo curPageName(); ?>">Edit Page</a> | <a href="admin/index.php">Admin Panel</a>
			</div>
			
			<?php
		}
		?>
		<div class="banner">
			<div class="main-image-overlay">
				<div class="banner-word">"We aim to develop the leaders of today to change the world tomorrow."</div>
			</div>
		</div>
		<div class="container">
			<div class="heading-container">
		      <h2>Who We Are</h2>
		      <div style="position: relative"><hr class="fancy-line"></div>
		    </div>
			<?php echo $record['content'] ?>
			<div class="heading-container">
		      <h2>Founder's Intro</h2>
		      <div style="position: relative"><hr class="fancy-line"></div>
		    </div>
			<?php echo $record['ceo'] ?>
			<!--<div>
				<img class="img-responsive img-circle" src="gallery/images/<?php echo $record['img'] ?>" style="float:right; width: 340px; height: auto; margin-top: 4px; margin-bottom: 14px; margin-left: 16px">
				
			</div>-->
		
		
		</div>
	</div>
	<?php require_once 'includes/footer.html'; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
