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
$invcodsde='S-INV-'.createSInvCode();
$msg = "";
$msg_class = "";

$prod= $_GET['prod-id'];
$sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$prod'");
$c_row = $sql->fetch_assoc();

$c_id = $c_row['id'];

if (isset($_POST['u_p'])) {
    // for the database
    $pid=$_GET['prod-id'];
    $pname= stripslashes($_POST['pname']);
$biz = stripslashes($_POST['biz']);
//
    $categ=stripslashes($_POST['categ']);
    $cp=stripslashes($_POST['cp']);
    $sp=stripslashes($_POST['sp']);
    $qty = stripslashes($_POST['qty']);
    $mfg= stripslashes($_POST['mfg']);
    $exp= stripslashes($_POST['exp']);
    $amount=$qty * $cp;




        if (empty($error)) {

            $sql = "update products SET p_code='$pdcode',p_qty=p_qty+$qty,cost_price='$cp',selling_price='$sp',date_delivered=NOW(),mfg_date='$mfg',expiry_date='$exp' where id='$pid'";
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

                $sql_s = "INSERT INTO supplies SET product_code='$pdcode',product_name='$pname',category='$categ',cost_price='$cp',p_qty='$qty',supplier='$biz',date_delivered=NOW(),invoice='$invcodsde',amount='$amount',qty_remain='$qty'";
                mysqli_query($conn, $sql_s);
            }else {
                $msg = "There was an error in the database";
                $msg_class = "text-danger";
            }
        }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
     <? include '../public/salestyles.php'?>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

     <!-- Sidebar -->
<? include '../navs/sidenav.php'?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <? include '../navs/topbar.php'?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Product stock</h1>
                    <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-12 col-md-12 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <?php if (!empty($msg)): ?>
                                    <span class="<?php echo $msg_class?>"><?php echo $msg; ?></span>
                                    <br>
                                <?php endif; ?>
                                <form method="post" action="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="text"  name="pname" class="form-control form-control-user" value="<?php echo $c_row['p_name'] ?>" placeholder="Product Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                           <?php
                                            $categ_results = mysqli_query($conn, "SELECT * FROM categories");
                                                ?>
                                                <select  name="categ" class="form-control form-control-user">
<?php while ($cs_row = $categ_results->fetch_assoc()) {?>
                                                        <option><?php  echo $cs_row['category']?></option>
                                                 <?php }?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
<?php
                                                $s_results = mysqli_query($conn, "SELECT * FROM suppliers");


//                                                ?>
                                                <select  name="biz" class="form-control form-control-user" >
<?php while ($s_row = $s_results->fetch_assoc()) {?>
                                                        <option><?php  echo $s_row['biz_name']?></option>
<?php }?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">

                                                <input type="text" name="cp" class="form-control form-control-user" value="<?php echo $c_row['cost_price'] ?>" placeholder="cost price">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">

                                                <input type="text" name="sp" class="form-control form-control-user" value="<?php echo $c_row['selling_price'] ?>" placeholder="Selling price">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">

                                                <input type="number" name="qty" class="form-control form-control-user" value="<?php echo $c_row['p_qty'] ?>" min="2" placeholder="No. Of items">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="mfg">Manufacture Date</label>
                                            <div class="form-group">

                                                <input type="date" id="mfg" name="mfg" class="form-control form-control-user" value="<?php echo $c_row['mfg_date'] ?>" >
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exp">Expiry Date</label>
                                                <input type="date" id="exp" name="exp" value="<?php echo $c_row['expiry_date'] ?>"class="form-control form-control-user">
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-block btn-info" name="u_p"><span class="fa fa-plus"></span> Add Stock </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Content Row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
           <br>
                    <br>
                    <hr>
        <!-- Footer -->
          <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; POS 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<? include '../navs/logoutmodal.php'?><!-- Bootstrap core JavaScript-->
<? include '../public/salescripts.php'; ?>

</body>

</html>
