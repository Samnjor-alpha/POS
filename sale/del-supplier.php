<?php

$msg = "";
$msg_class = "";


$id = $_GET['delete_s'];

$sqlw = "DELETE FROM suppliers WHERE id='$id'";

mysqli_query($conn, $sqlw);
if (mysqli_query($conn, $sqlw)) {
    $msg = "Supplier deleted successfully";
    $msg_class = "text-success";

    header("Location:view-supplier.php");
} else {
    $msg = "An error occurred";
    $msg_class = "text-danger";
    header("Location:view_supplier.php");
}


?>