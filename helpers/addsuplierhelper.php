<?php include '../auth/auth.php';

$role=$_SESSION['role'];

function createProductCode() {
    $chars = "003232303232023232023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 4) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }
    return $pass;
}
$pdcode='PCT-'.createProductCode();


$msg = "";
$msg_class = "";


if (isset($_POST['add_s'])) {
    // for the database
    $fname = stripslashes($_POST['fname']);
    $lname = stripslashes($_POST['lname']);
    $biz = stripslashes($_POST['biz']);
    $email = stripslashes($_POST['email']);
    $tel = stripslashes($_POST['tel']);
    $address = stripslashes($_POST['address']);
    $cash = stripslashes($_POST['cash']);
    $categ = stripslashes($_POST['categ']);


    $sql_e = "SELECT * FROM suppliers WHERE email='$email'";

    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $msg = "The email is already associated with a Supplier";
        $msg_class = "text-danger";
    } else {
        if (empty($error)) {

            $sql = "INSERT INTO suppliers SET category='$categ',fname='$fname',lname='$lname',address='$address',biz_name='$biz',cost_price='$cash',tel='$tel',email='$email'";
            if (mysqli_query($conn, $sql)) {
                $msg = "Supplier added successfully";
                $msg_class = "text-success";
            } else {
                $msg = "There was an error in the database";
                $msg_class = "text-danger";
            }
        }
    }
}