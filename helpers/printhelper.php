<?php include '../auth/auth.php';

$role=$_SESSION['role'];


$invoice = $_GET['invoice'];

$sqll = "SELECT * FROM sales WHERE invoice_number= '$invoice'";
$result_print = mysqli_query($conn, $sqll);
for ($i = 0; $row = $result_print->fetch_assoc(); $i++) {
    $cname = $row['c_name'];
    $invoice = $row['invoice_number'];
    $date = $row['s_date'];

    $cashier = $row['cashier'];
    $customer=$row['c_name'];

    $cash= $row['cash'];
    $am = $row['amount'];
    $number= $row['balance'];

}


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

function createInvCode() {
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
$invcode='INV-'.createInvCode();
?>