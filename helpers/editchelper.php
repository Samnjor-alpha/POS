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

$categ = $_GET['edit-category'];
$sql = mysqli_query($conn, "SELECT * FROM categories WHERE id='$categ'");
$c_row = $sql->fetch_assoc();

$c_id = $c_row['id'];

if (isset($_POST['u_c'])) {
    // for the database
    $categ = stripslashes($_POST['categ']);


    $sql_e = "SELECT * FROM categories WHERE category='$categ' and not id= $c_id";

    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $msg = "Product category already exists";
        $msg_class = "text-danger";
    } else{
        if (empty($error)) {

            $sql = "Update categories SET category='$categ' where id= $c_id";
            if (mysqli_query($conn, $sql)) {
                $msg = "Category updated successfully";
                $msg_class = "text-success";
            } else {
                $msg = "There was an error in the database";
                $msg_class = "text-danger";
            }
        }
    }}
?>