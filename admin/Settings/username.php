<?php
 include('../../exe/database.php');

$username = $_POST['username'];
$newusername = $_POST['newusername'];
$renewusername = $_POST['renewusername'];

$check = mysqli_query($con,"SELECT * FROM `account` WHERE username='$username'");
$count = mysqli_num_rows($check);

if ($count == 1) {
	# code...
	if ($newusername == $renewusername) {
		# code...
		$ucode = $_SESSION['accountcode'];
		$update = mysqli_query($con,"UPDATE `account` SET `username`='$renewusername' WHERE code = '$ucode'");
		$_SESSION['message'] = '
	<div class="alert alert-success" id="myAlert">
    <a href="#" class="close">&times;</a>
    <strong>Success!</strong> Username changed.
  </div>
	';
header("Location:action.php?changeusername");
	}else{
			$_SESSION['message'] = '
	<div class="alert alert-danger" id="myAlert">
    <a href="#" class="close">&times;</a>
    <strong>Error!</strong> Username not match.
  </div>
	';
header("Location:action.php?changeusername");
	}
}else{
$_SESSION['message'] = '
	<div class="alert alert-danger" id="myAlert">
    <a href="#" class="close">&times;</a>
    <strong>Error!</strong> Username not match.
  </div>
	';
header("Location:action.php?changeusername");
 } ?>
