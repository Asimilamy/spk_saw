<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$name = $_SESSION['user']['name'];
$default_img = 'assets/admin_lte/dist/img/avatar5.png';
$user_img = empty($_SESSION['user']['user_img']) ? $default_img : 'assets/img/' . $_SESSION['user']['user_img'] ;
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $user_img; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $name; ?></p>
                <a href="profile"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN MENU</li>
            <li <?php echo empty($page) || $page == 'home' ? 'class=\'active\'' : '' ; ?>>
                <a href="home" >
                    <i class="fa fa-dashboard"></i> <span>Home</span>
                </a>
            </li>
            <li <?php echo $page == 'users' ? 'class=\'active\'' : '' ; ?>>
                <a href="users">
                    <i class="fa fa-user-circle-o"></i> <span>Users</span>
                </a>
            </li>
            <li <?php echo $page == 'values' ? 'class=\'active\'' : '' ; ?>>
                <a href="values">
                    <i class="fa fa-area-chart"></i> <span>Values</span>
                </a>
            </li>
            <li <?php echo $page == 'criterias' ? 'class=\'active\'' : '' ; ?>>
                <a href="criterias">
                    <i class="fa fa-tags"></i> <span>Criterias</span>
                </a>
            </li>
            <li <?php echo $page == 'subjects' ? 'class=\'active\'' : '' ; ?>>
                <a href="subjects">
                    <i class="fa fa-users"></i> <span>Subjects</span>
                </a>
            </li>
            <li <?php echo $page == 'evaluations' ? 'class=\'active\'' : '' ; ?>>
                <a href="evaluations">
                    <i class="fa fa-line-chart"></i> <span>Evaluations</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>