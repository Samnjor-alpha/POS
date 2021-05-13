<?php
require_once("DBController.php");
$db_handle = new DBController();


if (!empty($_POST["username"])) {
    $query = "SELECT * FROM admin WHERE username='" . $_POST["username"] . "'";
    $user_count = $db_handle->numRows($query);
    if ($user_count > 0) {
        echo "<span class='text-danger'> Username is already taken.</span>";
    } else {
        echo "<span class='text-success'> Username Available.</span>";
    }
}
?>