<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
            $id = $_GET['id'];
            $plist = mysqli_query($con,"SELECT * FROM `product_list` where id = '$id'");
            $row = mysqli_fetch_assoc($plist);

            $transactionID = $_GET['transactionID'];
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
<?php
    $view = mysqli_query($con,"SELECT * FROM `product_exe` WHERE transaction_id = '$transactionID'");
    $count = mysqli_num_rows($view);
    $result = mysqli_fetch_assoc($view);
    $customer = $result['customer_code'];

    if ($count == 0) { ?>
      <div class="container">
        <div class="row">
        <h4>Select Customer</h4>
          <form role="form" action="" method="GET">
          <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
          <input type="hidden" name="transactionID" value="<?php echo $_GET['transactionID']; ?>" />
          <table class="table">
            <tr></tr>
            <tr>
              <td>
                <select class="form-control" name="customer_code" required>
                <?php
                      $viewcus = mysqli_query($con,"SELECT * FROM `tbl_customer`");
                       while ($rows = mysqli_fetch_assoc($viewcus)) { ?>
                        <option value="<?php echo $rows['code']; ?>">
                          <?php
                          echo $rows['name'];
                          ?>
                  </option>
                 <?php }
                 ?>
              </select>
              </td>
              <td>
                <button type="submit" name="submit_customer" class="btn btn-primary">Submit</button>
              </td>
            </tr>
            <tr>
              <td colspan="2"><p class="text-center"><small><a href="" class="btn btn-xs btn-danger btn-newcus" onclick="anc()">New Customer</a></small></p></td>
            </tr>
          </table>
              
          </form>

        </div>
      </div>


   <?php
    if (isset($_GET['submit_customer'])) {
      # code...
      $id = $_GET['id'];
      $transactionID = $_GET['transactionID'];
      $customer_code = $_GET['customer_code'];

      $insertcus = mysqli_query($con,"INSERT INTO `product_exe`(`id`, `transaction_id`, `customer_code`, `product_sku`, `quantity`, `price`, `total_price`, `transaction_date`) VALUES ('','$transactionID','$customer_code','','','','','')");

      header("Location:item.php?transactionID=$transactionID&id=$id");

    }
    }else{ ?>


<div class="container">
  <div class="row">
      <form action="" method="POST">
      <input type="hidden" id="sku" value="<?php echo $row['sku']; ?>" />
      <input type="hidden" id="price" value="<?php echo $row['price']; ?>" />
      <input type="hidden" id="customer" value="<?php echo $result['customer_code']; ?>" />
        <table class="table table-condensed">
          <tr class="bg-primary">
            <th>Quantity</th>
            <th></th>
          </tr>
          <tr>
            <td><input type="number" id="quantity" value="1" max="<?php echo $row['quantity']; ?>" min="1" class="form-control" required/>
            </td>
            <td><button class="btn btn-primary btn-get" data-trans="<?php echo $_GET['transactionID']; ?>">Enter</button></td>
          </tr>
        </table>
      </form>
      <table class="table table-condensed table-striped">
        <tr>
          <td colspan="2">Quantity on hand: <b><?php echo $row['quantity']; ?></b></td>
        </tr>
      </table>
  </div>
</div>
<?php } ?>

<script type="text/javascript">

    $('.btn-get').click(function(){
      var transactionID = $(this).attr('data-trans');
      var customer = $('#customer').val();
      var sku = $('#sku').val();
      var price = $('#price').val();
      var quantity = $('#quantity').val();

          $.post("add_item.php",
            {
                transactionID: transactionID,
                customer: customer,
                sku: sku,
                price: price,
                quantity: quantity
            },
            function(data, status){

              
                window.onunload = refreshParent;
                function refreshParent() {
                    window.opener.location.reload();
                }


               opener.location.href = 'pos.php?transactionID='+transactionID;
                close();

            });
    });

    function anc() {
    window.open("newcus.php", "new", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=50,width=400,height=500");
}
</script>

</body>
</html>

