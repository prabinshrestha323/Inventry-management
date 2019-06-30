<!DOCTYPE html>
<html lang="en">
<?php
 include('../../exe/database.php');
  ?>
<head>
  <title>Manage Suppliers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    tr td:first-child ,td:nth-child(2n), td:nth-child(4n), td:nth-child(5n), td:last-child{
    width:1%;
    white-space:nowrap;
}
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
      position: relative;
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
        <li class="active"><a href="#Suppliers"><span class="glyphicon glyphicon-tasks"></span> Supliers</a></li>
      	<li><a href="../Settings"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
        <li><a href="../Logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
      </ul><br>
      <form action="search.php" method="GET">
      <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search suppliers here..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit" name="search">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
      </form>
    </div>

    <div class="col-sm-9">
      <h4><small>MANAGE SUPPLIERS</small></h4>
      <hr>

      	<div class="container-fluid">
          <div class="row">
            <div class="col-sm-3">
              <a href="#" class="btn btn-primary btn-xl" onclick="anp()">Add new supplier</a>
            </div>
            <div class="col-sm-9">
            </div>
          </div>
        </div>
        <hr/>
          <?php 
 if (isset($_GET['q'])) {
            # code...
  $q = $_GET['q'];
  if (isset($_GET['page']) && isset($_GET['per-page'])) {
                 $page  = $_GET['page'];
                 $perpage  = $_GET['per-page'];

                 $result = mysqli_query($con,"SELECT COUNT(code) FROM product_supplier WHERE code LIKE '%$q%' OR name LIKE '%$q%' OR address LIKE '%$q%'"); 
                  $row = mysqli_fetch_row($result); 
                  $total_records = $row[0]; 
                  $total_pages = ceil($total_records / $perpage);

                 if ($_GET['page'] == 0 || $_GET['per-page'] == 0) {
                   # code...
                    header("Location:?page=1&per-page=5&q=$q&search");

                 }
                 if ($total_pages < $_GET['page']) {
                   # code...
                  if ($total_records == 0) {
                    # code...
                    $_SESSION['empty-row'] = "0 supplier to display. Add Suplier.";
                  }else{
                    header("Location:?page=1&per-page=5&q=$q&search");
                  }
                 }
            }
             else { 

              header("Location:?page=1&per-page=5&q=$q&search");
 
            }
          $start_from = ($page-1) * $perpage;

          $productsupplier = mysqli_query($con,"SELECT * FROM product_supplier WHERE code LIKE '%$q%' OR name LIKE '%$q%' OR address LIKE '%$q%' ORDER BY id DESC LIMIT $start_from, $perpage");
          }else{

          if (isset($_GET['page']) && isset($_GET['per-page'])) {
                 $page  = $_GET['page'];
                 $perpage  = $_GET['per-page'];

                 $result = mysqli_query($con,"SELECT COUNT(code) FROM product_supplier"); 
                  $row = mysqli_fetch_row($result); 
                  $total_records = $row[0]; 
                  $total_pages = ceil($total_records / $perpage);

                 if ($_GET['page'] == 0 || $_GET['per-page'] == 0) {
                   # code...
                    header("Location:?page=1&per-page=5");

                 }
                 if ($total_pages < $_GET['page']) {
                   # code...
                  if ($total_records == 0) {
                    # code...
                    $_SESSION['empty-row'] = "0 supplier to display. Add Suplier.";
                  }else{
                    header("Location:?page=1&per-page=5");
                  }
                 }
            }
             else { 

              header("Location:?page=1&per-page=5");
 
            }
          $start_from = ($page-1) * $perpage;

          $productsupplier = mysqli_query($con,"SELECT * FROM product_supplier ORDER BY id DESC LIMIT $start_from, $perpage");
          } 
          ?> 
        <table class="table table-condensed table-bordered table-hover">
        <thead>
        <tr class="bg-primary">
          <th class="text-danger">
              <select class="per-page" data-page="<?php echo $_GET['page']; ?>">
                <option><?php echo $_GET['per-page']; ?></option>
                <option>5</option>
                <option>10</option>
                <option>15</option>
                <option>20</option>
                <option>25</option>
                <option>30</option>
                <option>35</option>
                <option>40</option>
                <option>45</option>
                <option>50</option>
                <option>55</option>
                <option>60</option>
                <option>65</option>
                <option>70</option>
                <option>75</option>
                <option>80</option>
                <option>85</option>
                <option>90</option>
                <option>95</option>
                <option>100</option>
              </select>
          </th>
        </tr>
        </thead>
          <thead>
            <tr>
              <th>Code</th>
              <th>Name</th>
              <th>Address</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
          <td colspan="8">
          <?php
            if (isset($_SESSION['empty-row'])) {
              # code...
              echo $_SESSION['empty-row'];
              unset($_SESSION['empty-row']);
            }
           ?>
           </td>
              <?php
                while ($row = mysqli_fetch_assoc($productsupplier)) { ?>
                <tr class="text-info">
                  <td><?php echo $row['code']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  <td><?php echo $row['semail']; ?></td>
                  <td><?php echo $row['scontact']; ?></td>
                  <td>
                  <p class="text-center">
                    <a href="#" class="btn btn-xs btn-info" data-page="edit" data-name="<?php echo $row['id']; ?>" title="Click this if you want to edit all the information for this suppler."><span class="glyphicon glyphicon-edit"></span></a>
                    <a href="#" class="btn btn-xs btn-danger" data-page="delete" data-name="<?php echo $row['id']; ?>" title="Click this if you want to delete this suppler."><span class="glyphicon glyphicon-trash"></span></a>
                  </p>
                  </td>
                </tr>
                <?php }
               ?>
               <tr>
                 
               </tr>
          </tbody>
        </table>
 
        <ul class="pagination pagination-sm">

        <?php for ($i=1; $i<=$total_pages; $i++) { ?>
                      <li class="<?php
                        if ($_GET['page'] == $i) {
                          # code...
                          echo "active";
                        }
                       ?>"><a href="?page=<?php echo $i; ?>&per-page=<?php echo $perpage;?>"><?php echo $i; ?></a></li>
       <?php }
        ?>
        </ul>

    </div>
  </div>
</div>

<footer class="container-fluid">
  <p><?php include('../../exe/footer.php'); ?></p>
</footer>

<script>
function anp() {
    window.open("new.php", "new", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=50,width=400,height=500");
}

$(document).ready(function(){
  $('.btn-xs').click(function(){
    var page = $(this).attr('data-page');
    var id = $(this).attr('data-name');
    window.open("action.php?id="+id+"&"+page, "action", "toolbar=no,scrollbars=no,resizable=no,top=100,left=500,width=800,height=500");
  });

  $('.per-page').change(function(){
    var perpage = $(this).val();
    var page = $(this).attr('data-page');
    window.location.replace("?page="+page+"&per-page="+perpage);
  });
});
</script>
</body>
</html>
