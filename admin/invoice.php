<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
 $id = $_GET['transactionID'];
 $transID = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE transaction_id = '$id'");
        $tr = mysqli_fetch_assoc($transID);
 $transactionlist = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE transaction_id = '$tr[transaction_id]'");
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

  <h3>Transaction ID: 
    <?php
        echo $tr['transaction_id'];
     ?>
  </h3>
  <h5>Customer Name:
    <?php
        $cusid = $tr['customer_code'];
        $cusname = mysqli_query($con,"SELECT * FROM `tbl_customer` WHERE code = '$cusid'");
        $cus = mysqli_fetch_assoc($cusname);

        $cusname =  $cus['name'];

        if ($cusname != '') {
          # code...
          echo $cusname;
        }else{
          echo "Customer is already deleted from database.";
        }
     ?>
  </h5>
  <hr/>
  <table class="table table-condensed">
      <thead>
            <tr class="bg-info">
              <th>PRODUCT NAME</th>
              <th>QUANTITY</th>
              <th>PRICE</th>
              <th>TOTAL PRICE</th>
              <th>TRANSACTION DATE</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($transactionlist)) { ?>
            <tr>
              <td>
                <?php
                  $sku = $row['product_sku'];
                  $pname = mysqli_query($con,"SELECT * FROM `product_list` WHERE sku = '$sku'");
                  $pnames = mysqli_fetch_assoc($pname);
                  echo $pnames['name'];
                 ?>
              </td>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo $row['price']; ?></td>
              <td><?php echo $row['total_price']; ?></td>
              <td><?php echo $row['transaction_date']; ?></td>
            </tr>
            <?php }
             ?>
             <tr>
              <td colspan="4"><p class="text-right">Sub Total:</p></td>
              <td>
                <?php
                   $count = mysqli_query($con,"SELECT SUM(total_price) AS TotalItemsPrice FROM transaction_list WHERE transaction_id = '$tr[transaction_id]'");
                     $qty = mysqli_fetch_assoc($count);
                     echo "<span class='glyphicon glyphicon-usd'></span> ".($qty['TotalItemsPrice'] + 0);
                ?>
              </td>
             </tr>
             <tr>
              <td colspan="4"><p class="text-right">Status:</p></td>
              <td>
                <?php
                  $invoice = mysqli_query($con,"SELECT * FROM `invoice` WHERE transaction_id = '$tr[transaction_id]'");
                  $status = mysqli_fetch_assoc($invoice);
                  echo $status['status'];
                 ?>
              </td>
             </tr>
             <tr>
              <td colspan="4"><p class="text-right">Balance:</p></td>
              <td>
                <span class='glyphicon glyphicon-usd'></span> <?php echo $status['balance']; ?>
              </td>
             </tr>
             <tr>
              <td colspan="5">
                <p class="text-right">
                  <a href="" data-name="<?php echo $tr['transaction_id']; ?>" class="btn btn-primary btn-new"><span class="glyphicon glyphicon-usd"></span> Payment</a>
                  <a href="excel.php?transactionID=<?php echo $tr['transaction_id']; ?>" class="btn btn-success"><span class="glyphicon glyphicon-save-file"></span> Excel</a>
                  <a target="_blank" href="print_receipt_all.php?transactionID=<?php echo $tr['transaction_id']; ?>" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Print</a>
                </p>
              </td>
             </tr>
          </tbody>
  </table>
           
</div>
<script>

$(document).ready(function(){

$('.btn-new').click(function(){
var page = $(this).attr('data-name');
    window.open("payment.php?transactionID="+page, "new", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=50,width=400,height=500");

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
