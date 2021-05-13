<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../sale/dashboard.php">
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
            <a class="nav-link" href="../sale/dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard </span></a>
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
                    <a class="collapse-item" href="../sale/add-supplier.php">Add Supplier</a>
                    <a class="collapse-item" href="../sale/view-supplier.php">View Supplier</a>

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
                    <a class="collapse-item" href="../sale/product-catalogue.php">Add new product catalogue</a>
                    <a class="collapse-item" href="../sale/add-product.php?product-code=<?php echo $pdcode?>">Add Product</a>
                    <a class="collapse-item" href="../sale/view-product.php">View Products</a>
                    <a class="collapse-item" href="../sale/category.php">Add Product category</a>
                    <a class="collapse-item" href="../sale/view-categories.php">Manage category</a>
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
        <a class="nav-link collapsed" href="../sale/sale.php?invoice=<?php echo $invcode?>" aria-controls="collapsePages">
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
                    <a class="collapse-item" href="../sale/sale-report.php">Sales Report</a>
                    <a class="collapse-item" href="../sale/View-supplierstats.php">Supplies Reports</a>
                    <a class="collapse-item" href="../sale/view-prodstats.php">Product Reports</a>
                    <a class="collapse-item" href="../sale/unsale.php">Uncompleted sale Orders</a>

                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="../sale/manage-users.php">
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