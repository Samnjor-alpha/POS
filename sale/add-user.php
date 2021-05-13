<?php
$msg = "";
$msg_class = "";
$conn = mysqli_connect("localhost", "root", "", "pos");
if (isset($_POST['add_user'])) {
    // for the database
    $fname = stripslashes($_POST['fname']);
    $lname = stripslashes($_POST['lname']);
    $username = stripslashes($_POST['username']);
    $email = stripslashes($_POST['email']);
    $pwd = stripslashes($_POST['pwd']);
    $role= stripslashes($_POST['role']);




    $sql_e = "SELECT * FROM admin WHERE email='$email'";

    $res_e = mysqli_query($conn, $sql_e);



    // check if passwords match


        if (mysqli_num_rows($res_e) > 0) {
            $msg = "Email is already associated with an account";
            $msg_class = "text-danger";
        } else {
            $hash = password_hash($pwd, PASSWORD_DEFAULT);

            // For image upload

            // Upload image only if no errors
            if (empty($error)) {

                $sql = "INSERT INTO admin SET fname='$fname',lname='$lname',username='$username',role='$role',email='$email',password='$hash'";
                if (mysqli_query($conn, $sql)) {
                    $msg = "Registered successfully";
                    $msg_class = "text-success";
                } else {
                    $msg = "There was an error in the database";
                    $msg_class = "text-danger";
                }
            }
        }


}
?>
