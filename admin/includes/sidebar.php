<div id="layoutSidenav_nav">
    <?php $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>
                
    <nav class="sb-sidenav accordion sb-sidenav-dark" id=0sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Basic</div>
                <a class="nav-link <?= $page == "index.php"?'active':''; ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link <?= $page == "registered-users.php"?'active':''; ?>" href="registered-users.php">
                    <div class="sb-nav-link-icon "><i class="fas fa-users"></i></div>
                    Registerd Users
                </a>
                <div class="sb-sidenav-menu-heading">Manage</div>
                <a class="nav-link collapsed  <?= $page == "category.php" || $page == "addcategory.php"?'active':''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= $page == "category.php" || $page == "addcategory.php"?'show':''; ?>" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == "category.php"?'active':''; ?>" href="category.php"><i class="fas fa-list me-2"></i>All Category</a>
                        <a class="nav-link <?= $page == "addcategory.php"?'active':''; ?>" href="addcategory.php"><i class="fas fa-plus me-2"></i>Add Category</a>
                    </nav>
                </div>

                <a class="nav-link collapsed  <?= $page == "products.php" || $page == "addproduct.php"?'active':''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#prodcollapseLayouts" aria-expanded="false" aria-controls="prodcollapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= $page == "products.php" || $page == "addproduct.php"?'show':''; ?>" id="prodcollapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == "products.php"?'active':''; ?>" href="products.php"><i class="fas fa-list me-2"></i>All products</a>
                        <a class="nav-link <?= $page == "addproduct.php"?'active':''; ?>" href="addproduct.php"><i class="fas fa-plus me-2"></i>Add products</a>
                    </nav>
                </div>

                <a class="nav-link <?= $page == "orders.php"?'active':''; ?>" href="orders.php">
                    <div class="sb-nav-link-icon "><i class="fas fa-users"></i></div>
                    Orders
                </a>

                <a class="nav-link collapsed  <?= $page == "revenue.php" || $page == "allrevenue.php" ?'active':''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#revenuecollapseLayouts" aria-expanded="false" aria-controls="revenuecollapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                    Revenue
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= $page == "revenue.php" || $page == "allrevenue.php"?'show':''; ?>" id="revenuecollapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == "revenue.php"?'active':''; ?>" href="revenue.php"><i class="fas fa-arrow-down me-2"></i>Today</a>
                        <a class="nav-link <?= $page == "allrevenue.php"?'active':''; ?>" href="allrevenue.php"><i class="fas fa-list me-2"></i>All Time</a>
                    </nav>
                </div>
               
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $_SESSION['auth_user']['user_name'] ?>
        </div>
    </nav>
</div>