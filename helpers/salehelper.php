<?php include '../auth/auth.php';

$role=$_SESSION['role'];
//include 'add-sale.php';



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


function createOrdCode()
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

$tcncode = 'ORD' . createOrdCode();

$msg = "";
$msg_class = "";


$invs = $_GET['invoice'];
if (isset($_POST['sale'])) {
//    // for the database
//    $id=$_POST['id'];
//    $code=$_POST['p_code'];
    $inv = $_GET['invoice'];
    $prd = stripslashes($_POST['prd']);
    $qty = stripslashes($_POST['qty']);
//    $sp= stripslashes($_POST['cash']);
//    $bp=stripslashes($_POST['cp']);
    if (empty($qty))
    {
        $msg="Item Quantity can not be empty";
        $msg_class="text-danger";
    }

//    $ps_results = mysqli_query($conn, "SELECT * FROM products where p_id='$prd'");

    $sqlp= mysqli_query($conn, "SELECT * FROM products WHERE id='$prd'");
    for($i=0; $ps_row = $sqlp->fetch_assoc(); $i++) {
//        $ps_row = $sql->fetch_assoc();
        $pname = $ps_row['p_name'];

        $code = $ps_row['p_code'];
        $sp = $ps_row['selling_price'];
        $bp = $ps_row['cost_price'];
        $qtyp=$ps_row['p_qty'];

//        $profit=$qty*($sp-$bp);
    }
    $profit=$qty*($sp-$bp);

    $tamount = $qty * $sp;

    $sql_add = mysqli_query($conn, "SELECT * FROM sales_order WHERE product_code='$code'and invoice='$inv'");

    if ($qty >= $qtyp) {

        $msg = "Insufficient items in the inventory";
        $msg_class = "text-danger";

    }
    if (mysqli_num_rows($sql_add) >0){
        $ups_row = $sql_add->fetch_assoc();
        $sql_e = "SELECT * FROM sales_order WHERE order_trans_id='$tcncode'";

        $res_e = mysqli_query($conn, $sql_e);
        $pcd= $ups_row['product_code'];

        if ($qty >= $qtyp) {

            $msg = "Insufficient items in the inventory";
            $msg_class = "text-danger";

        }else {
            if (empty($error)) {
                $stock = "UPDATE products    SET p_qty=p_qty-$qty WHERE id='$prd'";
                mysqli_query($conn, $stock);
                $tamount = $qty * $sp;
                $profit=$qty*($sp-$bp);
                $add_ord = "UPDATE sales_order    SET qty=qty+$qty ,profit=profit+$profit,amount=amount+$tamount WHERE product_code='$code' and invoice='$inv'";
                mysqli_query($conn, $add_ord);

                $stock2 = "UPDATE supplies    SET qty_remain=qty_remain-$qty WHERE product_code='$code'";

                mysqli_query($conn, $stock2);

            }}}else {

        $sql_e = "SELECT * FROM sales_order WHERE order_trans_id='$tcncode'";

        $res_e = mysqli_query($conn, $sql_e);

        if (mysqli_num_rows($res_e) > 0) {
            $msg = "The transaction id  is already associated with a transaction";
            $msg_class = "text-danger";
        } else {


            if ($qty >= $qtyp) {

                $msg = "Insufficient items in the inventory";
                $msg_class = "text-danger";

            } else {


                if (empty($error)) {
                    $stock = "UPDATE products    SET p_qty=p_qty-$qty WHERE id='$prd'";
                    mysqli_query($conn, $stock);
                    $stock2 = "UPDATE supplies    SET qty_remain=qty_remain-$qty WHERE product_code='$code'";

                    mysqli_query($conn, $stock2);

                    $sql = "INSERT INTO sales_order SET order_trans_id='$tcncode',invoice='$inv',product='$pname',p_id='$prd',amount='$tamount',Profit='$profit', price='$sp',qty='$qty',product_code='$code', date=NOW()";
                    if (mysqli_query($conn, $sql)) {
                        header("location: sale.php?invoice=$inv");
                        $msg = " added successfully";
                        $msg_class = "text-success";


                    } else {
                        $msg = "There was an error in the database";
                        $msg_class = "text-danger";
                    }
                }
            }
        }


    }







}


$msg = "";
$msg_class = "";

$role = $_SESSION['role'];
if ($role = 1) {
    $rolee = "admin";
} else {
    $rolee = "cashier";
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
    $cust = stripslashes($_POST['customer']);
    $cash = stripslashes($_POST['cash']);
    $inv = $_GET['invoice'];
    $cash1 = stripslashes($_POST['casht']);

    $balance = $cash - $cash1;


    $sqlp = mysqli_query($conn, "SELECT sum(profit)FROM sales_order WHERE invoice='$inv'");

    $ps_row = $sqlp->fetch_assoc();

    $profit = $ps_row['sum(profit)'];


    $sql_e = "SELECT * FROM sales WHERE invoice_number='$inv'";

    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $msg = "The invoice is already checked in";
        $msg_class = "text-danger";
    } else {
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
    }
}