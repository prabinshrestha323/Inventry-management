<!DOCTYPE html>
<html lang="en">
<?php
 include('../../exe/database.php');
 $id = $_GET['id'];
 $product = mysqli_query($con,"SELECT * FROM `product_list` WHERE id = '$id'");
 $row = mysqli_fetch_assoc($product);
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
if (isset($_GET['edit'])) { ?>

  <h3>Update product</h3>
  <hr/>
  <form action="update.php" method="POST">
  <table class="table table-condensed">
  	<tr>
  		<td colspan="3">
  			<label>Supplier <a href="#" class="btn btn-primary btn-xs" data-name="supplier" title="Click here to add supplier"><span class="glyphicon glyphicon-plus-sign"></span></a></label><br/>
  			<div class="has-primary has-feedback">
		      <div>
					<select class="form-control" name="supplier" required>
			  			<option value="<?php echo $row['supplier']; ?>">
			  			<?php 
			  						  			$code = $row['supplier'];
			  			$viewsupp = mysqli_query($con,"SELECT * FROM `product_supplier` WHERE code = '$code'");
			  			$display = mysqli_fetch_assoc($viewsupp);
			  			echo $display['name'];
			  			 ?>
			  			</option>
			  			<?php
			  				$supplierlist = mysqli_query($con,"SELECT * FROM `product_supplier`");
			  				while ($row1 = mysqli_fetch_assoc($supplierlist)) { ?>
			  				<option value="<?php echo $row1['code']; ?>"><?php echo $row1['name']; ?></option>
			  			<?php	}
			  			 ?>
			  		</select>
	  				<span class="glyphicon glyphicon-tasks form-control-feedback"></span>
		      </div>
		    </div>



	  		
  		</td>
  	</tr>

  	<tr>
  		<td>
	  		<label><abbr title="Stock Keeping Unit">SKU</abbr></label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
					<input type="text" class="form-control" value="<?php echo $row['sku']; ?>" name="sku" required/>
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	  				<span class="glyphicon glyphicon-barcode form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
	  		<label>Product name</label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
					<input type="text" class="form-control" name="pname" value="<?php echo $row['name']; ?>" required/>
	  				<span class="glyphicon glyphicon-tag form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
	  		<label>Category <a href="" class="btn btn-primary btn-xs" data-name="category" title="Click here to add category"><span class="glyphicon glyphicon-plus-sign"></span></a></label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
				<select class="form-control" name="category" required>
	  				<option value="<?php echo $row['category']; ?>">
	  				<?php 
			  						  			$code2 = $row['category'];
			  			$viewcat = mysqli_query($con,"SELECT * FROM `product_category` WHERE code = '$code2'");
			  			$display2 = mysqli_fetch_assoc($viewcat);
			  			echo $display2['name'];
			  			 ?>
			  			</option>
	  				<?php
			  				$categorylist= mysqli_query($con,"SELECT * FROM `product_category`");
			  				while ($row2 = mysqli_fetch_assoc($categorylist)) { ?>
			  				<option value="<?php echo $row2['code']; ?>"><?php echo $row2['name']; ?></option>
			  			<?php	}
			  			 ?>
	  			</select>
	  			<span class="glyphicon glyphicon-subtitles form-control-feedback"></span>
		      </div>
		    </div>

  		</td>
  	</tr>

  	<tr>
  		<td colspan="3">
  			<label>Product Information</label><br/>
  			<textarea class="form-control" name="pinformation" required><?php echo $row['info']; ?></textarea>
  		</td>
  	</tr>

  	<tr>
  		<td>
	  		<label>Quantity</label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
		        <input type="number" class="form-control" min="0" name="quantity" value="<?php echo $row['quantity']; ?>" required>
		        <span class="glyphicon glyphicon-sort-by-order form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
	  		<label><abbr title="Price Per Item">PPI</abbr></label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
		        <input type="number" class="form-control" min="1" name="ppi" value="<?php echo $row['price']; ?>" required>
		        <span class="glyphicon glyphicon-usd form-control-feedback"></span>
		      </div>
		    </div>
	  		
  		</td>
  		<td>
  			<label></label><br/>
  			<p class="text-right"><button class="btn btn-lg btn-primary" type="submit" name="update">Update</button></p>
  		</td>
  	</tr>
  </table>
  </form>
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
						$delete = mysqli_query($con,"DELETE FROM `product_list` WHERE id='$id'");
					 }else{
					?>


				  <h3>Delete product</h3>
				  <hr/>
				  <div class="alert alert-info">
				    <strong>Info!</strong> Are you sure you want to delete this product? If yes just click the <label class="label label-xs label-danger">Delete</label> button and if not just close the window. <i>You can not undo this function.</i>
				  </div>
				  <form action="" method="POST">
				  <table class="table table-condensed">
				  	<tr>
				  		<td colspan="3">
				  			<label>Supplier: </label>

							  			<?php 
							  			$code = $row['supplier'];
							  			$viewsupp = mysqli_query($con,"SELECT * FROM `product_supplier` WHERE code = '$code'");
							  			$display = mysqli_fetch_assoc($viewsupp);
							  			echo $display['name'];
							  			 ?>
				  		</td>
				  	</tr>

				  	<tr>
				  		<td>
					  		<label><abbr title="Stock Keeping Unit">SKU: </abbr></label><?php echo $row['sku']; ?>
				  		</td>
				  		<td>
					  		<label>Product name: </label><?php echo $row['name']; ?>
				  		</td>
				  		<td>
					  		<label>Category :</label>
					  					<?php 
							  			$code2 = $row['category'];
							  			$viewcat = mysqli_query($con,"SELECT * FROM `product_category` WHERE code = '$code2'");
							  			$display2 = mysqli_fetch_assoc($viewcat);
							  			echo $display2['name'];
							  			 ?>

				  		</td>
				  	</tr>

				  	<tr>
				  		<td colspan="3">
				  			<label>Product Information</label><br/>
				  			<?php echo $row['info']; ?>
				  		</td>
				  	</tr>

				  	<tr>
				  		<td>
					  		<label>Quantity: </label><?php echo $row['quantity']; ?>
				  		</td>
				  		<td>
					  		<label><abbr title="Price Per Item">PPI: </abbr></label><?php echo $row['price']; ?>
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


<?php
	if (isset($_GET['add'])) { ?>
	<h3>Add Quantity</h3>
	<hr/>
<div class="alert alert-info">
	<strong>Info!</strong> You're about to add quantity for Product: <span class="glyphicon glyphicon-hand-down"></span>
	</div>
	<table class="table table-condensed">
		<tr>
			<td colspan="3">
				<label>Supplier: </label>

			  			<?php 
			  			$code = $row['supplier'];
			  			$viewsupp = mysqli_query($con,"SELECT * FROM `product_supplier` WHERE code = '$code'");
			  			$display = mysqli_fetch_assoc($viewsupp);
			  			echo $display['name'];
			  			 ?>
			</td>
		</tr>

		<tr>
			<td>
	  		<label><abbr title="Stock Keeping Unit">SKU: </abbr></label><?php echo $row['sku']; ?>
			</td>
			<td>
	  		<label>Product name: </label><?php echo $row['name']; ?>
			</td>
			<td>
	  		<label>Category :</label>
	  					<?php 
			  			$code2 = $row['category'];
			  			$viewcat = mysqli_query($con,"SELECT * FROM `product_category` WHERE code = '$code2'");
			  			$display2 = mysqli_fetch_assoc($viewcat);
			  			echo $display2['name'];
			  			 ?>

			</td>
		</tr>

		<tr>
			<td colspan="3">
				<label>Product Information</label><br/>
				<?php echo $row['info']; ?>
			</td>
		</tr>

		<tr>
			<td>
	  		<label><abbr title="Price Per Item">PPI: </abbr> </label><?php echo $row['price']; ?>
			</td>
			<td>
			</td>
		</tr>

		<tr class="bg-info">
			<form action="" method="POST">
			<td></td>
			<td><input type="number" name="addq" min="1" class="form-control" placeholder="Additional Quantity here..." required/></td>
			<td><button class="btn btn-primary btn-lg" name="addquantity" type="submit">Submit</button></td>
			</form>
		</tr>
	</table>
<?php	}
 ?>
</div>
<script>

$(document).ready(function(){

$('.btn-xs').click(function(){
var page = $(this).attr('data-name');
    window.open("new.php?"+page, "new", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=50,width=400,height=500");

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
<?php

if (isset($_POST['addquantity'])) {
	# code...
	$addq = $_POST['addq'] + $row['quantity'];
	

	$update = mysqli_query($con,"UPDATE `product_list` SET `quantity`='$addq' WHERE id = '$id'") or die(
			'<div class="alert alert-warning">
			    <strong>Error!</strong> SKU is already in use.
			  </div>'
			);

		echo '<div class="alert alert-success">
    <strong>Success!</strong>Product quantity updated. New quantity for this product : <b class="text-danger">'.$addq.'</b> .
    <a href="?id='.$_GET["id"].'&edit" class="label label-primary label-xs">edit</a>
  </div>';
}


 ?>