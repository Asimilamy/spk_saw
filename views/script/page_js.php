<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view_folder = 'views/pages';
$view_pages = ['home', 'users', 'criterias', 'alternatives', 'evaluations', 'logout'];

if ($page == 'users' || $page == 'criterias' || $page == 'alternatives') {
    include_once 'views/script/libs/default_js.php';
    if ($page == 'criterias') {
        include_once 'views/script/libs/'.$page.'_js.php';
    }
} elseif ($page == 'home') {
    include_once 'views/script/libs/'.$page.'_js.php';
}
