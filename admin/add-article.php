<?php session_start(); ?>
<?php require_once 'check_admin.php'; ?>
<?php require_once '../connections/connection.php'; ?>
<?php
	$message = "";
	$article_query = "SELECT * FROM gallery WHERE g_type='article'";
	$article_result = mysqli_query($con, $article_query);
	$article_record = mysqli_fetch_array($article_result);
	if(isset($_POST['totem-that'])) {
		$valid_types = array('jpeg','jpg','JPG','JPEG','png','PNG');
		$image = $_FILES['image']['name'];
		
		if($image != "") {
			list($filename,$extension) = explode('.', $image);
		}
		$size = $_FILES['image']['size'];
		$type = $_FILES['image']['type'];
		$tmp = $_FILES['image']['tmp_name'];
		list($width, $height) = getimagesize($tmp);
		$ratio = $width / $height;
		if ($ratio < 1.65) {
			$g_type = "article";
			if($size < 50 * 1024 * 1024) {
				if($image != "") {
					if(in_array($extension, $valid_types)) {
						$target = '../gallery/images/'.$image;
						if(move_uploaded_file($tmp, $target)) {
							$title = $_POST['article-title'];
							$content = $_POST['content'];
							$date = date('d-m-Y');
							$author = $_SESSION['username'];
							$query = "INSERT INTO gallery VALUES ('', '$title', '$content', '$image', '$image', '$date', '$author', '', '$g_type');";
							if($result = mysqli_query($con, $query)) {
								header('Location: ../features-videos.php');
								$message = "Image Uploaded";
							}
							else {
								$message = "Error Occured";
								echo mysqli_error($con);
							}
						}
					}
					else {
						$message = "Invalid image format.";
					}
				}
			}
			else {
				$message = "Image size is too large. Max limit is 5MB";
			}
		}
		else {
			$message = "Please provide an image with aspect ratio 4:3 or 3:2.";
		}
	}
	else {
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Admin - Manage Articles</title>
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/custom.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<?php require_once('admin-header.html') ?>
	<script src="../assets/js/ckeditor/ckeditor.js"></script>
	<div class="container" style="margin-top: 20px;" >
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="admin-hyperlink">
					<a href="insert-gallery.php">
						<button class="btn btn-consilium-o-back"><i class="fa fa-chevron-left"></i></button>
					</a>
					<a style="float: right;" href="../features-videos.php">
						<button class="btn btn-consilium-o-back">View "Features & Videos"</button></a>
				</div>
				<h1 class="admin-heading">Add Article</h1>
				<h4><?php echo $message ?></h4>
				<form class="form-horizontal" role="form" enctype="multipart/form-data" action="add-article.php" method="post" name="form-article" id="form-article">
					
				  	<div class="form-group">
				    	<label for="title" class="col-sm-2 control-label">Title</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="article-title" name="article-title" placeholder="Enter Heading.">
				    	</div>
				  	</div>
				  	<div class="form-group">
						<label for="content" class="col-sm-2 control-label">Write Here</label>
						<div class="col-sm-10">
							<textarea rows="10" class="form-control ckeditor" name="content" id="content"></textarea>
						</div>
				
					</div>
					<div class="form-group">
				    	<label for="file" class="col-sm-2 control-label">Browse Image</label>
				    	<div class="col-sm-10">
				      		<input type="file" id="image" name="image" placeholder="Browse for the image.">
				      		<span>Please provide image with ratio 4:3. Square or portrait images will not look good at all.</span>
				    	</div>
				  	</div>
					<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-10">
				    		<button type="submit" class="btn btn-default">Submit</button>
				    		<input type="hidden" value="article" name="totem-that">
				    	</div>
					</div>
				  	
				</form>
				<h1 class="admin-heading">Manage Articles</h1>
				<table class="table table-striped">
					<tr class="text-center">
						<th>No.</th>
						<th>Heading</th>
						<th colspan="2">Actions</th>
					</tr>
					<?php $j=0; do { $j++ ?>
						<tr>
							<td><?php echo $j ?></td>
							<td><?php echo $article_record['g_title']; ?></td>
							<td><a href="article-actions/article-update.php?uid=<?php echo $article_record['g_id'] ?>"> Update</a></td>
							<td><a href="article-actions/article-delete.php?did=<?php echo $article_record['g_id'] ?>"> Delete</a></td>
						</tr>
					<?php } while ( $article_record = mysqli_fetch_array($article_result)); ?>

				</table>
			</div>
		</div>
		
	</div>
</body>
</html>