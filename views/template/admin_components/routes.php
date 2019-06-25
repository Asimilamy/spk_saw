<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view_folder = 'views/pages';
$view_pages = ['home', 'users', 'criterias', 'alternatives', 'evaluations', 'profile', 'logout'];

if (empty($page)) {
    $view = $view_folder.'/home/index.php';
} else {
    if (in_array($page, $view_pages)) {
        $view = $view_folder.'/'.$page.'/index.php';
    }
}

if (isset($view)) {
    include $view;
} else {
    include $view_folder.'/errors/404.php';
}
