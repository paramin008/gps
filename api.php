<?php
session_start();
include('config.php');

?>
<!DOCTYPE html>
<html>
  <head>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

   <link href="css/bootstrap.css" rel="stylesheet">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
  </head>
  <html>
    
   
   <div id="content" class="container">

<div class="row">

<div class='col-md-12'>
        
        <div class='product'>
        <p class='col-md-12'>
              
            </p>
            <?php
include ('config.php');
	
$sql = "SELECT * FROM gps_track ";
$query = mysqli_query($con,$sql);
$result = mysqli_fetch_array($query);
$num_row = mysqli_num_rows($query);

$per_page = 2;  

	if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
	$page=1;
}

$Prev_Page = $page-1;
$Next_Page = $page+1;

$page_Start = (($per_page*$page)-$per_page);
if($num_row<=$per_page)
{
	$Num_Pages =1;
}
else if(($num_row % $per_page)==0)
{
	$Num_Pages =($num_row/$per_page) ;
}
else
{
	$Num_Pages =($num_row/$per_page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$sql .=" order  by rider_id ASC LIMIT $page_Start , $per_page";
$query  = mysqli_query($con,$sql);
?>

<div align="right"> <a class="btn btn-danger btn-sm" href="logout.php" role="button">ออกจากระบบ</a> </div>
<table  class="table table-bordered" border="0">
<p></p>
<br>
                <tbody align="center">
                    <tr  class='text-dark'>
                        <td >ลำดับ</td>
                        <td>ละติจูด</td>
                        <td>ลองจิจูด</td>
                        <td>ไอพี</td>
                        <td>เวลา</td>
                         <td >ดูพิกัด</td>
                        <td >ลบ</td>
                       
                    </tr>
                    <?php
                    $i= 1 ;
while($result = mysqli_fetch_array($query))    
{
?>
      <tr> 
          <td  ><?php echo $i; ?></td>     
          <td> <?php echo $result["track_lat"]; ?> </td>
          <td ><?php echo $result["track_lng"]; ?></td>
          <td><?php echo $result["ipaddress"]; ?></td>
          <td ><?php echo $result["track_time"]; ?></td>
          <td>	<a href="https://www.google.com/maps/search/<?php echo $result["track_lat"];?>+<?php echo $result["track_lng"];?>" target="_blank"><i class="fa fa-map-marker" ></i> ดูพิกัด</a> </td>
          <td>	<a href="JavaScript:if(confirm('ต้องการลบทั้งหมดใช่หรือไม่')==true){window.location='delete.php?rider_id=<?php echo $result["rider_id"];?>';}"><i class="fa fa-trash"></i> ลบ</a> </td>
      </tr>
     
      <?php
      $i++;
    } ?>
  </tbody>
</table>
<br>
Total <?= $num_row;?> Record : <?=$Num_Pages;?> Page :
<?php
if($Prev_Page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
}

for($i2=1; $i2<=$Num_Pages; $i2++){
	if($i2 != $page)
	{
		echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i2'>$i2</a> ]";
	}
	else
	{
		echo "<b> $i2 </b>";
	}
}
if($page!=$Num_Pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
}
?>
</div>
  
  </div>
 <center>
 
  <a  class="btn btn-outline-danger" href="JavaScript:if(confirm('ต้องการลบ?')==true){window.location='delete_all.php';}" role="button">ลบทั้งหมด</a>
 </center>
  
</div>

</div>
  </body>
</html>
