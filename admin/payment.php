<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
 $transactionID = $_GET['transactionID'];
 $transactionlist = mysqli_query($con,"SELECT * FROM `transaction_list` WHERE transaction_id = '$transactionID'");
 $cuscode = mysqli_fetch_assoc($transactionlist);
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
        echo $_GET['transactionID'];
     ?>
  </h3>
  <h5>Customer Name:
    <?php
        $cusid = $cuscode['customer_code'];
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
  <h2>Balance: <span class='glyphicon glyphicon-usd'></span> 
    <?php
        $invoice = mysqli_query($con,"SELECT * FROM `invoice` WHERE transaction_id = '$cuscode[transaction_id]'");
        $status = mysqli_fetch_assoc($invoice);
        echo $status['balance'];
    ?>
  </h2>
  <hr/>
        <?php
        if (isset($_SESSION['payment_message'])) {
            # code...
            echo $_SESSION['payment_message'];
            unset($_SESSION['payment_message']);
          }
         if ($status['balance'] == 0) { ?>
         <table>
           <tr>
             <p>
               <a href="print_receipt.php?transactionID=<?php echo $transactionID; ?>" target="_blank" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Print Receipt</a>
            </p>
           </tr>
         </table>
      <?php  }else { ?>
          <form role="form" method="GET" action="payment_exe.php">
              <div class="form-group">
                <input type="hidden" name="transactionID" value="<?php echo $_GET['transactionID']; ?>">
                <input class="form-control input-lg" id="inputlg" name="payment" type="number" step="0.001" min="1" autofocus="autofocus" required>
              </div>
              <div class="form-group">
                <p class="text-right"><button class="btn btn-lg btn-primary" type="submit" name="submit">Submit</button></p>
              </div>
        </form>
          <?php } ?>
</div>
<script>

$(document).ready(function(){
opener.location.reload();
$('.btn').click(function(){
opener.location.reload(); // or opener.location.href = opener.location.href;
  //window.close(); // or self.close();
});

});
</script>
</body>
</html>
