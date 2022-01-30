<?php

$con = mysqli_connect("localhost", "root", "", "gps");

if (mysqli_connect_errno($con)) {
    echo "ไม่สามารถติดต่อฐานข้อมูล MySQL ได้" . mysqli_connect_error();
    exit;
}
mysqli_set_charset($con, 'utf8');
date_default_timezone_set("Asia/Bangkok");
