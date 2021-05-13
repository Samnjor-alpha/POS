<?php
$msg = "";
$msg_class = "";
$conn = mysqli_connect("localhost", "root", "", "pos");
$id=$_GET['id'];
$qty=$_GET['qty'];
$prd=$_GET['pid'];
$inv=$_GET['inv'];
$code=$_GET['pcode'];


$sql = mysqli_query($conn, "SELECT * FROM sales_order WHERE order_trans_id='$id'");

$stock = "UPDATE products    SET p_qty=p_qty+$qty WHERE id='$prd'";


mysqli_query($conn, $stock);
$stock2 = "UPDATE supplies    SET qty_remain=qty_remain-$qty WHERE product_code='$code'";
mysqli_query($conn, $stock2);



$sales = "DELETE FROM sales_order WHERE order_trans_id='$id'";

mysqli_query($conn, $sales);

header("location: sale.php?invoice=$inv");