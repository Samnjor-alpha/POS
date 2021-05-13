<?php

function createOrdCode() {
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
$tcncode='ORD'.createOrdCode();

$msg = "";
$msg_class = "";



if (isset($_POST['sale'])) {
//    // for the database
//    $id=$_POST['id'];
//    $code=$_POST['p_code'];
    $inv=$_GET['invoice'];
    $prd= stripslashes($_POST['prd']);
    $qty= stripslashes($_POST['qty']);
//    $sp= stripslashes($_POST['cash']);
//    $bp=stripslashes($_POST['cp']);

//    $ps_results = mysqli_query($conn, "SELECT * FROM products where p_id='$prd'");

    $sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$prd'");
    for($i=0; $rowas = $result_prin->fetch_assoc(); $i++) {
        $ps_row = $sql->fetch_assoc();
        $pname = $ps_row['p_name'];

        $code = $ps_row['p_code'];
        $sp = $ps_row['selling_price'];
        $bp = $ps_row['cost_price'];
    }
    $profit=$qty*($sp-$bp);
$tamount= $qty*$sp;





    $sql_e = "SELECT * FROM sales_order WHERE order_trans_id='$tcncode'";

    $res_e = mysqli_query($conn, $sql_e);

    if (mysqli_num_rows($res_e) > 0) {
        $msg = "The transaction id  is already associated with a transaction";
        $msg_class = "text-danger";
    } else{
        if ($qty >= $ps_row['p_qty']){

            $msg = "Insufficient items in the inventory";
            $msg_class = "text-danger";

        }else{
        if (empty($error)) {
            $stock = "UPDATE products    SET p_qty=p_qty-$qty WHERE id='$prd'";
            $stock2 = "UPDATE supplies    SET qty_remain=qty_remain-$qty WHERE product_code='$code'";

            mysqli_query($conn, $stock);
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
    }}}