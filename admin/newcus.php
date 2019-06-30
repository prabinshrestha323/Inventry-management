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

<h3>Add new customer</h3>
  <hr/>
  <form method="POST" action="">
  <table class="table">
  	<tr>
  		<td>

  		<label>Code</label><br/>
  			<div class="has-primary has-feedback">
		      <div>
			  		<input type="text" class="form-control" name="code" required/>
	  				<span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
  			<label>Name/Company</label><br/>
  			<div class="has-primary has-feedback">
		      <div>
			  		<input type="text" class="form-control" name="cname" required />
	  				<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  	</tr>

  	<tr>
  		<td colspan="2">
  			<label>Address</label><br/>
  			<div class="has-primary has-feedback">
		      <div>
			  		<textarea class="form-control" name="address" required></textarea>
	  				<span class="glyphicon glyphicon-home form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  	</tr>

  	<tr>
  		<td>

  		<label>Email</label><br/>
  			<div class="has-primary has-feedback">
		      <div>
			  		<input type="text" class="form-control" name="email" required/>
	  				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
  			<label>Contact</label><br/>
  			<div class="has-primary has-feedback">
		      <div>
			  		<input type="text" class="form-control" name="contact" required/>
	  				<span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  	</tr>

  	<tr>
  		<td colspan="2"><p class="text-right"><button class="btn btn-primary btn-sm" type="submit" name="submit">Submit</button></p></td>
  	</tr>

  </table>
  </form>
  
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
<?php

	if (isset($_POST['submit'])) {
		# code...
		$code = $_POST['code'];
		$cname = $_POST['cname'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];

		$newCustomer = mysqli_query($con,"INSERT INTO `tbl_customer`(`id`, `code`, `name`, `address`, `cemail`, `ccontact`) VALUES ('','$code','$cname','$address','$email','$contact')") or die(
			'<div class="alert alert-warning">
			    <strong>Error!</strong> Code is already in use.
			  </div>'
			);

		echo '<div class="alert alert-success">
    <strong>Success!</strong> You inserted a new Customer.
  </div>';


	}
 ?>