<?php include 'auth.php';

$role=$_SESSION['role'];
include 'add-prod.php';

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

                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search products..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

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
                    <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
                    <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                </div>

                <!-- Content Row -->



                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Products inventory</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered"  >
                                        <thead>
                                        <tr>
                                            <th>product Code</th>
                                            <th>Product Name</th>
                                            <th>Company</th>
                                            <th>Categories</th>
                                            <th>Buying Price</th>
                                            <th>Selling Price</th>
                                            <th>Quantity</th>
                                            <th>profit</th>
                                            <th>Available</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <?php $conn = mysqli_connect("remotemysql.com", "x4dgwqYFZD", "trmhipYfns", "x4dgwqYFZD");
                                        $s_results = mysqli_query($conn, "SELECT * FROM products");
                                        ?>

                                        <tbody>
                                        <?php while ($c_row = $s_results->fetch_assoc()) {?>
                                            <tr>
                                                <td class="text-center"><?php echo $c_row['p_code'];?></td>
                                                <td class="text-center"><?php echo $c_row['p_name'];?></td>
                                                <td class="text-center"><?php echo $c_row['p_supplier'];?></td>
                                                <td class="text-center"><?php echo $c_row['p_categeory'];?></td>
                                                <td class="text-center">Ksh. <?php echo $c_row['cost_price'];  ?></td>
                                                <td class="text-center">Ksh. <?php echo  $c_row['selling_price'];  ?></td>
                                                <td class="text-center"><?php echo $c_row['p_qty'];  ?></td>
                                                <td class="text-center">Ksh. <?php $profit=($c_row['p_qty']*$c_row['selling_price'])-($c_row['p_qty']*$c_row['cost_price']);
                                                echo $profit;?></td>
                                                <td class="text-center"><?php
                                                    $p_id=$c_row['id'];
                                                    $sql2="select sum(p_qty) as total from products where id='$p_id'";
                                                    $result2=mysqli_query($conn,$sql2);
                                                    $data2=mysqli_fetch_assoc($result2);
                                                    $itemcount=$data2['total'];
                                                    if($itemcount <=20){
                                                        $status="<p class='text-warning'>Running out of stock</p>";
                                                    }if ($itemcount <=4){
                                                        $status="<p class='text-danger'>Out of stock</p>";
                                                    }if($itemcount >20){
                                                        $status="<p class='text-success'>Product available</p>";
                                                    }


                                                    echo $status;  ?></td>
                                                <td class="text-center">



                                                    <div class="dropdown no-arrow mb-4">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Choose Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="add-stock.php?prod-id=<?php echo $c_row['id']; ?>"><span class="fa fa-plus"></span> Add Stock</a>
                                                            <a class="dropdown-item" href="edit-product.php?edit-product=<?php echo $c_row['id']; ?>"><span class="fa fa-edit"></span> Edit</a>
                                                            <a class="dropdown-item" href="del-product.php?delete-product=<?php echo $c_row['id']; ?>"><span class="fa fa-trash"></span> Delete</a>

                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        <?php }?>
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
