<?php
 include('../../exe/database.php');

$name = $_GET['name'];
$address = $_GET['address'];
$contact = $_GET['contact'];
$email = $_GET['email'];

$update = mysqli_query($con,"UPDATE `comapny` SET `name`='$name',`address`='$address',`contact`='$contact',`emailadd`='$email',`logo`=''");

	$_SESSION['message'] = '
	<div class="alert alert-success" id="myAlert">
    <a href="#" class="close">&times;</a>
    <strong>Success!</strong> Company details is updated.
  </div>
	';

header("Location:action.php?company");
 ?>