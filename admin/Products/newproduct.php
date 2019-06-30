<!DOCTYPE html>
<html lang="en">
<?php include('../../exe/database.php'); ?>
<head>
  <title>New Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h3>Add new product</h3>
  <hr/>
  <form action="" method="POST">
  <table class="table table-condensed">
  	<tr>
  		<td colspan="3">
  			<label>Supplier <a href="#" class="btn btn-primary btn-xs" data-name="supplier" title="Click here to add supplier"><span class="glyphicon glyphicon-plus-sign"></span></a></label><br/>
  			<div class="has-primary has-feedback">
		      <div>
					<select class="form-control" name="supplier" required>
			  			<option value="">Select here</option>
			  			<?php
			  				$supplierlist = mysqli_query($con,"SELECT * FROM `product_supplier`");
			  				while ($row = mysqli_fetch_assoc($supplierlist)) { ?>
			  				<option value="<?php echo $row['code']; ?>"><?php echo $row['name']; ?></option>
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
					<input type="text" class="form-control" name="sku" required/>
	  				<span class="glyphicon glyphicon-barcode form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
	  		<label>Product name</label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
					<input type="text" class="form-control" name="pname" required/>
	  				<span class="glyphicon glyphicon-tag form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
	  		<label>Category <a href="" class="btn btn-primary btn-xs" data-name="category" title="Click here to add category"><span class="glyphicon glyphicon-plus-sign"></span></a></label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
				<select class="form-control" name="category" required>
	  				<option value="">Select here</option>
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
  			<textarea class="form-control" name="pinformation" required></textarea>
  		</td>
  	</tr>

  	<tr>
  		<td>
	  		<label>Quantity</label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
		        <input type="number" class="form-control" min="1" name="quantity" required>
		        <span class="glyphicon glyphicon-sort-by-order form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
	  		<label><abbr title="Price Per Item">PPI</abbr></label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
		        <input type="number" class="form-control" min="1" name="ppi" required>
		        <span class="glyphicon glyphicon-usd form-control-feedback"></span>
		      </div>
		    </div>
	  		
  		</td>
  		<td>
  			<label></label><br/>
  			<p class="text-right"><button class="btn btn-lg btn-primary" type="submit" name="submit">Submit</button></p>
  		</td>
  	</tr>
  </table>
  </form>
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
});

$('.btn-lg').click(function(){
    window.onunload = refreshParent;
			    function refreshParent() {
			        window.opener.location.reload();
			    }
});

});

</script>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
	# code...
	$supplier = $_POST['supplier'];
	$sku = $_POST['sku'];
	$pname = $_POST['pname'];
	$category = $_POST['category'];
	$pinformation = $_POST['pinformation'];
	$quantity = $_POST['quantity'];
	$ppi = $_POST['ppi'];
		$dnow = date("Y-m-d h:i:sa");

	$newproduct = mysqli_query($con,"INSERT INTO `product_list`(`id`, `sku`, `name`, `category`, `supplier`, `info`, `quantity`, `price`, `pdate`) VALUES ('','$sku','$pname','$category','$supplier','$pinformation','$quantity','$ppi','$dnow')") or die(
			'<div class="alert alert-warning">
			    <strong>Error!</strong> SKU is already in use.
			  </div>'
			);

		echo '<div class="alert alert-success">
    <strong>Success!</strong> You inserted a new Product.
  </div>';
}
 ?>