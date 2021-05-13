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

if ($role ==0){

    header("location:sale.php?invoice=$invcode");
}


$msg = "";
$msg_class = "";



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
if (isset($_POST['add_p'])) {
    // for the database
    $pcode=$_GET['product-code'];
    $pname= stripslashes($_POST['p_name']);

    $biz = stripslashes($_POST['biz']);

    $categ=stripslashes($_POST['categ']);
    $cp=stripslashes($_POST['cp']);
    $sp=stripslashes($_POST['sp']);
    $qty = stripslashes($_POST['qty']);
    $mfg= stripslashes($_POST['mfg']);
    $exp= stripslashes($_POST['exp']);

    $date1 = new DateTime($mfg);
    $dt1=$date1->format('Y-m-d');

    $date2 = new DateTime($exp);
    $dt2=$date2->format('Y-m-d');

    if($dt1 > $dt2){

        $msg="The product is expired.Check the dates";
        $msg_class="text-danger";
    }else{


        $sql_e = "SELECT * FROM products WHERE p_code='$pcode'";


        $res_e = mysqli_query($conn, $sql_e);
        if (mysqli_num_rows($res_e) > 0) {
            $msg = "A product with that product code already exists";
            $msg_class = "text-danger";
            header("Location:dashboard.php");
        } else{
            if (empty($error)) {

                $sql = "INSERT INTO products SET p_code='$pcode',p_name='$pname',p_categeory='$categ',cost_price='$cp',selling_price='$sp',p_qty='$qty',p_supplier='$biz',date_delivered=NOW(),mfg_date='$mfg',expiry_date='$exp'";
                if (mysqli_query($conn, $sql)) {
                    $msg = "Product added successfully";
                    $msg_class = "text-success";

                    $sql_es = "SELECT * FROM supplies WHERE invoice='$invcode'";
                    $res_es = mysqli_query($conn, $sql_es);
                    if (mysqli_num_rows($res_es) > 0) {
                        $msg = "An error Occurred adding supplies";
                        $msg_class = "text-danger";
                        header("Location:dashboard.php");
                    }
                    $amount=$qty * $cp;
                    $sql_s = "INSERT INTO supplies SET product_code='$pcode',product_name='$pname',category='$categ',cost_price='$cp',p_qty='$qty',supplier='$biz',date_delivered=NOW(),invoice='$invcode',amount='$amount',qty_remain='$qty'";
                    mysqli_query($conn, $sql_s);

                    header("Location:add-product?product-code=$invcodes.php");
                }else {
                    $msg = "There was an error in the database";
                    $msg_class = "text-danger";
                }
            }
        }}}
