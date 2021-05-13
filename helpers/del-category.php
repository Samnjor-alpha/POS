<?php

$msg = "";
$msg_class = "";
include '../auth/auth.php';

$id = $_GET['delete-category'];

$sql = "DELETE FROM categories WHERE id='$id'";


if (mysqli_query($conn, $sql)) {
    $msg = "Category deleted successfully";
    $msg_class = "text-success";


} else {
    $msg = "An error occurred";
    $msg_class = "text-danger";
    header("Location:category.php");
}


?>