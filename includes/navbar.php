<?php $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>


<div class="sticky-top">
  <div class="bg-white d-block d-sm-block d-md-none">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="top-mobile-navbar text-end">
            <div class="m-links d-inline d-sm-inline d-md-none">
              <a class="<?= $page == 'cart.php' ? 'active':''; ?>" href="cart.php">
                <i class="fa fa-shopping-cart"></i> Cart
              </a>
            </div>
            <?php if(isset($_SESSION['auth_user'])) : ?>
              <div class="dropdown d-inline">
                <a class="dropdown-toggle btn btn-funda bg-orange" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?= $_SESSION['auth_user']['user_name']; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item <?= $page == 'myprofile.php' ? 'active':''; ?>" href="myprofile.php">My Profile</a></li>
                  <li><a class="dropdown-item <?= $page == 'myorders.php' ? 'active':''; ?>" href="myorders.php">My Orders</a></li>
                  <li>
                    <form action="allcode.php" method="POST">
                      <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                    </form>
                  </li>
                </ul>
              </div>
          <?php else : ?>
            <div class="m-links d-inline d-sm-inline d-md-none">
              <a class="text-orange d-inline d-sm-inline d-md-none" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogin" aria-controls="offcanvasLogin">
                <i class="fa fa-sign-in"></i> Sign In
              </a>
            </div>
            <div class="m-links d-inline d-sm-inline d-md-none">
              <a class="text-orange d-inline d-sm-inline d-md-none" href="register.php">
                <i class="fa fa-user"></i> Sign Up
              </a>
            </div>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="assets/images/logo.jpg" class="w-25" alt="Food Ordering System">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= $page == 'index.php' ? 'active':''; ?>" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == 'menu-categories.php' ? 'active':''; ?>" href="menu-categories.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == 'about-us.php' ? 'active':''; ?>" href="about-us.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == 'cart.php' ? 'active':''; ?>" href="cart.php">Cart</a>
          </li>

          <?php if(isset($_SESSION['auth_user'])) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['auth_user']['user_name']; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item <?= $page == 'myprofile.php' ? 'active':''; ?>" href="myprofile.php">My Profile</a></li>
            <li><a class="dropdown-item <?= $page == 'myorders.php' ? 'active':''; ?>" href="myorders.php">My Orders</a></li>
              <li>
                <form action="allcode.php" method="POST">
                  <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
          <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogin" aria-controls="offcanvasLogin">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
          <?php endif; ?>

        </ul>
      
      </div>
    </div>
  </nav>
</div>

<?php include('login-drawer.php'); ?>