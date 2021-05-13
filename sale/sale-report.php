<?php include 'auth.php';

$role=$_SESSION['role'];
$conn = mysqli_connect("remotemysql.com", "x4dgwqYFZD", "trmhipYfns", "x4dgwqYFZD");
$sql="select count(*) as total from sales";
$result=mysqli_query($conn,$sql);

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
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
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
            <div class="container-fluid" id="">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Sales Report</h1>

                </div>


    <form method="post" action="" >
        <div class="row d-sm-flex align-items-center justify-content-between mb-auto">

            <div class="col-4">
                <div class="form-group">
                    <label for="dt1">From:</label>
        <input type="date" id="dt1" name="d1" class="form-control form-control-user" required>
        </div>
            </div>

        <div class="col-4">
<div class="form-group">
    <label for="dt2">To:</label>
          <input type="date" id="dt2" name="d2" class="form-control form-control-user" value="<?php echo date('Y-m-d'); ?>" >
        </div>
        </div>

            <div class="col-4">
                <button type="submit" name="sale_q" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>

            </div>
    </form>










</div>
                <!-- Content Row -->
            <br>
            <br>
            <div class="container-fluid" id="divToPrint">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
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
                        if (isset($_POST['sale_q'])){

                        $date = new DateTime($_POST['d1']);
                        $dt1=$date->format('Y-m-d');

                        $date2 = new DateTime($_POST['d2']);
                        $dt2=$date2->format('Y-m-d');


                        $sql_sale = "SELECT * FROM sales WHERE s_date BETWEEN '$dt1' AND '$dt2' ORDER by sale_id DESC ";
                        $result_sale = mysqli_query($conn, $sql_sale);
                        if (mysqli_num_rows($result_sale) <1) {
                        echo"<div class='alert  alert-warning alert-dismissible'>";
                            echo"<p>No sales report in that duration</p>";
                            echo"</div>";
                        }else{


                        ?>
            <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
                <thead>
                <tr>
                    <th> Transaction ID </th>
                    <th > Transaction Date </th>
                    <th > Customer Name </th>
                    <th> Invoice Number </th>
                    <th> Amount </th>
                    <th> Profit </th>
                </tr>
                </thead>
                <tbody>

                <?php
                for ($i = 0; $row_sale = $result_sale->fetch_assoc(); $i++) {
?>
                    <tr class="record">
                        <td><?php echo $row_sale['transaction_id']; ?></td>
                        <td><?php echo $row_sale['s_date']; ?></td>
                        <td><?php echo $row_sale['c_name']; ?></td>
                        <td><?php echo $row_sale['invoice_number']; ?></td>
                        <td><?php
                            $dsdsd = $row_sale['amount'];
                            echo formatMoney($dsdsd, true);
                            ?></td>
                        <td><?php
                            $zxc = $row_sale['profit'];
                            echo formatMoney($zxc, true);
                            ?></td>
                    </tr>

<?php }?>
                </tbody>
                <thead>
                <tr>
                    <th colspan="4" style="border-top:1px solid #999999"> Total:</th>
                    <th colspan="1" style="border-top:1px solid #999999">
                        <?php


                         $date = new DateTime($_POST['d1']);
                $dt1=$date->format('Y-m-d');
                
                        $date2 = new DateTime($_POST['d2']);
                $dt2=$date2->format('Y-m-d');
                        $sqlt = "SELECT sum(amount) FROM sales WHERE s_date BETWEEN '$dt1' AND '$dt2'";
                        $result_sal = mysqli_query($conn, $sqlt);
                        for ($i = 0; $rows = $result_sal->fetch_assoc(); $i++) {
                            $dsdsd = $rows['sum(amount)'];
                            echo formatMoney($dsdsd, true);
                        }
                        ?>
                    </th>
                    <th colspan="1" style="border-top:1px solid #999999">
                        <?php
                        $sdl = "SELECT sum(profit) FROM sales WHERE s_date BETWEEN '$dt1' AND '$dt2'";
                        $result_al = mysqli_query($conn, $sdl);
                        for ($i = 0; $cxz = $result_al->fetch_assoc(); $i++) {
                            $zxc = $cxz['sum(profit)'];
                            echo formatMoney($zxc, true);
                        }
                        }
                        ?>

                    </th>
                </tr>
                </thead>
            </table>
                            <?php


                       echo'<div class="container-fluid">';

        echo'<button type="submit" onclick="PrintDiv();" class="btn btn-sm btn-success"><i class="fas fa-print fa-sm text-white-50"></i> Print Report</button>';
        echo'</div>';}
                        ?>
                <!-- Content Row -->
                    </div>
                </div>
            </div>
        </div>
        <br>

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
