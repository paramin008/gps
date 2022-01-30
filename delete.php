
<?php 

include('config.php');

$rider_id = null;

        if (isset($_GET["rider_id"]))
    {
        $rider_id = $_GET["rider_id"];
    }
        $sql = "delete from gps_track where rider_id = '".$rider_id."' ";

        

        $query = mysqli_query($con,$sql);

        if($query){
            
            echo "<script>alert('ลบเรียบร้อยแล้ว')</script>";
            
            echo "<script>window.open('admin.php','_self')</script>";
            
        }
       
?>




