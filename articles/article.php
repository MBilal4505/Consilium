<?php require_once '../connections/connection.php'; ?>
<?php 
	if(isset($_GET['article'])) {
		$article_id = $_GET['article'];

		$query = "SELECT * FROM gallery WHERE g_id = $article_id AND g_type='article'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		$num_rows = mysqli_num_rows($result);
		if($num_rows > 0) {
			$date = $row['g_date'];
			$title = $row['g_title'];
			$content = $row['g_content'];
			$author = $row['g_author'];
			$image = $row['g_image'];
			$alt = $row['g_alt'];
		}
		else {
			echo "Error Occured";
			echo mysqli_error($con);
		}
		$extra_query = "SELECT * FROM gallery WHERE g_type='article' ORDER BY RAND() LIMIT 10";
		$extra_result = mysqli_query($con, $extra_query);
		$extra_row = mysqli_fetch_array($extra_result);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Consilium - <?php echo $title ?></title>
    <link rel="shortcut icon" href="../assets/img/Consilium.svg">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../assets/css/articles.min.css" />
</head>
<body id="article-body">
	<?php require_once('includes/header.html') ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="heading-container">
					<h2><?php echo $title ?></h2>
					<div style="position: relative"><hr class="fancy-line"></div>
				</div>
				<p class="col-sm-3">Created on: <?php echo $date ?></p>
				<p class="col-sm-3 col-sm-offset-6 text-right">By: <?php echo $author ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-9 content-container">
				<?php if($image !== "") { ?>
				<img src="../gallery/images/<?php echo $image ?>" class="img-responsive a-img">
				<?php } ?>
				<div class="content">
					<?php echo $content ?>
				</div>
			</div>
			<div class="col-lg-3 more-articles">
				<h4>You might also like...</h4>
				<ul>
					<?php do { ?>
						<li class="">
		                    <a href="article.php?article='<?php echo $extra_row['g_id'] ?>'">
		                    	<?php if($extra_row['g_image'] !== "") {?>
		                    	<img class="img-responsive thumbnail" src="../gallery/images/<?php echo $extra_row['g_image'] ?>"/>
		                    	<?php } else { ?>
		                    	<img class="img-responsive thumbnail" src="../gallery/images/default.png"/>
		                    	<?php } ?>
		                    </a>
		                </li>
					<?php }while($extra_row = mysqli_fetch_array($extra_result)) ?>
				</ul>
			</div>
			
		</div>
	</div>
	<?php require_once 'includes/footer.html'; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>