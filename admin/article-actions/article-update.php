<?php session_start(); ?>
<?php require_once '../check_admin.php'; ?>
<?php require_once '../../connections/connection.php'; ?>
<?php
	$uid = $_GET['uid'];
	$article_query = "SELECT * FROM gallery WHERE g_id='$uid'";
	$article_result = mysqli_query($con, $article_query);
	$article_row = mysqli_fetch_array($article_result);
	if(isset($_POST['totem-that'])) {
		$valid_types = array('jpeg','jpg','JPG','JPEG','png','PNG');
		$image = $_FILES['image']['name'];
		if($image != "") {
			list($filename,$extension) = explode('.', $image);
		}
		$size = $_FILES['image']['size'];
		$type = $_FILES['image']['type'];
		$tmp = $_FILES['image']['tmp_name'];
		$g_type = "article";
		if($size < 50 * 1024 * 1024) {
			if($image != "") {
				if(in_array($extension, $valid_types)) {
					$target = '../../gallery/images/'.$image;
					if(move_uploaded_file($tmp, $target)) {
						$title = $_POST['article-title'];
						$content = $_POST['content'];
						$date = date('d-m-Y');
						$author = $_SESSION['username'];
						$query = "UPDATE gallery SET g_title='$title', g_content='$content', g_alt='$image', g_image='$image', g_date='$date', g_author='$author', g_type='$g_type' WHERE g_id='$uid';";
						if($result = mysqli_query($con, $query)) {
							header('Location: ../../features-videos.php');
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
		$message = "No totem identified";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Admin - Manage Articles</title>
    <link rel="stylesheet" href="../../assets/css/custom.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<script src="../../assets/js/ckeditor/ckeditor.js"></script>
	<div class="container" style="margin-top: 20px;" >
		<h1 class="admin-heading">Add Article</h1>
		<form class="form-horizontal" role="form" enctype="multipart/form-data" action="article-update.php?uid=<?php echo $uid; ?>" method="post" name="form-article" id="form-article">
		  	<div class="form-group">
		    	<label for="title" class="col-sm-2 control-label">Title</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="article-title" name="article-title" placeholder="Enter Heading." value="<?php echo $article_row['g_title'] ?>">
		    	</div>
		  	</div>
		  	<div class="form-group">
				<label for="content" class="col-sm-2 control-label">Write Here</label>
				<div class="col-sm-10">
					<textarea rows="10" class="form-control ckeditor" name="content" id="content"><?php echo $article_row['g_content'] ?></textarea>
				</div>
		
			</div>
			<div class="form-group">
		    	<label for="file" class="col-sm-2 control-label">Browse File</label>
		    	<div class="col-sm-10">
		      		<div class="col-sm-4">
		      			<input type="file" id="image" name="image" placeholder="Browse for the image.">
		      		</div>
		      		<div class="col-sm-8">
		      			<span style="vertical-align: top; margin-right: 20px;">Currently Selected Image</span>
		      			<img style="width: 400px;" src="../../gallery/images/<?php echo $article_row['g_image'] ?>" alt="" />
		      		</div>
		    	</div>
		  	</div>
			<div class="form-group">
		    	<div class="col-sm-offset-2 col-sm-10">
		    		<button type="submit" class="btn btn-default">Submit</button>
		    		<input type="hidden" value="article" name="totem-that">
		    	</div>
			</div>
		  	
		</form>
	</div>
</body>
</html>