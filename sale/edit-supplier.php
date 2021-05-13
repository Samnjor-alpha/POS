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
                                                <?php
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
                                        <?php
                                        $s_results = mysqli_query($conn, "SELECT * FROM suppliers");
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
<? include '../navs/logoutmodal.php'?><!-- Bootstrap core JavaScript-->
<? include '../public/salescripts.php'; ?>

</body>

</html>
