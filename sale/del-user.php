<?php
$msg = "";
$msg_class = "";
$conn = mysqli_connect("localhost", "root", "", "pos");
$id=$_GET['delete_s'];






$users = "DELETE FROM admin WHERE id='$id'";

mysqli_query($conn, $users);

$msg='Deleted successfully';
$msg_class="text-success";

header("location:view-users.php");