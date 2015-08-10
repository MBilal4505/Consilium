<?php require_once 'check_admin.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Management Consultancy</title>
	<link rel="stylesheet" href="../assets/css/custom.min.css" />
	<style>
		.container-fluid h3 a:hover {
			opacity: 0.2;
		}
	</style>
</head>
<body>
	<?php include_once 'admin-header.html' ?>
	
	<div class="container-fluid" style="margin-top: 20px">
		<div class="admin-hyperlink" style="min-height: 40px;">
			<a style="float: right;" href="logout.php">
				<button class="btn btn-consilium-o-back">Log Out</button>
			</a>
		</div>
		<h1 class="admin-heading">Admin Panel</h1>
		<h3 class="text-center">
			<a href="admin-users.php">Users</a>
		</h3>
		
		<h3 class="text-center">
			<a href="change-wwd.php">What we do</a>
		</h3>
		<h3 class="text-center">
			<a href="change-wwa.php">Who we are</a>
		</h3>
		<h3 class="text-center">
			<a href="change-wwb.php">Who will benefit</a>
		</h3>
		<h3 class="text-center">
			<a href="change-offering.php">Our Offerings</a>
		</h3>
		<h3 class="text-center">
			<a href="insert-gallery.php">Features and Videos</a>
		</h3>
	</div>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>