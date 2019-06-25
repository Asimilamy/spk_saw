<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SPK BanSos APP</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fontawesome-free-5.8.2-web/css/all.min.css">
    </head>
    <body class="bg-success" style="padding-top: 5%; padding-bottom: 5%;">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="card border-primary mt-5 shadow">
                    <div class="card-header bg-primary text-white">Login App</div>
                    <div class="card-body">
                        <div class="form-alert"></div>
                        <form method="POST" id="formLogin">
                            <input type="hidden" name="act" value="login">
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                Login <i class="fas fa-sign-in-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="assets/jquery-3.3.1/jquery-3.3.1.min.js"></script>
        <script src="assets/popper.js/popper.min.js"></script>
        <script src="assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
        <script src="views/script/libs/js_function.js"></script>
        <script src="views/script/auth/login.js"></script>
    </body>
</html>