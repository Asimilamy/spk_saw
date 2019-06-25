<?php
session_start();
$base_path = '../';
$view_path = 'views/pages/users/';
$view = 'users';
include_once $base_path.'helpers/function.php';
include_once $base_path.'config/Database.php';
include_once $base_path.'models/M_User.php';
include_once $base_path.'models/Base_Model.php';

$database = new Database();
$db = $database->getKoneksi();
$m_user = new M_User($db);
$base_model = new Base_Model($db);

$act_post = input_post('act');
$act_get = input_get('act');

if ($act_get == 'get_form') {
    $id = input_get('id');
    $data = $m_user->get_row($id);
    include_once $base_path . $view_path . 'form.php';
}
