<?php include 'auth.php';

$role=$_SESSION['role'];


$conn = mysqli_connect("localhost", "root", "", "pos");
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

    <title>Supplier Stats</title>

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#filter').on('change', function() {
                if ( this.value === '1')
                //.....................^.......
                {
                    $("#date").show();
                    $("#sup").hide();

                }
                else
                {
                    $("#sup").show();
                    $("#date").hide();
                }
            });
        });

    </script>
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
                    <h1 class="h3 mb-0 text-gray-800">Supplier stats</h1>
                    <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                        <label for="filter">Filter By:</label>
                        <select id='filter' class="form-control form-control-user">
                            <option selected disabled>Choose filter </option>
                            <option value="1">Date delivered</option>
                            <option value="2">Supplier</option>

                        </select>
                </div>
                    </div>
                </div>
                <div style='display:none;' id='date'>

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
                                <button type="submit" name="g_d" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>

                            </div>
                        </div>
                    </form>
                    <br/>
                </div>
                <div style='display:none;' id='sup'>
                    <div class="row">
                        <div class="col-12">
                            <form action="" method="post">
                            <div class="form-group">
                                <?php $conn = mysqli_connect("localhost", "root", "", "pos");
                                $s_results = mysqli_query($conn, "SELECT * FROM suppliers");
                                ?>
                                <label for="biz">Supplier</label>
                                <select  id="biz" name="biz" class="form-control form-control-user" required>
                                    <?php while ($s_row = $s_results->fetch_assoc()) {?>
                                        <option><?php  echo $s_row['biz_name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-info" name="g_s">Generate report</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Supplies</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead>
<?php                                        if (isset($_POST['g_d'])){

                                        $date = new DateTime($_POST['d1']);
                                        $dt1=$date->format('Y-m-d');

                                        $date2 = new DateTime($_POST['d2']);
                                        $dt2=$date2->format('Y-m-d');


                                        $sql_sale = "SELECT * FROM supplies WHERE date_delivered BETWEEN '$dt1' AND '$dt2' ORDER by sup_id DESC ";
                                        $result_sale = mysqli_query($conn, $sql_sale);
if (mysqli_num_rows($result_sale) <1) {
    echo"<div class='alert  alert-warning alert-dismissible'>";
    echo"<p>No Supplies found in that range</p>";
    echo"</div>";
}else{

                                       ?>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Supplier</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Product Quantity</th>
                                            <th>Date delivered</th>
                                            <th>Cost Price per item</th>
                                            <th>Total Amount</th>

                                        </tr>
                                        </thead>
                                        <?php

                                      ?>


                                        <tbody>
<?php  for ($i = 0;
            $c_row = $result_sale->fetch_assoc();
            $i++) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $c_row['invoice'];?></td>


                                                <td class="text-center"><?php echo $c_row['supplier']?></td>
                                                <td class="text-center"><?php    echo $c_row['product_code'];?></td>

                                                <td class="text-center"><?php  echo $c_row['product_name']?></td>
                                                <td class="text-center"><?php  echo $c_row['p_qty']?></td>
                                                <td class="text-center"><?php  echo $c_row['date_delivered']?></td>
                                                <td class="text-center"><?php

                                                    $cp= $c_row['cost_price'];

                                                    echo' Ksh.'.' '. formatMoney($cp,true);
                                                    ?></td>
                                                <td class="text-center"><?php
                                                   $amount= $c_row['amount'];

                                                  echo' Ksh.'.' '. formatMoney($amount,true);





                                                    ?></td>
                                            </tr>

                                        <?php }?>

                                        <tr><td colspan="4">Total Items:</td>
                                            <td><?php    $resultass = "SELECT sum(p_qty) FROM supplies where date_delivered BETWEEN '$dt1' AND '$dt2'";
                                                $result_prins = mysqli_query($conn, $resultass);

                                                for($i=0; $rowass = $result_prins->fetch_assoc(); $i++){
                                                    $fgfgs=$rowass['sum(p_qty)'];
                                                    echo'Total Item(s):'.' '. formatMoney($fgfgs, true);
                                                }?></td>


                                        </tr>
                                        <tr><td colspan="7">Total amount:</td>
                                            <td><?php
                                                $resultas = "SELECT sum(amount) FROM supplies where date_delivered BETWEEN '$dt1' AND '$dt2'";
                                                $result_prin = mysqli_query($conn, $resultas);

                                                for($i=0; $rowas = $result_prin->fetch_assoc(); $i++){
                                                    $fgfg=$rowas['sum(amount)'];
                                              echo' Ksh.'.' '. formatMoney($fgfg, true);
                                                }

                                                  ?></td>

<?php }}?>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table  table-bordered">
                                        <thead>
                                        <?php                                        if (isset($_POST['g_s'])){

                                            $sup=$_POST['biz'];

                                        $sql_sale = "SELECT * FROM supplies WHERE supplier='$sup'  ORDER by sup_id DESC ";
                                        $result_sale = mysqli_query($conn, $sql_sale);
                                        if (mysqli_num_rows($result_sale) <1) {
                                            echo"<div class='alert  alert-warning alert-dismissible'>";
                                            echo"<p>No Supplies associated with that supplier</p>";
                                            echo"</div>";
                                        }else{

                                        ?>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Supplier</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Product Quantity</th>
                                            <th>Date delivered</th>
                                            <th>Cost Price per item</th>
                                            <th>Total Amount</th>

                                        </tr>
                                        </thead>
                                        <?php

                                        ?>


                                        <tbody>
                                        <?php  for ($i = 0;
                                                    $c_row = $result_sale->fetch_assoc();
                                                    $i++) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $c_row['invoice'];?></td>


                                                <td class="text-center"><?php echo $c_row['supplier']?></td>
                                                <td class="text-center"><?php    echo $c_row['product_code'];?></td>

                                                <td class="text-center"><?php  echo $c_row['product_name']?></td>
                                                <td class="text-center"><?php  echo $c_row['p_qty']?></td>
                                                <td class="text-center"><?php  echo $c_row['date_delivered']?></td>
                                                <td class="text-center"><?php

                                                    $cp= $c_row['cost_price'];

                                                    echo' Ksh.'.' '. formatMoney($cp,true);
                                                    ?></td>
                                                <td class="text-center"><?php
                                                    $amount= $c_row['amount'];

                                                    echo' Ksh.'.' '. formatMoney($amount,true);





                                                    ?></td>
                                            </tr>

                                        <?php }?>

                                        <tr><td colspan="6">Total items:</td>
                                            <td><?php    $resultass = "SELECT sum(p_qty) FROM supplies where supplier = '$sup'";
                                                $result_prins = mysqli_query($conn, $resultass);

                                                for($i=0; $rowass = $result_prins->fetch_assoc(); $i++){
                                                    $fgfgs=$rowass['sum(p_qty)'];
                                                    echo' Total Items.'.' '. formatMoney($fgfgs, true);
                                                }?></td>


                                        </tr>
                                        <tr><td colspan="7">Total amount:</td>
                                            <td><?php
                                                $resultas = "SELECT sum(amount) FROM supplies where supplier = '$sup'";
                                                $result_prin = mysqli_query($conn, $resultas);

                                                for($i=0; $rowas = $result_prin->fetch_assoc(); $i++){
                                                    $fgfg=$rowas['sum(amount)'];
                                                    echo' Ksh.'.' '. formatMoney($fgfg, true);
                                                }

                                                ?></td>

                                            <?php }}?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

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
    <script type="text/javascript">
        $('#filters').change(function(e){
            $this = $(e.target);
            var selected_form = $this.text().replace(' ','_name');
            $('form').hide(2000, 'easeOutExpo');
            $(selected_form).show(2000, 'easeOutExpo');
        });
    </script>
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
