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
                    <h1 class="h3 mb-0 text-gray-800">Uncompleted sales</h1>
                    <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                </div>

                <!-- Content Row -->



                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Uncompleted Sales</h6>
                            </div>

                            <div class="card-body">
                                <?php if (!empty($msg)): ?>
                                    <span class="<?php echo $msg_class?>"><?php echo $msg; ?></span>
                                    <br>
                                <?php endif; ?>
                                <?php
                                $s_results = mysqli_query($conn, "SELECT * FROM sales_order where complete='0'");

                                if (mysqli_num_rows($s_results) <1) {
                                    echo"<div class='alert  alert-warning table-responsive'>";
                                    echo"<p>All sales order were completed</p>";
                                    echo"</div>";
                                    echo"<a class='btn btn-block btn-info' href='sale.php?invoice=$invcode'><span class='fa fa-plus'></span> Sale</a>";
                                }else{

                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered"  >
                                        <thead>
                                        <tr>
                                            <th>Order id</th>
                                            <th>Invoice</th>
                                            <th>Product Code</th>
                                            <th>product</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Action</th>


                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php while ($c_row = $s_results->fetch_assoc()) {?>
                                            <tr>
                                                <td class="text-center"><?php echo $c_row['order_trans_id'];?></td>
                                                <td class="text-center"><?php echo $c_row['invoice'];?></td>
                                                <td class="text-center"><?php echo $c_row['product_code'];?></td>
                                                <td class="text-center"><?php echo $c_row['product'];?></td>
                                                <td class="text-center"><?php echo $c_row['qty'];  ?></td>
                                                <td class="text-center"><?php echo $c_row['amount'];  ?></td>
                                                <td class="text-center"><?php echo $c_row['date'];  ?></td>

                                                <td class="text-center">






 <a class="dropdown-item text-danger" href="del-sale.php?delete-sale=<?php echo $c_row['order_id']; ?>&p_id=<?php echo $c_row['product_code'] ?>&qty=<?php echo $c_row['qty'] ?>"><span class=" fa  fa-trash"></span> Delete</a>



                                                </td>
                                            </tr>
                                        <?php } }?>
                                        </tbody>
                                    </table>
                                </div>
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
