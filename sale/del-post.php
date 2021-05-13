<?php

$msg = "";
$msg_class = "";
$conn = mysqli_connect("remotemysql.com", "x4dgwqYFZD", "trmhipYfns", "x4dgwqYFZD");

$id = $_GET['delete-category'];

$sql = "DELETE FROM categories WHERE id='$id'";


if (mysqli_query($conn, $sql)) {
    $msg = "Category deleted successfully";
    $msg_class = "text-success";

    header("Location:category.php");
} else {
    $msg = "An error occurred";
    $msg_class = "text-danger";
    header("Location:category.php");
}


?>