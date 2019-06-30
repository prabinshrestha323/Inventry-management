<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
 $id = $_GET['transactionID'];
 $transID = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE transaction_id = '$id'");
  $tr = mysqli_fetch_assoc($transID);
 $transactionlist = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE transaction_id = '$tr[transaction_id]'");
 $customer = mysqli_query($con,"SELECT * FROM `tbl_customer` WHERE code = '$tr[customer_code]'");
 $cus = mysqli_fetch_assoc($customer);
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
				    <table class="table table-condensed">
						<tr>
							<td><b><?php echo $mcompany['name']; ?></b></td>
							<td>RECEIPT</td>
						</tr>
					</table>
					<table class="table table-condensed">
						<tr>
							<td><p class="text-right"><small>INVOICE NUMBER</small></p></td>
							<td><p class="text-left"><small><?php echo $_GET['transactionID']; ?></small></p></td>
							<td><p class="text-right"><small>DATE</small></p></td>
							<td><p class="text-left"><small><?php echo date('m/d/Y'); ?></small></p></td>
						</tr>
						<tr>
							<td>
							<p class="text-right">
							<small>
								MAILING<br/>
								INFO
							</small>
							</p>
							</td>
							<td>
							<p class="text-left">
							<small>
								ADDRESS: <b><?php echo $mcompany['address']; ?></b><br/>
								CONTACT NUMBER: <b><?php echo $mcompany['contact']; ?></b><br/>
								EMAIL: <b><?php echo $mcompany['emailadd']; ?></b>
							</small>
							</p>
							</td>


							<td>
							<p class="text-right">
							<small>
								BILL<br/>
								TO
							</small>
							</p>
							</td>
							<td>
							<p class="text-left">
							<small>
								NAME: <b><?php echo $cus['name']; ?></b><br/>
								CUSTOMER ID: <b><?php echo $cus['code']; ?></b><br/>
								ADDRESS: <b><?php echo $cus['address']; ?></b><br/>
								CONTACT: <b><?php echo $cus['ccontact']; ?></b><br/>
								EMAIL: <b><?php echo $cus['cemail']; ?></b>
							</small>
							</p>
							</td>
						</tr>
					</table>

					<table class="table table-condensed">
  		<thead>
            <tr class="bg-info">
              <th>NAME</th>
              <th>DESCRIPTION</th>
              <th>QTY</th>
              <th>PRICE</th>
              <th>T PRICE</th>
            </tr>
          </thead>
          <tbody>
          	<?php
          	while ($row = mysqli_fetch_assoc($transactionlist)) { ?>
          	<tr>
          		<td>
          			<?php
          				$sku = $row['product_sku'];
          				$pname = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku = '$sku'");
          				$pnames = mysqli_fetch_assoc($pname);
          				echo $pnames['name'];
          			 ?>
          		</td>
          		<td>
          			<?php
          				$sku = $row['product_sku'];
          				$pname = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku = '$sku'");
          				$pnames = mysqli_fetch_assoc($pname);
          				echo $pnames['info'];
          			 ?>
          		</td>
          		<td><?php echo $row['quantity']; ?></td>
          		<td><?php echo $row['price']; ?></td>
          		<td><?php echo $row['total_price']; ?></td>
          	</tr>
          	<?php }
          	 ?>
          	 <tr>
          	 	<td colspan="4"><p class="text-right">Total:</p></td>
          	 	<td>
          	 		<?php
          	 			 $count = mysqli_query($con,"SELECT SUM(total_price) AS TotalItemsPrice FROM transaction_list WHERE transaction_id = '$tr[transaction_id]'");
		                 $qty = mysqli_fetch_assoc($count);
		                 echo "<span class='glyphicon glyphicon-usd'></span> ".($qty['TotalItemsPrice'] + 0);
		            ?>
          	 	</td>
          	 </tr>
          <!--	 <tr>
          	 	<td colspan="4"><p class="text-right">Status:</p></td>
          	 	<td>
          	 		<?php
          	 			//$invoice = mysqli_query($con,"SELECT * FROM `invoice` WHERE transaction_id = '$tr[transaction_id]'");
          	 			//$status = mysqli_fetch_assoc($invoice);
          	 			//echo $status['status'];
          	 		 ?>
          	 	</td>
          	 </tr>
          	 <tr>
          	 	<td colspan="4"><p class="text-right">Balance:</p></td>
          	 	<td>
          	 		<span class='glyphicon glyphicon-usd'></span> <?php echo $status['balance']; ?>
          	 	</td>
          	 </tr> -->
          </tbody>
  </table>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		window.print();
	});
</script>
</body>
</html>