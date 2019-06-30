<?php
   include('../exe/database.php');
    # code...
    $transactionID = $_POST['transactionID'];
    $customer = $_POST['customer'];
	$sku = $_POST['sku'];
	$price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $query = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku = '$sku'");
    $row = mysqli_fetch_assoc($query);
    $onhand = $row['quantity']; 

    $query2 = mysqli_query($con,"SELECT * FROM `product_exe` WHERE product_sku = '$sku'");
    $rows = mysqli_fetch_assoc($query2);
    $transac_quantity = $rows['quantity'];



    $newquantity = $onhand - $quantity;
    $total_price = $quantity * $price;
    $newquantitys = $transac_quantity + $quantity;
    $total_prices = $newquantitys * $price;
	$dnow = date("Y-m-d h:i:sa");


				    if ($onhand >= $quantity) {
				    	# code...
				    	
				    	if ($rows['product_sku'] == $sku) {

				    	$update = mysqli_query($con,"UPDATE `product_exe` SET `quantity`='$newquantitys',`total_price`='$total_prices' WHERE product_sku = '$sku'");
				    	$update = mysqli_query($con,"UPDATE `product_list` SET `quantity`='$newquantity' WHERE sku = '$sku'");
				    		$delete = mysqli_query($con,"DELETE FROM `product_exe` WHERE product_sku = ''");
				    	}else{

				    		$insertitem = mysqli_query($con,"INSERT INTO `product_exe`(`id`, `transaction_id`, `customer_code`, `product_sku`, `quantity`, `price`, `total_price`, `transaction_date`) VALUES ('','$transactionID','$customer','$sku','$quantity','$price','$total_price','$dnow')");
				    		$update = mysqli_query($con,"UPDATE `product_list` SET `quantity`='$newquantity' WHERE sku = '$sku'");
				    		$delete = mysqli_query($con,"DELETE FROM `product_exe` WHERE product_sku = ''");
				    	}
				    	echo "yes";
				    }else{
				    	echo "no";
				    }

    
 ?>