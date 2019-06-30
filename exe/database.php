<?php
session_start();
	date_default_timezone_set("Asia/Taipei");
error_reporting(0);
$con = mysqli_connect("localhost","root","","inventory");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $mycompany = mysqli_query($con,"SELECT * FROM `comapny`");
 	$mcompany = mysqli_fetch_assoc($mycompany);

		  function limitstring($x, $length)
		{
		  if(strlen($x)<=$length)
		  {
		    echo $x;
		  }
		  else
		  {
		    $y=substr($x,0,$length) . '...';
		    echo $y;
		  }
		}

?>