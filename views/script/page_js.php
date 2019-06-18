<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view_folder = 'views/pages';
$view_pages = ['home', 'users', 'values', 'criterias', 'subjects', 'evaluations', 'logout'];

if ($page == 'users') {
    include_once 'views/script/libs/default_js.php';
}
