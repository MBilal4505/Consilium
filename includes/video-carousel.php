<?php
	require_once 'connections/connection.php';

	$query = "SELECT * FROM gallery WHERE g_type = 'embed' ORDER BY g_id DESC LIMIT 5";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$row_num = mysqli_num_rows($result);
?>
<div class="video-carousel">
	<div id="video-carousel" class="carousel slide" data-ride="carousel">
	  	<!-- Indicators -->
		<!-- <ol class="carousel-indicators">
			<?php for($m = 0; $m < $row_num; $m++){ ?>
		    <li data-target="#video-carousel" data-slide-to="<?php echo $m ?>" <?php if($m==0){ ?> class="active" style="margin-right: -1px;"> <?php } ?></li>
		    <?php } ?>
		</ol> -->

	  	<!-- Wrapper for slides -->
	  	<div class="carousel-inner" role="listbox">
	  		<?php $l = 0; do { $l++; ?>
	  			<?php if ($row['g_type'] == 'video') {?>
	  			<div class="item <?php if ($l==1){echo 'active'; } ?>">
		    		<video class="embed-responsive-item" controls>
						<source src="gallery/videos/2.mp4">
						<input type="hidden" value="" id="content">
						<input type="hidden" value="" id="title">
					</video>
			    </div>
			    <?php }else if ($row['g_type'] == 'embed') { ?>
				<div style="min-height: 200px;"> class="item <?php if ($l==1){echo 'active'; } ?>">
		    		<?php echo html_entity_decode($row['g_video']); ?>
			    </div>
			<?php } ?>
	  		<?php } while ( $row = mysqli_fetch_array($result) ); ?>
	  	</div>

	  	<!-- Controls -->
		<a class="left carousel-control" href="#video-carousel" role="button" data-slide="prev">
		    <!-- <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> -->
		    <span class="left-arrow"><img src="assets/img/video_left.png"></span>
		    <span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#video-carousel" role="button" data-slide="next">
		    <!-- <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> -->
		    <span class="right-arrow"><img src="assets/img/video_right.png"></span>
		    <span class="sr-only">Next</span>
		</a>
	</div>
	
</div>
