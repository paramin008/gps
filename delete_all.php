<?php
include('config.php');  
$sql = "DELETE FROM gps_track";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
?>







