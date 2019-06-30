<?php
	$q = $_GET['q'];
	header("Location:../admin/?page=1&per-page=5&q=$q&search");
 ?>