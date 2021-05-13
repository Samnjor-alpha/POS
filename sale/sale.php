<?php  include '../helpers/salehelper.php'?>
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
    <!-- Sidebar -->
    <?php
    $sql_add = mysqli_query($conn, "SELECT * FROM sales_order WHERE  invoice='$invs'");
    if (mysqli_num_rows($sql_add) <1){ ?>
     <? include '../navs/sidenav.php'?>
    <?php } ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <? include '../navs/topbar.php'?>

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
                                            <?php
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
<? include '../navs/logoutmodal.php'?><!-- Check out Modal-->
<? include '../navs/checkout.php'?>
<!-- Bootstrap core JavaScript-->

<? include '../public/salescripts.php'; ?>

</body>

</html>
