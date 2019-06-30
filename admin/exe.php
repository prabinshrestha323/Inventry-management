<!DOCTYPE html>
<html lang="en">
<?php
 include('../exe/database.php');
     $transactionid = $_GET['transactionID'];
     $check = mysqli_query($con,"SELECT * FROM `product_exe` WHERE transaction_id='$transactionid'");
     $count = mysqli_num_rows($check);

     if ($count == 0) {
       # code...
      header("Location:pos.php?transactionID=$transactionid");
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

      
    
  </div>


<script type="text/javascript">

    $('.btn-get').click(function(){
      var dataTRANS = $(this).attr('data-transac');
      var itemID = $(this).attr('data-item');
    window.open("item.php?transactionID="+dataTRANS+"&id="+itemID, "item", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=250,width=350,height=250");
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
