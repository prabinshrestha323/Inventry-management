<?php
 include('../exe/database.php');
 $transactionid = $_GET['transactionID'];

 $product_exe = mysqli_query($con,"SELECT * FROM `product_exe` WHERE transaction_id='$transactionid'");
 while ($row = mysqli_fetch_assoc($product_exe)) {
 	# code...
 	$ccode = $row['customer_code'];
 	$sku = $row['product_sku'];
 	$qty = $row['quantity'];
 	$price = $row['price'];
 	$total = $row['total_price'];
 	$transaction_date = $row['transaction_date'];

 	$save = mysqli_query($con,"INSERT INTO `transaction_list`(`id`, `transaction_id`, `customer_code`, `product_sku`, `quantity`, `price`, `total_price`, `transaction_date`) VALUES ('','$transactionid','$ccode','$sku','$qty','$price','$total','$transaction_date')");
 }

 		$count = mysqli_query($con,"SELECT SUM(total_price) AS TotalItemsPrice FROM transaction_list WHERE transaction_id = '$transactionid'");
                $qty = mysqli_fetch_assoc($count);
                $totalprice = $qty['TotalItemsPrice'];

 		$invoice = mysqli_query($con,"INSERT INTO `invoice`(`id`, `transaction_id`, `balance`, `status`, `transaction_date`) VALUES ('','$transactionid','$totalprice','unpaid','$transaction_date')");
  		$delete = mysqli_query($con,"DELETE FROM `product_exe`");

  		$checking = mysqli_num_rows($product_exe);
if ($checking != 0) {
 header("Location:invoice.php?transactionID=$transactionid");
}else{
 header("Location:pos.php?transactionID=$transactionid");
}
 ?>