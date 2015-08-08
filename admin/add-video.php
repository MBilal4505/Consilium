<?php require_once 'check_admin.php'; ?>
<?php require_once '../connections/connection.php'; ?>
<?php
	$message="";
	$date="";
	$video_query = "SELECT * FROM gallery WHERE g_type='video'";
	$video_result = mysqli_query($con, $video_query);
	$video_record = mysqli_fetch_array($video_result);
	if (isset($_GET['status'])) {

		$valid_types = array('mp4','flv','MP4','FLV');
		$video = $_FILES['video-upload']['name'];
		if ($video != "") {
			list($filename,$extension) = explode('.', $video);
		}
		$size = $_FILES['video-upload']['size'];
		$type = $_FILES['video-upload']['type'];
		$tmp = $_FILES['video-upload']['tmp_name'];
		$g_type = "video";
		if($size < (50 * 1024 * 1024)) {
			if ($video != "") {
				if (in_array($extension, $valid_types)) {
					$target = '../gallery/videos/'.$video;
					if (move_uploaded_file($tmp, $target)) {
						$title = $_POST['video-title'];
						// $content = $_POST['description'];
						$date = date('d-m-Y');
						$author = $_SESSION['username'];
						$query = "INSERT INTO gallery VALUES ('', '$title', '', '', '', '$date', '$author', '$video', '$g_type');";
						if ($result = mysqli_query($con, $query)) {
							header('Location: ../features-videos.php');
							$message = "Video Uploaded";
						}
						else {
							$message = "Error Occured";
							echo mysqli_error($con);
						}
					}
				}
				else {
					$message = "Invalid video format.";
				}
			}
		}
		else {
			$message = "Video size is too large. Max limit is 50MB";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Admin - Manage Videos</title>
    <link rel="stylesheet" href="../assets/css/custom.min.css" />
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<?php require_once('admin-header.html') ?>
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
				<h1 class="admin-heading">Add Video</h1>
				<?php echo $message; ?>
				<form class="form-horizontal" role="form" enctype="multipart/form-data" action="add-video.php?status=added" method="post" name="form-video" id="form-video">
				  	<div class="form-group">
				    	<label for="video-title" class="col-sm-2 control-label">Title</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="video-title" name="video-title" placeholder="Enter title of the video.">
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="video-upload" class="col-sm-2 control-label">Browse Video</label>

				    	<div class="col-sm-10">
				      		<input type="file" id="video-upload" name="video-upload" placeholder="Browse for the file.">
				      		<span>MP4 and FLV videos are supported.</span>
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-10">
				    		<button type="submit" class="btn btn-default">Submit</button>
				    		<input type="hidden" value="video" name="totem-this">
				    	</div>
					</div>
				</form>
				<h1 class="admin-heading">Delete Videos</h1>
				<table class="table table-striped">
					<tr class="text-center">
						<th>No.</th>
						<th>Heading</th>
						<th>Actions</th>
					</tr>
					<?php $j=0; do { $j++ ?>
						<tr>
							<td><?php echo $j ?></td>
							<td><?php echo $video_record['g_title']; ?></td>
							
							<td><a href="video-actions/video-delete.php?did=<?php echo $video_record['g_id'] ?>"> Delete</a></td>
						</tr>
					<?php } while ( $video_record = mysqli_fetch_array($video_result)); ?>

				</table>
			</div>
		</div>
		
	</div>
</body>
</html>