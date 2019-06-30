<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
 $id = $_GET['id'];
 $transID = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE id = '$id'");
  			$tr = mysqli_fetch_assoc($transID);
 $transactionlist = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE transaction_id = '$tr[transaction_id]'");
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
<?php //Edit starts here
if (isset($_GET['view'])) { ?>

  <h3>Transaction ID: 
  	<?php
  			echo $tr['transaction_id'];
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
  <table class="table table-condensed">
  		<thead>
            <tr class="bg-info">
              <th>PRODUCT NAME</th>
              <th>QUANTITY</th>
              <th>PRICE</th>
              <th>TOTAL PRICE</th>
              <th>TRANSACTION DATE</th>
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
          		<td><?php echo $row['quantity']; ?></td>
          		<td><?php echo $row['price']; ?></td>
          		<td><?php echo $row['total_price']; ?></td>
          		<td><?php echo $row['transaction_date']; ?></td>
          	</tr>
          	<?php }
          	 ?>
          	 <tr>
          	 	<td colspan="4"><p class="text-right">Sub Total:</p></td>
          	 	<td>
          	 		<?php
          	 			 $count = mysqli_query($con,"SELECT SUM(total_price) AS TotalItemsPrice FROM transaction_list WHERE transaction_id = '$tr[transaction_id]'");
		                 $qty = mysqli_fetch_assoc($count);
		                 echo "<span class='glyphicon glyphicon-usd'></span> ".($qty['TotalItemsPrice'] + 0);
		            ?>
          	 	</td>
          	 </tr>
          	 <tr>
          	 	<td colspan="4"><p class="text-right">Status:</p></td>
          	 	<td>
          	 		<?php
          	 			$invoice = mysqli_query($con,"SELECT * FROM `invoice` WHERE transaction_id = '$tr[transaction_id]'");
          	 			$status = mysqli_fetch_assoc($invoice);
          	 			echo $status['status'];
          	 		 ?>
          	 	</td>
          	 </tr>
          	 <tr>
          	 	<td colspan="4"><p class="text-right">Balance:</p></td>
          	 	<td>
          	 		<span class='glyphicon glyphicon-usd'></span> <?php echo $status['balance']; ?>
          	 	</td>
          	 </tr>
          	 <tr>
          	 	<td colspan="5">
          	 		<p class="text-right">
          	 			<a href="" data-name="<?php echo $tr['transaction_id']; ?>" class="btn btn-primary btn-new"><span class="glyphicon glyphicon-usd"></span> Payment</a>
          	 			<a href="excel.php?transactionID=<?php echo $tr['transaction_id']; ?>" class="btn btn-success"><span class="glyphicon glyphicon-save-file"></span> Excel</a>
          	 			<a target="_blank" href="print_receipt_all.php?transactionID=<?php echo $tr['transaction_id']; ?>" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Print</a>
          	 		</p>
          	 	</td>
          	 </tr>
          </tbody>
  </table>
   <?php }
   if (isset($_SESSION['update_message'])) {
   	# code...
   	echo $_SESSION['update_message'];
   	unset($_SESSION['update_message']);
   }
    ?>


				   <?php //delete starts here
				if (isset($_GET['delete'])) { 

					if ($_GET['delete']=='success') { ?>
					    <div class="panel panel-danger" style="width: 500px;
															    height: 100px;
															    position: absolute;
															    top:0;
															    bottom: 0;
															    left: 0;
															    right: 0;
															    margin: auto;">
					      <div class="panel-heading">Successfuly deteled</div>
					      <div class="panel-body">Please close this window.</div>
					    </div>
					<?php
						$id=$_GET['id'];
						$delete = mysqli_query($con,"DELETE FROM `tbl_customer` WHERE id='$id'");
					 }else{
					?>


				  <h3>Delete customer</h3>
				  <hr/>
				  <div class="alert alert-info">
				    <strong>Info!</strong> Are you sure you want to delete this customer? If yes just click the <label class="label label-xs label-danger">Delete</label> button and if not just close the window. <i>You can not undo this function.</i>
				  </div>
				  <form action="" method="POST">
				  <table class="table table-condensed">
				  	<tr>
				  		<td>
				  			<label>Code: </label>
				  			<?php echo $row['code']; ?>
				  		</td colspan="2">
				  		<td>
				  		<label>Name/Company: </label>
				  			<?php echo $row['name']; ?>
				  		</td>
				  	</tr>

				  	<tr>
				  		<td colspan="3">
				  			<label>Address:</label><br/>
				  			<?php echo $row['address']; ?>
				  		</td>
				  	</tr>

				  	<tr>
				  		<td>
					  		<label>Email: </label><?php echo $row['cemail']; ?>
				  		</td>
				  		<td>
					  		<label>Contact: </label><?php echo $row['ccontact']; ?>
				  		</td>
				  		<td>
				  			<label></label><br/>
				  			<p class="text-right"><a href="?id=<?php echo $_GET['id']; ?>&delete=success" class="btn btn-lg btn-danger" type="submit" name="delete">Delete</a></p>
				  		</td>
				  	</tr>
				  </table>
				  </form>
				   <?php
				    } 
				    } ?>

</div>
<script>

$(document).ready(function(){

$('.btn-new').click(function(){
var page = $(this).attr('data-name');
    window.open("payment.php?transactionID="+page, "new", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=50,width=400,height=500");

    window.onunload = refreshParent;
			    function refreshParent() {
			        window.opener.location.reload();
			    }
location.reload();
if (reload=true) {
location.reload();
}
});

$('.btn-lg').click(function(){
    window.onunload = refreshParent;
			    function refreshParent() {
			        window.opener.location.reload();
			    }
var reload = location.reload();
if (reload = true) {
location.reload();
}
});

});

</script>
</body>
</html>
