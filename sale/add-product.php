<?php include '../helpers/addproducthelper.php'?>
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
                    <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
                    <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-12 col-md-12 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <?php if (!empty($msg)): ?>
                                    <p class="<?php echo $msg_class?>"><?php echo $msg; ?></p>
                                    <br>
                                <?php endif; ?>
                                <form method="post" action="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <?php
                                                $p_results = mysqli_query($conn, "SELECT * FROM p_menu");
                                                ?>
                                                <select  name="p_name" class="form-control form-control-user" required>
                                                    <?php while ($p_row = $p_results->fetch_assoc()) {?>
                                                        <option value="<?php echo $p_row['p_name'];?>"><?php echo $p_row['p_name']; ?> - <?php echo $p_row['units']; ?> </option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <?php
                                                $categ_results = mysqli_query($conn, "SELECT * FROM categories");
                                                ?>
                                                <select  name="categ" class="form-control form-control-user" required>
                                                    <?php while ($c_row = $categ_results->fetch_assoc()) {?>
                                                        <option><?php  echo $c_row['category']?></option>
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
                                                ?>
                                                <select  name="biz" class="form-control form-control-user" required>
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

                                                <input type="text" name="cp" class="form-control form-control-user" placeholder="cost price" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">

                                                <input type="text" name="sp" class="form-control form-control-user" placeholder="Selling price" required>
                                            </div>
                                        </div>
                                            <div class="col-4">
                                                <div class="form-group">

                                                    <input type="number" name="qty" class="form-control form-control-user" placeholder="No. Of items" required>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="mfg">Manufacture Date</label>
                                            <div class="form-group">

                                                <input type="date" id="mfg" name="mfg" class="form-control form-control-user" placeholder="cost price" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                    <label for="exp">Expiry Date</label>
                                                <input type="date" id="exp" name="exp" class="form-control form-control-user" placeholder="Selling price" required>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-block btn-info" name="add_p"><span class="fa fa-plus"></span> Add Product </button>
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
