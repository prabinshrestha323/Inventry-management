<?php
 include('../exe/database.php');
        if (isset($_GET['submit'])) {
          # code...
            $transactionID = $_GET['transactionID'];
            $selectinvoice = mysqli_query($con,"SELECT * FROM `invoice` WHERE transaction_id = '$transactionID'");
            $row = mysqli_fetch_assoc($selectinvoice);
            $balance = $row['balance'];
            $payment = $_GET['payment'];
            $dnow = date("Y-m-d h:i:sa");

            if ($payment >= $balance) {
              $fullpaid = mysqli_query($con,"UPDATE `invoice` SET `balance`='0',`status`='paid' WHERE transaction_id = '$transactionID'");
              $insert = mysqli_query($con,"INSERT INTO `payments`(`id`, `transaction_id`, `balance`, `amount_paid`, `transaction_date`) VALUES ('','$transactionID','$balance','$payment','$dnow')");

              $_SESSION['payment_message'] = '
              <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Transaction saved.
              </div>
              ';
            }else{
              $total = $balance - $payment;
              $fullpaid = mysqli_query($con,"UPDATE `invoice` SET `balance`='$total',`status`='unpaid' WHERE transaction_id = '$transactionID'");
              $insert = mysqli_query($con,"INSERT INTO `payments`(`id`, `transaction_id`, `balance`, `amount_paid`, `transaction_date`) VALUES ('','$transactionID','$balance','$payment','$dnow')");

              $_SESSION['payment_message'] = '
              <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Transaction saved.
              </div>
              ';
            }

            header("Location:payment.php?transactionID=$transactionID");
        }
         ?>