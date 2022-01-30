<?php
include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$sql = "SELECT * FROM gps_track  WHERE rider_id = '" . $_GET["rider_id"] . "' ";
$query = mysqli_query($con, $sql) or die("Error Query [" . $sql . "]");
$result = mysqli_fetch_array($query);

?>
<?php echo $result["track_lat"]; ?> <br>
<?php echo $result["track_lng"]; ?>
</body>
</html>

<td>   <a href= "https://www.google.com/maps/search/<?php echo $result["track_lat"]; ?>+<?php echo $result["track_lng"]; ?>
    </td>