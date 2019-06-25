<?php
$name = isset($_SESSION['auth']['name']) ? $_SESSION['auth']['name'] : 'Alexander Pierce' ;
$date_registered = format_date($_SESSION['auth']['created_at'], 'M Y');
$default_img = 'assets/admin_lte/dist/img/avatar5.png';
$user_img = empty($_SESSION['auth']['user_img']) ? $default_img : 'assets/img/' . $_SESSION['auth']['user_img'] ;
?>

<header class="main-header">
    <!-- Logo -->
    <a href="home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>PK</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SPK</b> BanSos</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $user_img; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo $user_img; ?>" class="img-circle" alt="User Image">

                            <p>
                                <?php echo $name; ?>
                                <small>Member since <?php echo $date_registered; ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>