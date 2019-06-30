<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
 ?>
<head>
  <title>Inventory System</title>
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
        <li class="active"><a href="#Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="Products"><span class="glyphicon glyphicon-list"></span> Manage Products</a></li>
        <li><a href="Customers"><span class="glyphicon glyphicon-user"></span> Customers</a></li>
        <li><a href="Suppliers"><span class="glyphicon glyphicon-tasks"></span> Supliers</a></li>
        <li><a href="Settings"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
        <li><a href="Logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
      </ul><br>
      <form action="search.php" method="GET">
      <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search Transaction ID here..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit" name="search">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
        </form>
    </div>

    <div class="col-sm-9">
      <h4><small>MENU</small></h4>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <button onclick="pos()" class="btn btn-primary btn-lg" autofocus><span class="glyphicon glyphicon-shopping-cart"></span> Sell product</button>
        </div>
        <div class="col-sm-9">

          <div class="row">
            <div class="col-sm-6">
              <div class="panel panel-success">
                <div class="panel-heading"><p class="text-center">Number of ITEMs SOLD</p></div>
                <div class="panel-body"><p class="text-center">
                  <?php $count = mysqli_query($con,"SELECT SUM(quantity) AS TotalItemsOrdered FROM transaction_list");
                    $qty = mysqli_fetch_assoc($count);
                    echo $qty['TotalItemsOrdered'] + 0;
                 ?>
                </p></div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="panel panel-danger">
                <div class="panel-heading"><p class="text-center">Total Sales</p></div>
                <div class="panel-body"><p class="text-center">
                  <?php $count = mysqli_query($con,"SELECT SUM(total_price) AS TotalItemsPrice FROM transaction_list");
                  $qty = mysqli_fetch_assoc($count);
                  echo "<span class='glyphicon glyphicon-usd'></span> ".($qty['TotalItemsPrice'] + 0);
                   ?>
                </p></div>
              </div>
            </div>
          </div>
        
        </div>
      </div>
      <hr/>
 <!--............................................start.....................................................................-->     
      <h4><small>TRANSACTION LIST</small></h4>


<?php
	if (isset($_GET['q'])) {
		# code...
		$q = $_GET['q'];
		 if (isset($_GET['page']) && isset($_GET['per-page'])) {
                 $page  = $_GET['page'];
                 $perpage  = $_GET['per-page'];

                 $result = mysqli_query($con,"SELECT COUNT(id) FROM transaction_list WHERE transaction_id LIKE '%$q%'"); 
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
                    $_SESSION['empty-row'] = "0 Transaction.";
                  }else{
                    header("Location:?page=1&per-page=5&q=$q&search");
                  }
                 }
            }
             else { 

              header("Location:?page=1&per-page=5&q=$q&search");
 
            }
          $start_from = ($page-1) * $perpage;

          $customer = mysqli_query($con,"SELECT * FROM transaction_list WHERE transaction_id LIKE '%$q%' ORDER BY id DESC LIMIT $start_from, $perpage"); 
	}else{

 if (isset($_GET['page']) && isset($_GET['per-page'])) {
                 $page  = $_GET['page'];
                 $perpage  = $_GET['per-page'];

                 $result = mysqli_query($con,"SELECT COUNT(id) FROM transaction_list"); 
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
                    $_SESSION['empty-row'] = "0 Transaction.";
                  }else{
                    header("Location:?page=1&per-page=5");
                  }
                 }
            }
             else { 

              header("Location:?page=1&per-page=5");
 
            }
          $start_from = ($page-1) * $perpage;

          $customer = mysqli_query($con,"SELECT * FROM transaction_list ORDER BY id DESC LIMIT $start_from, $perpage"); 
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
              <th>TRANSACTION ID</th>
              <th>CUSTOMER NAME</th>
              <th>PRODUCT NAME</th>
              <th>QUANTITY</th>
              <th>PRICE</th>
              <th>TOTAL PRICE</th>
              <th>TRANSACTION DATE</th>
              <th>ACTION</th>
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
                while ($row = mysqli_fetch_assoc($customer)) { ?>
                <tr class="text-info">
                  <td><?php echo $row['transaction_id']; ?></td>
                  <td title="<?php echo $row['customer_code']; ?>">
                    <?php
                    $code = $row['customer_code'];
                     $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `tbl_customer` WHERE code='$code'"));
                     echo $result['name'];
                      ?>
                  </td>
                  <td title="<?php echo $row['product_sku']; ?>">
                    <?php
                    $sku = $row['product_sku'];
                     $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `product_list` WHERE sku='$sku'"));
                     echo $result['name'];
                      ?>
                  </td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><?php echo $row['price']; ?></td>
                  <td><?php echo $row['total_price']; ?></td>
                  <td><?php echo $row['transaction_date']; ?></td>
                  <td>
                  <p class="text-center">
                    <a href="#" class="btn btn-xs btn-primary" data-page="view" data-name="<?php echo $row['id']; ?>" title="Click this if you want to view this transaction."><span class="glyphicon glyphicon-eye-open"></span></a>
                  </p>
                  </td>
                </tr>
                <?php }
               ?>

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
 

<!--END HERE.................................................................................................-->
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p><?php include('../exe/footer.php'); ?></p>
</footer>


<script type="text/javascript">
  function pos() {
    var invoicenumber = Math.floor((Math.random() * 99999) + 99999);
    window.open("pos.php?transactionID="+invoicenumber, "pos", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width=1500,height=1500");
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
