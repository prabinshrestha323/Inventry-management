<?php
include('database.php');

if (isset($_POST['login'])) {
	# code...
	$username = $_POST['username'];
	$password = $_POST['password'];

	$check = mysqli_query($con,"SELECT * FROM `account` WHERE username = '$username'");
	$count = mysqli_num_rows($check);


	if ($count == 1) {
		# code...
		$row = mysqli_fetch_assoc($check);
		if ($row['password'] == $password) {
			# code...
			if ($row['status'] == 'active') {
				# code...
				if ($row['type'] == 'admin') {
					# code...
					$_SESSION['login'] = "login";
					$_SESSION['type'] = "admin";
					$_SESSION['accountcode'] = $row['code'];
					header("Location:../admin");
				}
			}else{
				$_SESSION['message'] = '<div class="alert alert-danger" id="myAlert">
				    <a href="#" class="close">&times;</a>
				    <strong>Error!</strong>Login failed.
				  </div>';
					header("Location:../");
			}
		}else{
							$_SESSION['message'] = '<div class="alert alert-danger" id="myAlert">
				    <a href="#" class="close">&times;</a>
				    <strong>Error!</strong>Login failed.
				  </div>';
					header("Location:../");
		}
	}else{
		$_SESSION['message'] = '<div class="alert alert-danger" id="myAlert">
		    <a href="#" class="close">&times;</a>
		    <strong>Error!</strong>Login failed.
		  </div>';
					header("Location:../");
	}
}
 ?>