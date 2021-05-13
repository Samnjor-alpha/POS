<?php include '../auth/auth.php';
include "../sale/check-inventory.php";
$role=$_SESSION['role'];



$sql="select count(*) as total from sales";
$result=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($result);
$sql2="select count(*) as total from suppliers";
$result2=mysqli_query($conn,$sql2);
$data2=mysqli_fetch_assoc($result2);






$sql3="select sum(p_qty) as total from products";
$result3=mysqli_query($conn,$sql3);
$data3=mysqli_fetch_assoc($result3);

$sql4="select count(*) as total from categories";
$result4=mysqli_query($conn,$sql4);
$data4=mysqli_fetch_assoc($result4);
$sql5="select sum(profit) as total from sales";
$result5=mysqli_query($conn,$sql5);
$data5=mysqli_fetch_assoc($result5);
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
?>