<?php

$msg = "";
$msg_class = "";
$conn = mysqli_connect("localhost", "root", "", "pos");
$role=$_SESSION['role'];
if($role=1){
    $rolee="admin";
}else{
    $rolee="cashier";
}
function createTransCode()
{
    $chars = "003232303232023232023456789";
    srand((double)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 4) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }
    return $pass;
}

$transid = 'TRNS' . createOrdCode();

if (isset($_POST['chk'])) {
    // for the database
    $cust= stripslashes($_POST['customer']);
    $cash= stripslashes($_POST['cash']);
$inv= $_GET['invoice'];
$cash1=stripslashes($_POST['casht']);

$balance= $cash- $cash1;


    $sqlp = mysqli_query($conn, "SELECT sum(profit)FROM sales_order WHERE invoice='$inv'");

    $ps_row = $sqlp->fetch_assoc();

    $profit= $ps_row['sum(profit)'];



    $sql_e = "SELECT * FROM sales WHERE invoice_number='$inv'";

    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $msg = "The invoice is already checked in";
        $msg_class = "text-danger";
    } else{
        if (empty($error)) {

            $sql = "INSERT INTO sales SET 	transaction_id ='$transid', cashier='$rolee',invoice_number='$inv',c_name='$cust', cash='$cash',amount='$cash1',balance='$balance',profit='$profit',s_date=NOW()";
if (mysqli_query($conn, $sql)) {
    $stock2 = "UPDATE sales_order   SET complete='1' WHERE invoice='$inv'";

    $stock2 = mysqli_query($conn, $stock2);

                $msg = "Checked in  successfully";
                $msg_class = "text-success";
                header("location: print.php?invoice=$inv");

            } else {
                $msg = "There was an error in the database";
                $msg_class = "text-danger";
                header("location: sale.php?invoice=$inv");
            }
        }
    }}