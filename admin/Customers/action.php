<!DOCTYPE html>
<html lang="en">
<?php
 include('../../exe/database.php');
 $id = $_GET['id'];
 $customer = mysqli_query($con,"SELECT * FROM `tbl_customer` WHERE id = '$id'");
 $row = mysqli_fetch_assoc($customer);
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

  <h3>Update customer</h3>
  <hr/>
  <form action="update.php" method="POST">
  <table class="table table-condensed">

  	<tr>
  		<td>
	  		<label>Code</label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
					<input type="text" class="form-control" value="<?php echo $row['code']; ?>" name="code" required/>
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	  				<span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td></td>
  		<td></td>
  	</tr>

  	<tr>
  		<td colspan="3">
	  		<label>Name/Company</label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
					<input type="text" class="form-control" name="sname" value="<?php echo $row['name']; ?>" required/>
	  				<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  	</tr>

  	<tr>
  		<td colspan="3">
  			<label>Address</label><br/>
  			<textarea class="form-control" name="address" required><?php echo $row['address']; ?></textarea>
  		</td>
  	</tr>

  	<tr>
  		<td>
	  		<label>Email</label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
		        <input type="text" class="form-control" name="email" value="<?php echo $row['cemail']; ?>" required>
		        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      </div>
		    </div>
  		</td>
  		<td>
	  		<label>Contact</label><br/>
	  		<div class="has-primary has-feedback">
		      <div>
		        <input type="text" class="form-control" name="contact" value="<?php echo $row['ccontact']; ?>" required>
		        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
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
