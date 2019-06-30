<!DOCTYPE html>
<html lang="en">
<?php
 include('../../exe/database.php');
 ?>
<head>
  <title>Reports</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</head>
<body>
<div class="container">
<?php

 if (isset($_GET['company'])) {
 	$company = mysqli_query($con,"SELECT * FROM `comapny`");
 	$com = mysqli_fetch_assoc($company);
  ?>
 <h3>Update Company Information</h3>
<form action="company.php" method="GET">
 	<table class="table table-condensed">
 		<tr>
 			<td colspan="2">Name:<br/>
 				<input type="text" value="<?php echo $com['name']; ?>" name="name" class="form-control">
 			</td>
 		</tr>
 		<tr>
 			<td colspan="2">Address:<br/>
 				<textarea name="address" class="form-control"><?php echo $com['address']; ?></textarea>
 			</td>
 		</tr>
 		<tr>
 			<td>Contact:<br/>
 				<input type="text" value="<?php echo $com['contact']; ?>" name="contact" class="form-control">
 			</td>
 			<td>Email:<br/>
 				<input type="text" value="<?php echo $com['emailadd']; ?>" name="email" class="form-control">
 			</td>
 		</tr>

 		<tr>
 			<td colspan="2">
 			<p class="text-right">
 				<button class="btn btn-default btn-lg">Update</button>
 			</p>
 			</td>
 		</tr>

 	</table>
 </form>
<?php  }

 if (isset($_GET['changeusername'])) { ?>
 <h3>Change Username</h3>
<form action="username.php" method="POST">
  <table class="table table-condensed">
 <tr>
   <td>Username:<br/>
   <input type="password" name="username" class="form-control" >
   </td>
 </tr>
 <tr>
   <td>New Username:<br/>
   <input type="password" name="newusername" class="form-control" >
   </td>
 </tr>
 <tr>
   <td>Re-type New Username:<br/>
   <input type="password" name="renewusername" class="form-control" >
   </td>
 </tr>

    <tr>
      <td colspan="2">
      <p class="text-right">
        <button class="btn btn-success btn-lg">Update</button>
      </p>
      </td>
    </tr>

  </table>
 </form>
<?php }

 if (isset($_GET['changepassword'])) { ?>
 <h3>Change Password</h3>
<form action="password.php" method="POST">
  <table class="table table-condensed">
 <tr>
   <td>Password:<br/>
   <input type="password" name="password" class="form-control" >
   </td>
 </tr>
 <tr>
   <td>New Password:<br/>
   <input type="password" name="newpassword" class="form-control" >
   </td>
 </tr>
 <tr>
   <td>Re-type New Password:<br/>
   <input type="password" name="renewpassword" class="form-control" >
   </td>
 </tr>

    <tr>
      <td colspan="2">
      <p class="text-right">
        <button class="btn btn-success btn-lg">Update</button>
      </p>
      </td>
    </tr>

  </table>
 </form>
<?php }

 if (isset($_SESSION['message'])) {
 	# code...
 	echo $_SESSION['message'];
 	unset($_SESSION['message']);
 }
 ?>
 </div>
 <script type="text/javascript">
 	
 	$(document).ready(function(){

$('.btn-lg').click(function(){

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

$(".close").click(function(){
        $("#myAlert").alert("close");
    });

});
 </script>
 </body>
 </html>