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



if (isset($_POST['add_c'])) {
    // for the database
    $categ = stripslashes($_POST['categ']);


    $sql_e = "SELECT * FROM categories WHERE category='$categ'";

    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $msg = "Product category already exists";
        $msg_class = "text-danger";
    } else{
        if (empty($error)) {

            $sql = "INSERT INTO categories SET category='$categ'";
            if (mysqli_query($conn, $sql)) {
                $msg = "Category added successfully";
                $msg_class = "text-success";
            } else {
                $msg = "There was an error in the database";
                $msg_class = "text-danger";
            }
        }
    }}
