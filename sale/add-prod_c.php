<?php

$msg = "";
$msg_class = "";
$conn = mysqli_connect("localhost", "root", "", "pos");


function createSInvCode() {
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
$invcode='S-INV-'.createSInvCode();
function createpInvCode() {
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
$invcodes='PCT-'.createpInvCode();
if (isset($_POST['add_pc'])) {
    // for the database

    $pname= stripslashes($_POST['pname']);

    $sp=stripslashes($_POST['sp']);


    $desc= stripslashes($_POST['pdesc']);
    $unit= stripslashes($_POST['unit']);

    $sql_e = "SELECT * FROM p_menu WHERE p_name='$pname'";


    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $msg = "The product already exists";
        $msg_class = "text-danger";

    }else{



            if (empty($error)) {

                $sql = "INSERT INTO p_menu SET p_name='$pname',units='$unit',price='$sp',p_desc='$desc'";
                if (mysqli_query($conn, $sql)) {
                    $msg = "Product added successfully";
                    $msg_class = "text-success";

                    }

                }else {
                    $msg = "There was an error in the database";
                    $msg_class = "text-danger";
                }

        }}
