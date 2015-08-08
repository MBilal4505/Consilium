<?php
	require_once '../check_admin.php';
 	require_once'../../connections/connection.php';

 	$acc_query = "SELECT * FROM wwd_accordion WHERE dc_id = {$_GET['uid']}";
	$acc_result = mysqli_query($con, $acc_query);
	$acc_record = mysqli_fetch_array($acc_result);

	if(isset($_POST['acc_submit'])) {
		$content = $_POST['acc_content'];
		$heading = $_POST['heading'];
		$query = "UPDATE wwd_accordion SET dc_content='$content',dc_heading='$heading' WHERE dc_id = {$_GET['uid']}";
		if($result = mysqli_query($con, $query)) {
			header("Location: ../change-wwd.php");
		}
		else {
			$message = "Error Occured";
			echo mysqli_error($con);
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Consultancy: Write Article</title>
	<link rel="stylesheet" type="text/css" href="../../assets/css/custom.min.css">
	
	<script src="../../assets/js/ckeditor/ckeditor.js"></script>
	<script>

		// This code is generally not necessary, but it is here to demonstrate
		// how to customize specific editor instances on the fly. This fits well
		// this demo because we have editable elements (like headers) that
		// require less features.

		// The "instanceCreated" event is fired for every editor instance created.
		CKEDITOR.on( 'instanceCreated', function( event ) {
			var editor = event.editor,
				element = editor.element;

			// Customize editors for headers and tag list.
			// These editors don't need features like smileys, templates, iframes etc.
			if ( element.is( 'h1', 'h2', 'h3' ) || element.getAttribute( 'id' ) == 'taglist' ) {
				// Customize the editor configurations on "configLoaded" event,
				// which is fired after the configuration file loading and
				// execution. This makes it possible to change the
				// configurations before the editor initialization takes place.
				editor.on( 'configLoaded', function() {

					// Remove unnecessary plugins to make the editor simpler.
					editor.config.removePlugins = 'colorbutton,find,flash,font,' +
						'forms,iframe,image,newpage,removeformat,' +
						'smiley,specialchar,stylescombo,templates,source';

					// Rearrange the layout of the toolbar.
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

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1 class="text-center">Modify Accordion Content</h1>
				<h3>
				</h3>
				<form class="form" method="post" action="wwd-update.php?uid=<?php echo $_GET['uid'] ?>" name="change-accordion">
					<div class="form-group">
						<label for="heading">Heading</label>
						<input type="text" class="form-control" name="heading" id="heading" value="<?php echo $acc_record['dc_heading'] ?>">
					</div>
					<div class="form-group">
						<label for="acc_content">Content</label>
						<textarea rows="10" class="form-control" name="acc_content" id="acc_content"><?php echo $acc_record['dc_content'] ?></textarea>
						<script type="text/javascript">
						CKEDITOR.replace('acc_content');
						</script>
					</div>
					<div class="form-group">
						<input type="submit" value="Submit" name="acc_submit">
					</div>
				</form>
			</div>
		</div>
		
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>