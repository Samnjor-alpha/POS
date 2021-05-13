<?php include 'auth.php';

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
$conn = mysqli_connect("localhost", "root", "", "pos");
$sup= $_GET['edit-category'];
$sql = mysqli_query($conn, "SELECT * FROM suppliers WHERE id='$sup'");
$s_row = $sql->fetch_assoc();

$c_id = $s_row['id'];

if (isset($_POST['u_s'])) {
    // for the database
    $c_id = $s_row['id'];
    $fname= stripslashes($_POST['fname']);
    $lname= stripslashes($_POST['lname']);
    $biz = stripslashes($_POST['biz']);
    $email=stripslashes($_POST['email']);
    $tel=stripslashes($_POST['tel']);
$address=stripslashes($_POST['address']);
    $cash=stripslashes($_POST['cash']);
    $categ = stripslashes($_POST['categ']);


    $sql_e = "SELECT * FROM suppliers WHERE email='$email' and not id=$c_id";

    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $msg = "The email is already associated with a Supplier";
        $msg_class = "text-danger";
    } else{
        if (empty($error)) {

            $sql = "UPDATE suppliers SET category='$categ',fname='$fname',lname='$lname',address='$address',biz_name='$biz',cost_price='$cash',tel='$tel',email='$email' where id='$c_id'";
            if (mysqli_query($conn, $sql)) {
                $msg = "Supplier updated successfully";
                $msg_class = "text-success";
            } else {
                $msg = "There was an error in the database";
                $msg_class = "text-danger";
            }
        }
    }}
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
                    <h1 class="h3 mb-0 text-gray-800">Add Supplier</h1>
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text"  name="fname" value="<?php echo $s_row['fname'] ?>" class="form-control form-control-user" placeholder="First name" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text"  name="lname" value="<?php echo $s_row['lname'] ?>"class="form-control form-control-user" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="email" value="<?php echo $s_row['email'] ?>"  name="email" class="form-control form-control-user" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text"  value="<?php echo $s_row['tel'] ?>"name="tel" class="form-control form-control-user" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $s_row['biz_name'] ?>" name="biz" class="form-control form-control-user" placeholder="Company" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="text"  name="cash" value="<?php echo $s_row['cost_price'] ?>" class="form-control form-control-user" placeholder="Cost Price per unit" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="text"  value="<?php echo $s_row['address'] ?>"name="address" class="form-control form-control-user" placeholder="Address" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <?php $conn = mysqli_connect("localhost", "root", "", "pos");
                                                $categ_results = mysqli_query($conn, "SELECT * FROM categories");
                                                ?>
                                                <select  name="categ" class="form-control form-control-user">
                                                    <?php while ($c_row = $categ_results->fetch_assoc()) {?>
                                                        <option><?php  echo $c_row['category']?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-block btn-info" name="u_s"><span class="fa fa-plus"></span> Update Supplier </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Suppliers</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Supplier id</th>
                                            <th>Supplier Name</th>
                                            <th>Company</th>
                                            <th>Deliveries categories</th>
                                            <th>Address</th>
                                            <th>Contacts</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <?php $conn = mysqli_connect("localhost", "root", "", "pos");
                                        $s_results = mysqli_query($conn, "SELECT * FROM Suppliers");
                                        ?>

                                        <tbody>
                                        <?php while ($c_row = $s_results->fetch_assoc()) {?>
                                            <tr>
                                                <td class="text-center"><?php echo $c_row['id'];?></td>


                                                <td class="text-center"><?php echo $c_row['fname'].' '.$c_row['lname'];?></td>
                                                <td class="text-center"><?php echo $c_row['biz_name'];?></td>
                                                <td class="text-center"><?php echo $c_row['category'];?></td>
                                                <td class="text-center"><?php echo $c_row['address'];?></td>
                                                <td class="text-center"><?php echo $c_row['email'];
                                                    echo"<br>";
                                                    echo $c_row['tel'];
                                                    ?></td>

                                                <td class="text-center">



                                                    <div class="dropdown no-arrow mb-4">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Choose Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href=""><span class="fa fa-envelope"> Send Email</a>
                                                            <a class="dropdown-item" href="edit-supplier.php?edit-category=<?php echo $c_row['id']; ?>"><span class="fa fa-edit"></span> Edit</a>
                                                            <a class="dropdown-item" href="del-supplier.php?delete-category=<?php echo $c_row['id']; ?>"><span class="fa fa-trash"></span> Delete</a>

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
