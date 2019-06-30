<?php
 include('../../exe/database.php');

$password = $_POST['password'];
$newpassword = $_POST['newpassword'];
$renewpassword = $_POST['renewpassword'];

$check = mysqli_query($con,"SELECT * FROM `account` WHERE password='$password'");
$count = mysqli_num_rows($check);

if ($count == 1) {
	# code...
	if ($newpassword == $renewpassword) {
		# code...
		$ucode = $_SESSION['accountcode'];
		$update = mysqli_query($con,"UPDATE `account` SET `password`='$renewpassword' WHERE code = '$ucode'");
		$_SESSION['message'] = '
	<div class="alert alert-success" id="myAlert">
    <a href="#" class="close">&times;</a>
    <strong>Success!</strong> Password changed.
  </div>
	';
header("Location:action.php?changepassword");
	}else{
			$_SESSION['message'] = '
	<div class="alert alert-danger" id="myAlert">
    <a href="#" class="close">&times;</a>
    <strong>Error!</strong> Password not match.
  </div>
	';
header("Location:action.php?changepassword");
	}
}else{
$_SESSION['message'] = '
	<div class="alert alert-danger" id="myAlert">
    <a href="#" class="close">&times;</a>
    <strong>Error!</strong> Password not match.
  </div>
	';
header("Location:action.php?changepassword");
 } ?>
