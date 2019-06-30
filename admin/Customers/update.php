<?php
 include('../../exe/database.php');
if (isset($_POST['update'])) {
	# code...
	$id = $_POST['id'];
	$code = $_POST['code'];
	$sname = $_POST['sname'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];

	$update = mysqli_query($con,"UPDATE `tbl_customer` SET `code`='$code',`name`='$sname',`address`='$address',`cemail`='$email',`ccontact`='$contact' WHERE id = '$id'");

  if ($update) {
		# code...
		$_SESSION["update_message"] = '<div class="alert alert-success">
    <strong>Success!</strong>Customer updated.
  </div>';
	}else{
		$_SESSION["update_message"] ='<div class="alert alert-warning">
			    <strong>Error!</strong> CODE is already in use.
			  </div>';
	}

  header("Location:action.php?id=$id&edit");
}
?>