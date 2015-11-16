<?php
require_once '../connections/connection.php';
$items_per_group = 8;

	//sanitize post value
	$page_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

	//throw HTTP error if group number is not valid
	if(!is_numeric($page_number)){
	    echo "Failed Numbering";
	    exit();
	}

	//get current starting point of records
	$position = ($page_number * $items_per_group);

	//Limit our results within a specified range.
	$results = mysqli_query($con, "SELECT * From gallery WHERE g_type='embed' OR g_type='article' ORDER BY g_id DESC LIMIT $position, $items_per_group");

	    while($row = mysqli_fetch_array($results))
	    {
	    	if($row['g_type'] == "video") {
	    		echo '
	        	<li class="g_object video_object fv-object">
	        		<div class="embed-responsive embed-responsive-4by3">
		        		<video class="embed-responsive-item" disabled preload="metadata">
							<source src="gallery/videos/'.$row['g_video'].'" type="video/mp4">
							Your browser does not support the video tag.
							<input type="hidden" value="'.$row['g_content'].'" id="content">
							<input type="hidden" value="'.$row['g_title'].'" id="title">
						</video>
						<div class="another-overlay" align="center"><img src="assets/img/video_play.png"></div>
						<div class="img-overlay">
	                    	<h4>'.$row["g_title"].'</h4>
	                    </div>
	        		</div>
                </li>
                ';
	    	}
	    	else if($row['g_type'] == 'article') {
	    		echo '
	        	<li class="img_object fv-object"><a href="articles/article.php?article='.$row['g_id'].'">';
            	if ($row['g_image'] !== "") {
            		echo '<img class="img-responsive" src="gallery/images/'.$row['g_image'].'"/>';
            	}
            	else {
            		echo '<img class="img-responsive" src="gallery/images/default.png"/>';
            	}
            	echo '<div class="another-overlay"></div><div class="img-overlay"><h4>'.$row["g_title"].'</h4></div></a></li>';
	    	}
	    	else if($row['g_type'] == 'embed') {
	    		echo '
				<li class="embed_object fv-object g_object">
	        		'. html_entity_decode($row['g_video']) .'
					<div class="another-overlay" align="center"><img src="assets/img/video_play.png"></div>
					<div class="img-overlay">
                    	<h4>'.$row["g_title"].'</h4>
                    </div>
				</li>
                ';
	    	}
	    }
	unset($obj);
	$con->close();

?>
<script type="text/javascript">
	if($(window).width() < 769) {
		$('video').removeAttr('disabled');
		$('video').attr('controls', 'controns');
		$('.overlay').css('display', 'none');
	}
	else {
		$('video').attr('disabled', 'disabled');
		$('video').removeAttr('controls');
		$('.overlay').css('display', 'block');
		$(".g_object.video_object").click(function() {
	        var src = $(this).find("source").attr("src");
	        var content = $(this).find("#content").attr("value");
	        var title = $(this).find("#title").attr("value");
	        var video = '<div><video class="embed-responsive-item" width="600px" height="400px" controls autoplay><source src="'+src+'" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video></div>';
	        $("#myModal").modal();
	        $("#myModal").on("shown.bs.modal", function(){
	            $("#myModal .modal-body").html(video);
	        });
	        $("#myModal").on("hidden.bs.modal", function(){
	            $("#myModal .modal-body").html('');
	        });
		});
		$('.embed_object').click(function () {
			var src = $(this).find('iframe').attr("src");
			var title = $(this).find('#title').attr("value");
			var video = '<iframe src="'+src+'" width="600px" height="400px"></iframe>'
			$('#myModal').modal();
			$('#myModal').on('shown.bs.modal', function () {
				$('#myModal .modal-body').html(video);
			});
		})
	}
</script>
