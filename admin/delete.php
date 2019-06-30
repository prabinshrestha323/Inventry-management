<?php
   include('../exe/database.php');

   $transactionID = $_GET['transactionID'];
   $sku = $_GET['sku'];


   $view = mysqli_query($con,"SELECT * FROM `product_exe` WHERE product_sku='$sku'");
   $row = mysqli_fetch_assoc($view);
   $quantity = $row['quantity'];

   $views = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku='$sku'");
   $rows = mysqli_fetch_assoc($views);
   $quantitys = $rows['quantity'];

   $total = $quantity + $quantitys;


   $update = mysqli_query($con,"UPDATE `product_list` SET `quantity`='$total' WHERE sku='$sku'");

   $query = mysqli_query($con,"DELETE FROM `product_exe` WHERE product_sku='$sku'");
   header("Location:pos.php?transactionID=$transactionID");
   $_SESSION['message']='<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Deleted!</strong> You have successfully deleted an item.
  </div>';
?>