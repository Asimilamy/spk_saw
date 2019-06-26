<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view_folder = 'views/pages';
$view_pages = ['home', 'users', 'criterias', 'alternatives', 'evaluations', 'profile', 'logout'];

if ($page == 'users' || $page == 'criterias' || $page == 'alternatives' || $page == 'profile') {
    include_once 'views/script/libs/default_js.php';
    if ($page == 'criterias' || $page == 'profile' || $page == 'alternatives') {
        include_once 'views/script/libs/'.$page.'_js.php';
    }
} elseif ($page == '' || $page == 'home') {
    include_once 'views/script/libs/home_js.php';
} elseif ($page == 'evaluations') {
    include_once 'views/script/libs/evaluation_js.php';
}
