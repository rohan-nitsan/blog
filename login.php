<?php
require_once 'header.php';
?>
<section class="">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-4">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p- p-md-3">
                        <h1 class="mb-4 pb-2 pb-md-0 mb-md-3">Login</h1>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-outline">
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <div class="form-outline">
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" />
                                        <p class="error" id="login_error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <div class="form-outline">
                                        <input type="submit" name="login" class="btn btn-success" value="Login" />
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="form-outline">
                                        <input type="reset" class="btn btn-danger" value="Reset" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'footer.php';
?>