<?php include 'auth.php';

$role=$_SESSION['role'];
//include 'add-sale.php';

include 'chk.php';

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
$conn = mysqli_connect("remotemysql.com", "x4dgwqYFZD", "trmhipYfns", "x4dgwqYFZD");

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
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <!-- Sidebar -->
    <?php
    $sql_add = mysqli_query($conn, "SELECT * FROM sales_order WHERE  invoice='$invs'");
    if (mysqli_num_rows($sql_add) <1){ ?>
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <img src="../assets/img/logo_small.png" alt=""/>
            </div>
            <div class="sidebar-brand-text mx-3"><?php

            if ($role==0){

                    $rol='Cashier';
                }else{
                    $rol='Admin';
                }

                echo $rol;


            ?></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
<?php if($role==1){?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Suppliers
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Manage Suppliers</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage suppliers:</h6>
                <a class="collapse-item" href="add-supplier">Add Supplier</a>
                <a class="collapse-item" href="view-supplier">View Supplier</a>

            </div>
        </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-list-ul"></i>
                <span>Products</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manage Products:</h6>
                    <a class="collapse-item" href="add-product.php?product-code=<?php echo $pdcode?>">Add Product</a>
                    <a class="collapse-item" href="product-catalogue.php">Add new product catalogue</a>
                    <a class="collapse-item" href="view-product.php">View Products</a>
                    <a class="collapse-item" href="category.php">Add Product category</a>
                    <a class="collapse-item" href="view-categories.php">Manage category</a>
                    <a class="collapse-item" href="">View Product stats</a>

                </div>
            </div>
        </li>
<?php }?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            SALE
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="sale.php?invoice=<?php echo $invcode?>" aria-controls="collapsePages">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Sale</span>
            </a>

        </li>
        <?php if($role==1){?>
        <!-- Nav Item - Charts -->
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Reports
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-file-excel"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header">View Reports :</h6>
                        <a class="collapse-item" href="sale-report">Sales Report</a>
                        <a class="collapse-item" href="View-supplierstats">Supplies Reports</a>
                        <a class="collapse-item" href="view-prodstats.php">Product Reports
                        <a class="collapse-item" href="unsale.php">Uncompleted sale Orders</a>

                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="manage-users.php">
                <i class="fas fa-fw fa-user-edit"></i>
                <span>Manage users</span></a>
        </li>
<?php }?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <?php }else{}?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'] ?></span>
                            <span class="fa fa-arrow-circle-down"></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Sale</h1>
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

                                        <div class="col-8">
                                            <?php $conn = mysqli_connect("remotemysql.com", "x4dgwqYFZD", "trmhipYfns", "x4dgwqYFZD");
                                            $p_results = mysqli_query($conn, "SELECT * FROM products");

                                            ?>
                                            <select name="prd" class="form-control form-control-user" required>
                                                <option></option>
                                                <?php

                                                for($i=0; $row = $p_results->fetch_assoc(); $i++){
                                                    ?>




                                                    <option value="<?php echo $row['id'];?>"><?php echo $row['p_code']; ?> - <?php echo $row['p_name']; ?>  | Price: <?php echo $row['selling_price']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>



                                        </div>

                                        <div class="col-2">
                                            <input type="number" name="qty" min="1" value="1" class="form-control form-control-user"  required>
                                        </div>

                                        <div class="col-2">
                                            <button type="submit" name="sale" class="btn btn-block btn-warning">Add</button>
                                        </div>










                                    </div>

                                </form>
                                <br>
                                <table class="table table-bordered" id="resultTable" data-responsive="table">
                                    <thead>
                                    <tr>
                                        <th> Product Name </th>
                                        <th> Unit </th>
                                        <th> Unit Price </th>
                                        <th> Qty </th>
                                        <th> Total Amount </th>
                                        <!-- <th> Profit </th>-->
                                        <th> Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $id=$_GET['invoice'];

                                    $sql = mysqli_query($conn, "SELECT * FROM sales_order WHERE invoice='$id'");
                                    for($i=1; $row = $sql->fetch_assoc(); $i++){
                                        ?>
                                        <tr class="record">
                                            <td hidden><?php echo $row['product']; ?></td>
                                            <td><?php echo $row['product_code']; ?></td>
                                            <td><?php echo $row['product']; ?></td>

                                            <td>
                                                <?php
                                                $ppp=$row['price'];
                                                echo formatMoney($ppp, true);
                                                ?>
                                            </td>
                                            <td><?php echo $row['qty'];

                                            $qty=$row['qty'];
                                            ?></td>
                                            <td>
                                                <?php
                                                $dfdf=$row['amount'];
                                                echo formatMoney($dfdf, true);
                                                ?>
                                            </td>
                                            <!-- <td> -->
                                            <!-- <?php
                                            //$profit=$row['profit'];
                                            //echo formatMoney($profit, true);
                                            ?> -->
                                            <!-- </td> -->
                                             <td><a href="delete_s.php?id=<?php echo $row['order_trans_id']; ?>&qty=<?php echo$qty;?>&pid=<?php echo $row['p_id'] ?>&inv=<?php echo $_GET['invoice'] ?>&pcode=<?php echo $row['product_code'] ?>"><button class="btn btn-mini btn-danger"><i class="fa fa-trash"></i></button></a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>

                                        <!-- <th>  </th> -->
                                        <!-- 			<td> Total Amount: </td>
                                                    <td> Total Profit: </td> -->
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"><strong style="font-size: 12px; color: #222222;">Grand Total:</strong></th>
                                        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                                                <?php
                                                function formatMoney($number, $fractional=false) {
                                                    if ($fractional) {
                                                        $number = sprintf('%.2f', $number);
                                                    }
                                                    while (true) {
                                                        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                                                        if ($replaced != $number) {
                                                            $number = $replaced;
                                                        } else {
                                                            break;
                                                        }
                                                    }
                                                    return $number;
                                                }
                                                $sdsd=$_GET['invoice'];
                                                $sqll = mysqli_query($conn, "SELECT sum(amount) FROM sales_order WHERE invoice='$sdsd'");

                                                for($i=0; $rowas = $sqll->fetch_assoc(); $i++){
                                                    $fgfg=$rowas['sum(amount)'];
                                                    echo formatMoney($fgfg, true);
                                                }
                                                ?>
                                            </strong></td>



                                        <!-- <th></th> -->
                                    </tr>

                                    </tbody>
                                </table>
<?php
$conn = mysqli_connect("remotemysql.com", "x4dgwqYFZD", "trmhipYfns", "x4dgwqYFZD");
$idc=$_GET['invoice'];
$sql2="select count(*) as total from sales_order where invoice='$idc'";
$result2=mysqli_query($conn,$sql2);
$data2=mysqli_fetch_assoc($result2);


if ($data2['total']<1) {
    ?>
    <div class="col-12">
        <button type="submit" name="checkout" data-toggle="modal" data-target="#checkout"
                class="btn btn-block btn-success" disabled>Check out
        </button>


    </div>
    <?php
}else{?>
                                <div class="col-12">
                                    <button type="submit" name="checkout" data-toggle="modal" data-target="#checkout"class="btn btn-block btn-success">Check out</button>
                               </div>
                                <?php }?>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="logout">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Check out Modal-->
<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Check Out</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                            <form method="post" action="">

            <div class="row">
                <div class="col-12">
                    <input type="text" name="customer" class="form-control form-control-user" placeholder="customer name" required>
                </div>

            </div>
                                <br>
<div class="row">
                                <div class="col-12">
                                        <input type="number" name="cash"  min="<?php echo $fgfg; ?>" value="<?php echo $fgfg; ?>" class="form-control form-control-user" placeholder="Cash" required>
                                    <input hidden type="number" name="casht"  min="<?php echo $fgfg; ?>" value="<?php echo $fgfg; ?>" class="form-control form-control-user" placeholder="Cash" required>

                                    </div>

                                </div>
                                <br>
                                <div class="text-right">
                                <button class="btn  btn-block btn-warning " type="submit" name="chk">Proceed</button>
                                </div>
                            </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
