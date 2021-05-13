<?php

$msg = "";
$msg_class = "";


$id = $_GET['delete-sale'];
$code=$_GET['p_id'];
$qty=$_GET['qty'];

$sql = mysqli_query($conn, "SELECT * FROM products WHERE p_code  ='$code'");
if (mysqli_num_rows($sql) <1){
    $salesn = "DELETE FROM sales_order WHERE order_id='$id'";

    if (mysqli_query($conn, $salesn)) {
        $msg = "Supplier deleted successfully";
        $msg_class = "text-success";

        header("location: unsale.php");
    } else {
        $msg = "An error occurred";
        $msg_class = "text-danger";
        header("location: unsale.php");
    }


}else {


    $stock = "UPDATE products    SET p_qty=p_qty+$qty WHERE p_code='$code'";
    mysqli_query($conn, $stock);

    $stock2 = "UPDATE supplies    SET qty_remain=qty_remain+$qty WHERE product_code='$code'";
    mysqli_query($conn, $stock2);

    $sales = "DELETE FROM sales_order WHERE order_id='$id'";

    if (mysqli_query($conn, $sales)) {
        $msg = "Supplier deleted successfully";
        $msg_class = "text-success";

        header("location: unsale.php");
    } else {
        $msg = "An error occurred";
        $msg_class = "text-danger";
        header("location: unsale.php");
    }

}



?>