<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
 // The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=invoice.xls");
$transactionID = $_GET['transactionID'];
$transactionlist = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE transaction_id = '$transactionID'");
$tr = mysqli_fetch_assoc($transactionlist);
  ?>
<head>
  <title>Action</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h3>Transaction ID: 
  	<?php
  			echo $_GET['transactionID'];
  	 ?>
  </h3>
  <h5>Customer Name:
  	<?php
  			$cusid = $tr['customer_code'];
  			$cusname = mysqli_query($con,"SELECT * FROM `tbl_customer` WHERE code = '$cusid'");
  			$cus = mysqli_fetch_assoc($cusname);

  			$cusname =  $cus['name'];

  			if ($cusname != '') {
  				# code...
  				echo $cusname;
  			}else{
  				echo "Customer is already deleted from database.";
  			}
  	 ?>
  </h5>
  <hr/>
<table border="1">
    		<tr class="bg-info">
              <th>PRODUCT NAME</th>
              <th>QUANTITY</th>
              <th>PRICE</th>
              <th>TOTAL PRICE</th>
              <th>TRANSACTION DATE</th>
            </tr>
	<?php
	$sql = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE transaction_id = '$transactionID'");
	while($data = mysqli_fetch_assoc($sql)){ ?>
		<tr>
			<td>
				<?php
          				$sku = $data['product_sku'];
          				$pname = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku = '$sku'");
          				$pnames = mysqli_fetch_assoc($pname);
          				echo $pnames['name'];
          		?>
			</td>
			<td><?php echo $data['quantity']; ?></td>
      		<td><?php echo $data['price']; ?></td>
      		<td><?php echo $data['total_price']; ?></td>
      		<td><?php echo $data['transaction_date']; ?></td>
		</tr>
	<?php
	}
	?>
</table>
<hr/>
  <h3>PAYMENTS TRANSACTION</h3>
  <table class="table table-condensed table-striped">
    <tr>
      <th>BALANCE</th>
      <th>AMOUNT PAID</th>
      <th>TRANSACTION DATE</th>
    </tr>
    <?php
      $viewtransaction = mysqli_query($con,"SELECT * FROM `payments` WHERE transaction_id = '$transactionID'");
      while ($row = mysqli_fetch_assoc($viewtransaction)) { ?>
      <tr>
        <td><?php echo $row['balance']; ?></td>
        <td><?php echo $row['amount_paid']; ?></td>
        <td><?php echo $row['transaction_date']; ?></td>
      </tr>
    <?php }
     ?>
  </table>
</div>
</body>
</html>