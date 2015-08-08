<?php
	require_once '../check_admin.php';
 	require_once'../../connections/connection.php';

 		$acc_query = "DELETE FROM gallery WHERE g_id = {$_GET['did']}";
		if($result = mysqli_query($con, $acc_query)) {
			header("Location: ../add-article.php");
		}
		else {
			$message = "Error Occured";
			echo mysqli_error($con);
		}
	
?>