<?php
session_start();
$base_path = '../../';
include $base_path.'helpers/function.php';
include $base_path.'models/M_Auth.php';
include $base_path.'config/Database.php';

$database = new Database();
$db = $database->getKoneksi();
$m_auth = new M_Auth($db);

$act_post = filter_input(INPUT_POST, 'act', FILTER_DEFAULT);

if ($act_post == 'login') {
    $username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $data = [
        'username' => $username,
        'password' => $password,
    ];
    $act = $m_auth->attempt_login($data);
    header('Content-Type: application/json', true, 200);
    echo json_encode($act);
}
