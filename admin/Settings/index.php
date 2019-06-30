<!DOCTYPE html>
<html lang="en">
<?php
 include('../../exe/database.php');
 ?>
<head>
  <title>Settings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
    	height: auto;
    }
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
    	position:relative;
    	bottom:0px;
    	width: 100%;
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>Inventory System</h4>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="../"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="../Products"><span class="glyphicon glyphicon-list"></span> Manage Products</a></li>
        <li><a href="../Customers"><span class="glyphicon glyphicon-user"></span> Customers</a></li>
        <li><a href="../Suppliers"><span class="glyphicon glyphicon-tasks"></span> Supliers</a></li>
      	<li class="active"><a href="#Settings"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
        <li><a href="../Logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
      </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search here.." disabled="disabled" title="Nothing to search here">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button" disabled="disabled" title="Nothing to search here">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>

    <div class="col-sm-9">
      <h4><small>SETTINGS</small></h4>
      <hr>

  <div class="row">

    <div class="col-lg-4">
                <div class="panel panel-default">
                  <div class="panel-heading">Company Details</div>
                  <div class="panel-body">
                    <?php
                        $company = mysqli_query($con,"SELECT * FROM `comapny`");
                        $com = mysqli_fetch_assoc($company);                        
                     ?>
                     <table class="table table-condensed">
                     <tr>
                       <td>Name:</td>
                       <td>
                         <?php echo $com['name']; ?>
                       </td>
                     </tr>

                     <tr>
                       <td>Address:</td>
                       <td>
                         <?php echo $com['address']; ?>
                       </td>
                     </tr>

                     <tr>
                       <td>Contact:</td>
                       <td>
                         <?php echo $com['contact']; ?>
                       </td>
                     </tr>
                     <tr>
                       <td>Email:</td>
                       <td>
                         <?php echo $com['emailadd']; ?>
                       </td>
                     </tr>
                     </table>
                  </div>
                  <div class="panel-footer"><p class="text-right"><a href="#" data-page="company" class="btn btn-default btn-lg">Change</a></p></div>
                </div>
    </div>
                
    <div class="col-lg-4">
                <div class="panel panel-success">
                  <div class="panel-heading">Change Username</div>
                  <div class="panel-footer"><p class="text-right"><a href="#" data-page="changeusername" class="btn btn-success btn-lg">Change</a></p></div>
                </div>
    </div>

     <div class="col-lg-4">
                <div class="panel panel-primary">
                  <div class="panel-heading">Change Password</div>
                  <div class="panel-footer"><p class="text-right"><a href="#" data-page="changepassword" class="btn btn-primary btn-lg">Change</a></p></div>
                </div>
    </div>

  </div>

  </div>
                           
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p><?php include('../../exe/footer.php'); ?></p>
</footer>
<script type="text/javascript">
  $(document).ready(function(){
  $('.btn-lg').click(function(){
    var page = $(this).attr('data-page');
    window.open("action.php?"+page, "action", "toolbar=no,scrollbars=no,resizable=no,top=100,left=500,width=800,height=500");
  });
});
</script>
</body>
</html>
