<?php
	require_once '../check_admin.php';
 	require_once'../../connections/connection.php';

 	$acc_query = "SELECT * FROM users WHERE user_id = {$_GET['uid']}";
	$acc_result = mysqli_query($con, $acc_query);
	$acc_record = mysqli_fetch_array($acc_result);

	if(isset($_POST['acc_submit'])) {
		$username = $_POST['username'];
		$password = $_POST['pass'];
		$confirm_pass = $_POST['confirm-pass'];
		if ($_POST['access-level'] == "Administrator") {
			$access_level = "admin";
		}
		else {
			$access_level = "user";
		}
		if($password == $confirm_pass) {
			$query = "UPDATE users SET username='$username', password ='$password', access='$access_level' WHERE user_id = {$_GET['uid']}";
			if($result = mysqli_query($con, $query)) {
				header("Location: ../admin-users.php");
			}
			else {
				$message = "Error Occured";
				echo mysqli_error($con);
			}
		}
		else {
			$message = "Passwords don't match.";
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
	<!-- <link rel="stylesheet" type="text/css" href="css/jquery-text.css"> -->
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="../../assets/css/custom.min.css">
	
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="admin-hyperlink">
					<a href="../admin-users.php">
						<button class="btn btn-consilium-o-back">Back</button>
					</a>
				</div>
				<h1 class="text-center">Update User</h1>
				<h3>
				</h3>
				<form class="form" method="post" action="admin-update.php?uid=<?php echo $_GET['uid'] ?>" name="change-accordion">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" id="username" value="<?php echo $acc_record['username'] ?>">
					</div>
					<div class="form-group">
						<label for="pass">Password</label>
						<input type="password" class="form-control" name="pass" id="pass" value="">
					</div>
					<div class="form-group">
						<label for="confirm-pass">Confirm Password</label>
						<input type="password" class="form-control" name="confirm-pass" id="confirm-pass" value="">
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="access-level">User Type</label>
						<div class="col-sm-8">
							<select class="form-control" id="access-level" name="access-level">
								<option>Administrator</option>
								<option>User</option>
							</select>
						</div>
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