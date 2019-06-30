<?php
 include('../exe/database.php');
 $transactionid = $_GET['transactionID'];

 $product_exe = mysqli_query($con,"SELECT * FROM `product_exe` WHERE transaction_id='$transactionid'");
 while ($row = mysqli_fetch_assoc($product_exe)) {
 	# code...
 	$sku = $row['product_sku'];
 	$qty = $row['quantity'];


 	$productlist = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku = '$sku'");
 	while ($result = mysqli_fetch_assoc($productlist)) {
 		# code...
 		$total = $result['quantity'] + $qty;

 		$update = mysqli_query($con,"UPDATE `product_list` SET `quantity`='$total' WHERE sku = '$sku'");
 		$delete = mysqli_query($con,"DELETE FROM `product_exe` WHERE product_sku='$sku'");
 	}
 }
 header("Location:pos.php?transactionID=$transactionid");
 ?>