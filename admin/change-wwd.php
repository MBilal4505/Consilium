<?php
 	require_once 'check_admin.php';
   require_once '../connections/connection.php';
 	$message = "";
 	if (isset($_POST['acc_submit'])) {
 		$heading = $_POST['heading'];
 		$content = $_POST['acc_content'];
 		$query = "INSERT INTO wwd_accordion VALUES ('','{$heading}', '{$content}')";
 		if($result = mysqli_query($con, $query)) {
 			header('change-wwd.php');
 			$acc_message = "Entered";
 		}
 		else {
 			$acc_message = "Error Occured";
 			echo mysqli_error($con);
 		}
 	}
 	if (isset($_POST['submit'])) {


 		$query = "SELECT * FROM wwd";
	 	$result = mysqli_query($con, $query);
	 	$record = mysqli_fetch_array($result);
	 	$row_count = mysqli_num_rows($result);

	 	if($row_count > 0) {
	 		$content = $_POST['content'];
	 		$content = str_replace("'", "\'", $content);
	 		$query = "UPDATE wwd SET content= '$content' WHERE wwd_id = 6";
	 		if($result = mysqli_query($con, $query)) {
	 			header("change-wwd.php");
	 			$message = "Updated";
	 		}
	 		else {
	 			$message = "Error Occured";
	 			echo mysqli_error($con);
	 		}
	 	}
	 	else {
	 		$content = $_POST['content'];
	 		$content = str_replace("'", "\'", $content);
	 		$query = "INSERT INTO wwd VALUES ('', '{$content}')";
	 		if($result = mysqli_query($con, $query)) {
	 			header("change-wwd.php");
	 			$message = "Entered";
	 		}
	 		else {
	 			$message = "Error Occured";
	 			echo mysqli_error($con);
	 		}
	 	}
 	}

 	$acc_query = "SELECT * FROM wwd_accordion";
	$acc_result = mysqli_query($con, $acc_query);
	$acc_record = mysqli_fetch_array($acc_result);
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Consultancy: Write Article</title>
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/custom.min.css">

	<script src="../assets/js/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.on( 'instanceCreated', function( event ) {
			var editor = event.editor,
				element = editor.element;
			if ( element.is( 'h1', 'h2', 'h3' ) || element.getAttribute( 'id' ) == 'taglist' ) {
				editor.on( 'configLoaded', function() {
					editor.config.removePlugins = 'colorbutton,find,flash,font,' +
						'forms,iframe,image,newpage,removeformat,' +
						'smiley,specialchar,stylescombo,templates';
					editor.config.toolbarGroups = [
						{ name: 'editing',		groups: [ 'basicstyles', 'links' ] },
						{ name: 'undo' },
						{ name: 'clipboard',	groups: [ 'selection', 'clipboard' ] },
						{ name: 'about' }
					];
				});
			}
		});
	</script>
</head>
<body>
	<?php require_once('admin-header.html') ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="admin-hyperlink">
					<a href="index.php">
						<button class="btn btn-consilium-o-back"><i class="fa fa-chevron-left"></i></button>
					</a>
					<a style="float: right;" href="../what-we-do.php">
						<button class="btn btn-consilium-o-back">View "What We Do"</button></a>
				</div>
				<h3>
					<?php echo $message ?>
				</h3>
				<!-- <form class="form" method="post" action="change-wwd.php" name="change-wwd">
					<div class="form-group">
						<label for="content">Write Here</label>
						<textarea rows="10" class="form-control" name="content" id="content"><?php echo $previous['content'] ?></textarea>
						<script type="text/javascript">
						CKEDITOR.replace( 'content' );
						</script>
						<textarea contenteditable="true" rows="10" class="form-control" name="content"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Submit" name="submit">
					</div>
				</form> -->
				<h1 class="text-center">Add New Accordion In "What We Do"</h1>
				<p></p>
				<form class="form" method="post" action="change-wwd.php" name="change-accordion">
					<div class="form-group">
						<label for="heading">Heading</label>
						<input type="text" class="form-control" name="heading" id="heading">
					</div>
					<div class="form-group">
						<label for="acc_content">Content</label>
						<textarea rows="10" class="form-control" name="acc_content" id="acc_content"></textarea>
						<script type="text/javascript">
						CKEDITOR.replace('acc_content');
						</script>
					</div>
					<div class="form-group">
						<input type="submit" value="Submit" name="acc_submit">
					</div>
				</form>
				<h1 class="text-center">Modify Accordions</h1>
				<table class="table table-striped">
					<tr class="text-center">
						<th>No.</th>
						<th>Heading</th>
						<th colspan="2">Actions</th>
					</tr>
					<?php $j=0; do { $j++ ?>
						<tr>
							<td><?php echo $j ?></td>
							<td><?php echo $acc_record['dc_heading']; ?></td>
							<td><a href="wwd-actions/wwd-update.php?uid=<?php echo $acc_record['dc_id'] ?>"> Update</a></td>
							<td><a href="wwd-actions/wwd-delete.php?did=<?php echo $acc_record['dc_id'] ?>"> Delete</a></td>
						</tr>
					<?php } while ( $acc_record = mysqli_fetch_array($acc_result)); ?>

				</table>
			</div>
		</div>


	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
	<!--<script type="text/javascript" src="js/jquery-te-1.4.0.min.js" charset="utf-8"></script>

	<script>
		$('.jqte-text').jqte();

		// settings of status
		var jqteStatus = true;
	</script>
	-->

</body>
</html>
