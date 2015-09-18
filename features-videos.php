<?php 
if(!isset($_SESSION)) {
	session_start();
}
?>
<?php require_once 'connections/connection.php'; ?>
<?php
		$query = "SELECT COUNT(*) FROM gallery";
		$results = mysqli_query($con, $query);
		$get_total_rows = mysqli_fetch_array($results);
		$items_per_group = 8;
		$total_pages = ceil($get_total_rows[0]/$items_per_group);

	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="assets/img/Consilium.svg">
	<title>Consilium - Features & Videos</title>
	
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
    
    
	<link rel="stylesheet" href="assets/css/custom.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/features.css">
	<script type="text/javascript">
    	$(document).ready(function() {
		    var track_click = 0; //total loaded record group(s)

		    var total_pages = <?php echo $total_pages; ?>

		    $('#gallery').load("includes/autoload_process.php", {'group_no':track_click}, function() {track_click++;}); //load first group

		    $('.load_more').click(function (e) {

		        $(this).hide();
		        $('.animation_image').show(); //show loading image

		            if(track_click <= total_pages) //there's more data to load
		            {
		                //load data from the server using a HTTP POST request
		                $.post('includes/autoload_process.php',{'group_no': track_click}, function(data){

		                    $('.load_more').show();
		                    $('.animation_image').hide(); //hide loading image once data is received
		                    $("#gallery").append(data); //append received data into the element
		                    //hide loading image
		                    
		                    track_click++; //loaded group increment

		                }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?

		                    alert(thrownError); //alert with HTTP error
		                    $('.load_more').show();
		                    $('.animation_image').hide(); //hide loading image
		                });

		            }
		            else{
		                	$('.load_more').attr('disabled', 'disabled');
		                	$('.animation_image').hide();
		                	$('.no-more').show();
		            }
		        });
		});
    </script>
</head>
<body class="features-body">

	<?php require_once 'includes/header.html'; ?>
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
		
		<div class="container">
			<div class="heading-container">
		            <h2>Features & Videos</h2>
		            <div style="position: relative"><hr class="fancy-line"></div>
		      	</div>
			<div class="main" align="center">
				<div class="modal fade" id="myModal" tabindex="99999" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			      	<div class="modal-dialog">
				        <div class="modal-content">
						    <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					    	</div>
				          	<div class="modal-body">
				          	</div>
				        </div>
			    	</div>
			    </div>
		
				<ul id="gallery" class="gallery row">
				</ul>
		
				<div class="animation_image" style="display:none" align="center">
					<img src="assets/img/ajax-loader.gif">
				</div>
				<div align="center">
					<button class="btn btn-consilium-o-blue load_more">Load More</button>
				</div>
				<div class="no-more text-center" style="display:none">
					<h3>No more content to load.</h3>
				</div>
		
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.html' ?>
	<script>
		$('iframe').css('width', '100%');
		$('iframe').css('height', '100%');
	</script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>