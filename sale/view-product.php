<?php include '../helpers/viewproducthelper.php'?>
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
                    <h1 class="h3 mb-0 text-gray-800">Products</h1>
                    <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                </div>

                <!-- Content Row -->



                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                            </div>

                            <div class="card-body">
                                <?php
                                $s_results = mysqli_query($conn, "SELECT * FROM products");

                                if (mysqli_num_rows($s_results) <1) {
                                    echo"<div class='alert  alert-warning table-responsive'>";
                                    echo"<p>No Products in the inventory</p>";
                                    echo"</div>";
                                    echo"<a class='btn btn-block btn-info' href='add-product.php?product-code=$pdcode'><span class='fa fa-plus'></span> Add Product</a>";
                                }else{

                                ?>
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
                                            <th>Available</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <?php
                                        $s_results = mysqli_query($conn, "SELECT * FROM products");
                                        ?>

                                        <tbody>
                                        <?php while ($c_row = $s_results->fetch_assoc()) {?>
                                            <tr>
                                                <td class="text-center"><?php echo $c_row['p_code'];?></td>
                                                <td class="text-center"><?php echo $c_row['p_name'];?></td>
                                                <td class="text-center"><?php echo $c_row['p_supplier'];?></td>
                                                <td class="text-center"><?php echo $c_row['p_categeory'];?></td>
                                                <td class="text-center"><?php echo $c_row['cost_price'];  ?></td>
                                                <td class="text-center"><?php echo $c_row['selling_price'];  ?></td>
                                                <td class="text-center"><?php echo $c_row['p_qty'];  ?></td>
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

                                                            <a class="dropdown-item" href="edit-product.php?edit-product=<?php echo $c_row['id']; ?>"><span class="fa fa-edit"></span> Edit</a>
                                                            <a class="dropdown-item" href="del-product.php?delete-product=<?php echo $c_row['id']; ?>"><span class="fa fa-trash"></span> Delete</a>

                                                        </div>
                                                    </div>

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
