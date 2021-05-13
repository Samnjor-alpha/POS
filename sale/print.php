<?php  include  '../helpers/printhelper.php'?>
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
<script type="text/javascript">
    function PrintDiv() {
        // var divToPrint = document.getElementById('divToPrint');


        var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
        disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25";
        var content_vlue = document.getElementById("divToPrint").innerHTML;

        var docprint=window.open("","",disp_setting);
        docprint.document.open();
        docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');
        docprint.document.write(content_vlue);
        docprint.document.close();
        docprint.focus();
    }
</script>
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
            <div class="container-fluid" >

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Sale Receipt</h1>
                    <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                </div>

                <!-- Content Row -->
                <div class="row" >

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-12 col-md-12 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2" id="divToPrint">
                            <div class="card-body">
                                <div >
                                    <div>
                                        <div class="text-center">
                                            <h2>Sales Receipt</h2>
                                            <h5>General Stores	<br>
                                               Nairobi, Kenya<br>	<br>
                                            </h5>

                                            <div>

                                        </div>
                                        <div >
                                            <table class="" >

                                                <tr>
                                                    <td>OR No. :</td>
                                                    <td><?php echo $invoice ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date :</td>
                                                    <td><?php echo $date ?></td>
                                                </tr>
                                            </table>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th> Product Code </th>
                                                <th> Product Name </th>
                                                <th> Qty </th>
                                                <th> Price </th>
                                                      <th> Amount </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $id=$_GET['invoice'];
                                            $resultd = "SELECT * FROM sales_order WHERE invoice= '$id'";
                                            $result_d = mysqli_query($conn, $resultd);
                                            for($i=0; $row = $result_d->fetch_assoc(); $i++){

                                                ?>
                                                <tr class="record">
                                                    <td><?php echo $row['product_code']; ?></td>
                                                    <td><?php echo $row['product']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td>
                                                        <?php
                                                        $ppp=$row['price'];
                                                        echo formatMoney($ppp, true);
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        $dfdf=$row['amount'];
                                                        echo formatMoney($dfdf, true);
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="5" >Total: &nbsp;</strong></td>
                                                <td colspan="2">
                                                        <?php
                                                        $sdsd=$_GET['invoice'];
                                                        $resultas = "SELECT sum(amount) FROM sales_order WHERE invoice= '$sdsd'";
                                                        $result_prin = mysqli_query($conn, $resultas);

                                                        for($i=0; $rowas = $result_prin->fetch_assoc(); $i++){
                                                            $fgfg=$rowas['sum(amount)'];
                                                            echo formatMoney($fgfg, true);
                                                        }
                                                        ?>
                                                    </td>
                                            </tr>

                                                <tr>
                                                    <td colspan="5">Cash Tendered:&nbsp;</td>
                                                    <td colspan="2">
                                                            <?php



                                                            echo formatMoney($cash, true);
                                                            ?>
                                                        </td>
                                                </tr>

                                            <tr>
                                                <td colspan="5">Change </td>
                                                <td colspan="2">
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
echo $number;
                                                        ?>
                                                   </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <div class="text-sm-left text-gray-900">
                                            <p class="text-muted">Served by: <?php echo $_SESSION['fname'].' '. $_SESSION['lname'] ?></p> <br>
                                            <p class="text-muted">Customer name: <?php echo $customer ;?></p>

                                        </div>
                                    </div>
                                </div>














            </div>
                                <div class="pull-right">
                                    <button class="btn btn-success btn-large" onclick="PrintDiv();"><span class="fa fa-print"></span> Print</button>
                                </div>
                </div>




                <!-- Content Row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

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
