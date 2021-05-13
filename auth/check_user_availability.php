<?php
require_once 'auth.php';



if (!empty($_POST["username"])) {
    $query = "SELECT * FROM admin WHERE username='" . $_POST["username"] . "'";
  $user_count=mysqli_query($conn,$query);
    if (mysqli_num_rows($user_count) > 0) {
        echo "<span class='text-danger'> Username is already taken.</span>";
    } else {
        echo "<span class='text-success'> Username Available.</span>";
    }
}
?>