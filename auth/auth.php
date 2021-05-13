<?php
session_start();


//$conn = mysqli_connect("remotemysql.com", "x4dgwqYFZD", "trmhipYfns", "x4dgwqYFZD");
$conn = mysqli_connect("remotemysql.com", "x4dgwqYFZD", "trmhipYfns", "x4dgwqYFZD");
$msg = "";
$msg_class = "";
if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $msg = "complete fields!";
        $msg_class="alert-danger";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "select * from admin where username='$username'";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (password_verify($_POST['password'], $row['password'])) {


                $_SESSION['id'] = $row['id'];// Password matches, so create the sessions
                $_SESSION['user'] = $row['username'];
                $_SESSION['role']=$row['role'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];


//                $sql = "UPDATE admin SET LAST_LOGIN = NOW() WHERE ADM_ID=".$_SESSION['id']."";

//                if ($connection->query($sql) === TRUE) {
//                    echo "Record updated successfully";
//                } else {
//                    echo "Error updating record: " . $connection->error;
//                }


                header('Location:../sale/dashboard.php');


            } else {
                $msg = "Incorrect username or password";
                $msg_class = "alert-danger";
            }
        }
        $conn->close();

    }
}
?>