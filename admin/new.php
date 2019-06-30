<!DOCTYPE html>
<html lang="en">
<?php include('../exe/database.php'); ?>
<head>
  <title>New</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	  <div class="row">
	    <div class="col-sm-3">
	    	<hr/>
	    	<form>
	    		<input type="text" class="form-control" placeholder="Search SKU here">
	    	</form>
	    	<hr/>
	    </div>



	    <div class="col-sm-9">
	    <p class="text-center bg-primary">INVOICE</p>

			    <div class="col-sm-8">
			    		<table>
			    			<tr>
			    				<th>To</th>
			    			</tr>
			    			<tr>
			    				<td>Name:</td>
			    				<td>Laurence Quismorio</td>
			    			</tr>
			    			<tr>
			    				<td>Address:</td>
			    				<td>Luna, La Union</td>
			    			</tr>
			    			<tr>
			    				<td>Email:</td>
			    				<td>laurence_quismorio@yahoo.com</td>
			    			</tr>
			    			<tr>
			    				<td>contact:</td>
			    				<td>09366210895</td>
			    			</tr>
			    		</table>

			    </div>


			    <div class="col-sm-4">
					    <div class="panel panel-primary">
						  <div class="panel-heading">Invoice #</div>
						  <div class="panel-body"><p class="text-center"><?php echo $_GET['number']; ?></p></div>
						</div>
			    </div>

			    <table class="table table-condensed">
			    			<tr class="bg-primary">
			    				<th>#</th>
			    				<th>Item name</th>
			    				<th>Unit price</th>
			    				<th>Quantity</th>
			    				<th>Discount</th>
			    				<th>Total</th>
			    			</tr>
			    			<tr>
			    				<td>1</td>
			    				<td></td>
			    				<td></td>
			    				<td></td>
			    				<td></td>
			    				<td></td>
			    			</tr>
			    			<tr>
			    				<td colspan="5"></td>
			    				<td>100</td>
			    			</tr>
			    			<tr>
			    				<td></td>
			    				<td colspan="3">Tax rate:</td>
			    				<td>10%</td>
			    				<td></td>
			    			</tr>
			    			<tr class="bg-success">
			    				<td>GRAND TOTAL</td>
			    				<td></td>
			    				<td></td>
			    				<td>19</td>
			    				<td></td>
			    				<td colspan="3">9999</td>
			    			</tr>
			    		</table>

	    </div>

	  </div>
  
</div>



<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-sm').click(function(){
			window.onunload = refreshParent;
			    function refreshParent() {
			        window.opener.location.reload();
			    }
		});
	});
</script>
</body>
</html>
