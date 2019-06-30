<?php
	$q = $_GET['q'];
	header("Location:../Products/?page=1&per-page=5&q=$q&search");
 ?>