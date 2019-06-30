<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
$transactionID = $_GET['transactionID'];
 $pending = mysqli_query($con,"SELECT * FROM `product_exe`");
 $result = mysqli_fetch_assoc($pending);
 if ($result['transaction_id'] != $transactionID) {
   # code...
     
      $pendingtransactionid = $result['transaction_id'];

      if ($pendingtransactionid != '') {

      header("Location:pos.php?transactionID=$pendingtransactionid&ongoing");
      }
 }
  ?>
<head>
  <title>Inventory System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
  <div>

      <div style="position: fixed;left:5px;width:40%;height:600px;overflow: auto;">

           <h3>Customers Transaction</h3>

      <div class="panel panel-primary">
        <div class="panel-heading">Transaction ID: <b><?php echo $_GET['transactionID']; ?></b></div>
        <div class="panel-body">
          <table class="table table-condensed">
            <tr>
              <th class="text-right">Quantity:</th>
              <td class="text-left">
                <?php $count = mysqli_query($con,"SELECT SUM(quantity) AS TotalItemsOrdered FROM product_exe");
                $qty = mysqli_fetch_assoc($count);
                echo $qty['TotalItemsOrdered'] + 0;
                 ?>
              </td>
            </tr>
            <tr>
              <th class="text-right">Price:</th>
              <td class="text-left">
                <?php $count = mysqli_query($con,"SELECT SUM(total_price) AS TotalItemsPrice FROM product_exe");
                $qty = mysqli_fetch_assoc($count);
                echo "<span class='glyphicon glyphicon-usd'></span> ".($qty['TotalItemsPrice'] + 0);
                 ?>
              </td>
            </tr>
          </table>
        </div>
        <div class="panel-footer"></div>
      </div>
      </div>

      <div style="position: fixed;top:35%;width: 40%;height:350px;overflow: auto;border-style: inset;">
      <table class="table table-condensed">
       <tr>
        <td colspan="6">
          <?php if (isset($_GET['ongoing'])) { ?>
            <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Info!</strong> Pending transaction.
          </div>
         <?php  }
            if (isset($_SESSION['message'])) {
              # code...
              echo $_SESSION['message'];
              unset($_SESSION['message']);
            }
          ?>
        </td>
      </tr>
        <tr>
          <th>Sku</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
          <th></th>
        </tr>
        <?php

          $transac_exe = mysqli_query($con,"SELECT * FROM `product_exe` WHERE transaction_id = '$transactionID'");
          while ($row = mysqli_fetch_assoc($transac_exe)) { ?>
            <tr>
              <td><?php echo $row['product_sku']; ?></td>
              <td>
                <?php
                  $sku = $row['product_sku'];
                  $transac_list = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku = '$sku'");
                  $result = mysqli_fetch_assoc($transac_list);
                 echo $result['name'];
                  ?>
              </td>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo $row['price']; ?></td>
              <td><?php echo $row['total_price']; ?></td>
              <td><a href="min_item.php?transactionID=<?php echo $_GET['transactionID']; ?>&sku=<?php echo $row['product_sku']; ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-minus"></span></a> <a title="Delete this item" href="delete.php?transactionID=<?php echo $_GET['transactionID']; ?>&sku=<?php echo $row['product_sku']; ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a></td>
            </tr>
         <?php }
         ?>
      </table>
        
      </div>

      <div style="position: fixed;right:5px;width:55%;height:100px;overflow: auto;">

            <h3>Product List</h3>
      <form>
        <input type="text" class="form-control" placeholder="Search Product here...">
      </form>

      </div>

      <div style="position: fixed;bottom:10%;right:5px;width:55%;height:550px;overflow: auto;border-style: inset;">
      <table class="table table-condensed table-striped">
     
        <tr>
          <th>SKU</th>
          <th>Name</th>
          <th>On Hand</th>
          <th>Price</th>
          <th></th>
        </tr>
        <?php
            $plist = mysqli_query($con,"SELECT * FROM `product_list`");
            while ($row = mysqli_fetch_assoc($plist)) { ?>
            <tr>
              <td><?php echo $row['sku']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo $row['price']; ?></td>
              <td><a href="#" data-item="<?php echo $row['id']; ?>" data-transac="<?php echo $_GET['transactionID']; ?>" title="Add Item" class="btn btn-primary btn-xs btn-get"><span class="glyphicon glyphicon-plus-sign"></span></a></td>
            </tr>
          <?php  }
         ?>
      </table>
        
      </div>

            <div style="position: absolute;bottom:5px;bottom:7%;left:5px;width:40%;overflow: auto;">
            <p class="text-right">
                      <a href="cancel.php?transactionID=<?php echo $transactionID; ?>" class="btn btn-danger btn-lg">Cancel</a>
                      <a href="save.php?transactionID=<?php echo $transactionID; ?>" class="btn btn-primary btn-lg">Submit</a>
            </p>
            </div>

    
  </div>


<script type="text/javascript">

    $('.btn-get').click(function(){
      var dataTRANS = $(this).attr('data-transac');
      var itemID = $(this).attr('data-item');
    window.open("item.php?transactionID="+dataTRANS+"&id="+itemID, "item", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=550,width=350,height=200");
    });

    $('.btn-lg').click(function(){
    window.onunload = refreshParent;
          function refreshParent() {
              window.opener.location.reload();
          }
});

</script>

</body>
</html>
