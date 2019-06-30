<?php 
 include('../exe/database.php');

 if (isset($_GET['transactionID'])) {
 	# code...
 	$transactionID = $_GET['transactionID'];
	$product_sku = $_GET['sku'];

	$productlist = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku = '$product_sku'");
	$row = mysqli_fetch_assoc($productlist);

	$productexe = mysqli_query($con,"SELECT * FROM `product_exe` WHERE transaction_id = '$transactionID' AND product_sku = '$product_sku'");
	$rows = mysqli_fetch_assoc($productexe);

	$total = $rows['quantity'] - 1;
	$qty = $row['quantity'] + 1;
	
	if ($total == 0) {
		# code...
		$updatelist = mysqli_query($con,"UPDATE `product_list` SET `quantity`='$qty' WHERE sku='$product_sku'");
		$deleteexe = mysqli_query($con,"DELETE FROM `product_exe` WHERE product_sku = '$product_sku'");
		header("Location:pos.php?transactionID=$transactionID");
	}else{
		$updatelist = mysqli_query($con,"UPDATE `product_list` SET `quantity`='$qty' WHERE sku='$product_sku'");
		$updateexe = mysqli_query($con,"UPDATE `product_exe` SET `quantity`='$total' WHERE product_sku='$product_sku'");
		header("Location:pos.php?transactionID=$transactionID");
	}

 }
?>