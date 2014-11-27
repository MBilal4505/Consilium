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
	$results = mysqli_query($con, "SELECT * From gallery ORDER BY g_id DESC LIMIT $position, $items_per_group");

	    while($row = mysqli_fetch_array($results))
	    {
	    	if($row['g_type'] == "video") {
	    		echo '
	        	<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12 g_object ">
	        		<div class="embed-responsive embed-responsive-4by3">
		        		<video class="embed-responsive-item" width="320" height="320" disabled>
							<source src="gallery/videos/'.$row['g_video'].'" type="video/mp4">
							Your browser does not support the video tag.
							<input type="hidden" value="'.$row['g_content'].'" id="content">
							<input type="hidden" value="'.$row['g_title'].'" id="title">
						</video>
						<div class="overlay"><img src="img/video_play_icon.svg"></div>
	        		</div>
                </li>
                ';
	    	}
	    	else if($row['g_type'] == 'article') {
	    		echo '
	        	<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12 g_object">
                    <a href=""><img class="img-responsive thumbnail" src="gallery/images/'.$row['g_image'].'"/></a>
                </li>
                ';
	    	}
	        
	    }

	unset($obj);
	$con->close();

?>
<script type="text/javascript">
	$(".g_object video").click(function() {
        var src = $(this).children("source").attr("src");
        var content = $(this).children("#content").attr("value");
        var title = $(this).children("#title").attr("value");
        var video = '<div><video class="embed-responsive-item" width="600px" height="400px" controls autoplay><source src="'+src+'" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video></div>';
        $("#myModal").modal();
        $("#myModal").on("shown.bs.modal", function(){
            $("#myModal .modal-body").html(video);
            $("#myModal .modal-footer").html(content);
            $("#myModal .modal-header h4").html(title);
        });
        $("#myModal").on("hidden.bs.modal", function(){
            $("#myModal .modal-body").html('');
        });
	});
</script>