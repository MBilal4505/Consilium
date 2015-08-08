<?php session_start(); ?>
<?php require_once 'check_admin.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Admin - Insert Stuff</title>
    <link rel="stylesheet" href="../assets/css/custom.min.css" />
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<?php require_once('admin-header.html') ?>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="admin-hyperlink">
					<a href="index.php">
						<button class="btn btn-consilium-o-back"><i class="fa fa-chevron-left"></i></button>
					</a>
					<a style="float: right;" href="../features-videos.php">
						<button class="btn btn-consilium-o-back">View "Features & Videos"</button></a>
				</div>
			</div>
		</div>
		<div class="container" style="margin-top: 20px;" align="center">
			<a href="add-article.php">
				<button class="btn btn-consilium-o-green">Manage Articles</button>
			</a>
			<a href="add-video.php">
				<button class="btn btn-consilium-o-green">Manage Videos</button>
			</a>
		</div>
	</div>
</body>
</html>
