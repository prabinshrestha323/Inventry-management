<?php
 include('../../exe/database.php');
if (isset($_POST['update'])) {
	# code...
	$supplier = $_POST['supplier'];
	$sku = $_POST['sku'];
	$id = $_POST['id'];
	$pname = $_POST['pname'];
	$category = $_POST['category'];
	$pinformation = $_POST['pinformation'];
	$quantity = $_POST['quantity'];
	$ppi = $_POST['ppi'];
			$dnow = date("Y-m-d h:i:sa");


	$update = mysqli_query($con,"UPDATE `product_list` SET `sku`='$sku',`name`='$pname',`category`='$category',`supplier`='$supplier',`info`='$pinformation',`quantity`='$quantity',`price`='$ppi' WHERE id = '$id'");
 
	$quantity = mysqli_query($con,"SELECT * FROM `product_list` WHERE id = '$id'");
	$row = mysqli_fetch_assoc($quantity);

	if ($update) {
		# code...
		$_SESSION["update_message"] = '<div class="alert alert-success">
    <strong>Success!</strong>Product updated.
  </div>';
	}else{
		$_SESSION["update_message"] ='<div class="alert alert-warning">
			    <strong>Error!</strong> SKU is already in use.
			  </div>';
	}

	//if ($row['quantity']!=$quantity or $row['price']!=$ppi) {
		# code...

		//$quant = $quantity - $row['quantity'];
		//$trasac = mysqli_query($con,"INSERT INTO `product_transaction`(`id`, `sku`, `name`, `category`, `supplier`, `info`, `quantity`, `price`, `pdate`) VALUES ('','$sku','$pname','$category','$supplier','$pinformation','$quant','$ppi','$dnow')");

	//}

		

  header("Location:action.php?id=$id&edit");
}
?>