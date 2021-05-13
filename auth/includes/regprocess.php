<?php
$msg = "";
$msg_class = "";
$conn = mysqli_connect("localhost", "root", "", "pos");
if (isset($_POST['reg'])) {
    // for the database
    $fname = stripslashes($_POST['firstname']);
    $lname = stripslashes($_POST['lastname']);
    $username = stripslashes($_POST['username']);
    $email = stripslashes($_POST['email']);
    $pwd = stripslashes($_POST['password']);
    $cpwd = stripslashes($_POST['confirmPassword']);



    $sql_e = "SELECT * FROM admin WHERE email='$email'";

    $res_e = mysqli_query($conn, $sql_e);



    // check if passwords match
    if ($pwd !== $cpwd) {
        $msg = "The passwords do not match";
        $msg_class = "alert-danger";
    } elseif ($pwd == $cpwd) {

        if (mysqli_num_rows($res_e) > 0) {
            $msg = "Email is already associated with an account";
            $msg_class = "alert-danger";
        } else {
            $hash = password_hash($pwd, PASSWORD_DEFAULT);

            // For image upload

            // Upload image only if no errors
            if (empty($error)) {

                    $sql = "INSERT INTO admin SET fname='$fname',lname='$lname',username='$username',email='$email',password='$hash'";
                    if (mysqli_query($conn, $sql)) {
                        $msg = "Registered successfully";
                        $msg_class = "alert-success";
                    } else {
                        $msg = "There was an error in the database";
                        $msg_class = "alert-danger";
                    }
                }
            }
        }

}
?>
