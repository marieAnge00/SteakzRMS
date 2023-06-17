<div class="container-fluid">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLogin" aria-labelledby="offcanvasLoginLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="py-4">
                <h4 class="main-heading" id="offcanvasLoginLabel">Login</h4>
                <h6>or <a href="register.php" class="text-orange">create an account</a></h6>
                <div class="login-area-content">

                    <form action="logincode.php" method="POST">
                        <div class="my-md-5">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email_id" required placeholder="name@example.com">
                                <label for="email_id">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password" required placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="login_btn" class="btn bg-orange py-3 w-100 text-white">Login Now</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    
</div>