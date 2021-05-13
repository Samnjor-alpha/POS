<?php

$alert = "";
$alert_class = "";
$conn = mysqli_connect("localhost", "root", "", "pos");

$sql3="select *  from products where p_qty <10";
$result3=mysqli_query($conn,$sql3);
$data3=mysqli_fetch_assoc($result3);

if (mysqli_num_rows($result3) > 0) {
    $alert = "You are  out of stock<br> <a href='view-inventory.php' class='btn btn-primary'><span class='fa fa-plus'></span>Manage inventory here</a>";
    $alert_class = "alert-danger";

}
$tod= new DateTime(date('Y-m-d'));

$dt1=$tod->format('Y-m-d');
$sql4="select *  from products where expiry_date='$dt1' and p_qty >=10";
$result4=mysqli_query($conn,$sql4);
$data4=mysqli_fetch_assoc($result4);

if (mysqli_num_rows($result4) > 0) {
    $alert = "Some products ae about to expire<br> <a href='view-inventory.php' class='btn btn-primary'><span class='fa fa-plus'></span>Manage inventory here</a>";
    $alert_class = "alert-danger";

}