<?php

$msg = "";
$msg_class = "";
$conn = mysqli_connect("localhost", "root", "", "pos");


if (isset($_POST['add_c'])) {
    // for the database
    $categ = stripslashes($_POST['categ']);


    $sql_e = "SELECT * FROM categories WHERE category='$categ'";

    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $msg = "Product category already exists";
        $msg_class = "text-danger";
    } else{
        if (empty($error)) {

            $sql = "INSERT INTO categories SET category='$categ'";
            if (mysqli_query($conn, $sql)) {
                $msg = "Category added successfully";
                $msg_class = "text-success";
            } else {
                $msg = "There was an error in the database";
                $msg_class = "text-danger";
            }
        }
    }}