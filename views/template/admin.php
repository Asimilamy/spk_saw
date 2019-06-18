<?php
$setting['base'] = substr($_SERVER['PHP_SELF'], 0, -9);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SPK BanSos APP</title>
        <!-- define base url -->
        <base href="<?php echo $setting['base']; ?>" />
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="assets/admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/admin_lte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="assets/admin_lte/bower_components/Ionicons/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="assets/admin_lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/admin_lte/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="assets/admin_lte/dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">
            
            <!-- main-header -->
            <?php include_once 'admin_components/header.php'; ?>
            <!-- /.main-header -->
            
            <!-- main-sidebar -->
            <?php include_once 'admin_components/mysidebar.php'; ?>
            <!-- /.main-sidebar -->

            <!-- content-wrapper -->
            <div class="content-wrapper">
                <?php include_once 'admin_components/routes.php'; ?>
            </div>
            <!-- /.content-wrapper -->

            <!-- main-footer -->
            <?php include_once 'admin_components/footer.php'; ?>
            <!-- /.main-footer -->
            
            <!-- Control Sidebar -->
            <?php // include_once 'admin_components/control_sidebar.php'; ?>
            <!-- /.Control Sidebar -->

        </div>
        
        <!-- jQuery 3 -->
        <script src="assets/admin_lte/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="assets/admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="assets/admin_lte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/admin_lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="assets/admin_lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="assets/admin_lte/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/admin_lte/dist/js/app.min.js"></script>
        <script src="assets/admin_lte/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="assets/admin_lte/dist/js/demo.js"></script>
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            });
        </script>
        <?php include_once 'views/script/page_js.php'; ?>
    </body>
</html>