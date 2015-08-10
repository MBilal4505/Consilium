<?php 
 	if(!isset($_SESSION)) {
 		session_start();
 	}
 	if (!isset($_SESSION['username']) || $_SESSION['access'] != "admin") {
 		header("Location: ../member-login.php");
 	}
?>
<?php
	require_once '../connections/connection.php';
	$message = "";
	if(isset($_POST['username'])) {
		
		$username = $_POST['username'];
		$password = $_POST['pass'];
		$confirm = $_POST['confirm-pass'];
		if ($_POST['access-level'] == "Administrator") {
			$access_level = "admin";
		}
		else {
			$access_level = "user";
		}
		

		if($password == $confirm) {
			$query = "INSERT INTO users VALUES ('', '$username', '$password', '$access_level')";

			if(mysqli_query($con, $query)) {
				
				$message="New user added.";
			}
			else {
				$message = "Error Occured";
			}
		}
		else {
			$message = "Passwords don't match.";
		}
	}
?>
<?php 

	$query = "SELECT * FROM users";
	$result = mysqli_query($con, $query);
	$record = mysqli_fetch_array($result);
	$row_count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Users</title>
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/custom.min.css">
</head>
<body>
	<?php require_once('admin-header.html') ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<div class="admin-hyperlink">
				<a href="index.php">
					<button class="btn btn-consilium-o-back">Back</button>
				</a>
			</div>
				<div class="panel panel-default text-center">
					
					<div class="panel-heading">
						<h4>
							Add New User
						</h4>
					</div>
					<div class="panel-body">
					<h4><?php echo $message; ?></h4>
						<form class="form-horizontal" action="admin-users.php" method="post" name="new_user" id="new_user">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="username">Username</label>
								<div class="col-sm-8">
									<input type="text" id="username" name="username" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="pass">Password</label>
								<div class="col-sm-8">
									<input type="password" id="pass" name="pass" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="confirm-pass">Confirm Password</label>
								<div class="col-sm-8">
									<input type="password" id="confirm-pass" name="confirm-pass" class="form-control">
								</div>
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
								<div class="col-sm-4 col-sm-offset-4">
									<input type="submit" id="submit" name="submit" value="Submit Entry" class="form-control">
									<input type="hidden" name="form-insert" id="form-insert" value="form-insert">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<table class="table table-striped table-bordered">
					<tr>
						<th class="text-center" colspan="2">Username</th>
						<th class="text-center">Password</th>
						<th class="text-center">Access Level</th>
						<th class="text-center" colspan="2">Actions</th>
					</tr>
					<?php 
						if($row_count > 0) {
							$i = 0;
							do{ $i++;
					?>
					<tr>
						<td class="text-center">
							<?php echo $i; ?>
						</td>
						<td class="text-center">
							<?php echo $record['username'] ?>
						</td>
						<td class="text-center">
							<?php echo $record['password'] ?>
						</td>
						<td class="text-center">
							<?php echo $record['access'] ?>
						</td>
						<td class="text-center">
							<a href="user-actions/admin-update.php?uid=<?php echo $record['user_id']; ?>">Update</a>
						</td>
						<td class="text-center">
							<a href="user-actions/admin-delete.php?did=<?php echo $record['user_id']; ?>">Delete</a>
						</td>
					</tr>
					<?php
							} while ($record = $result->fetch_assoc());
						}
					?>
				</table>
			</div>
		</div>
		
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>