<?php
session_start();
$base_path = '../';
$view_path = 'views/pages/home/';
$view = 'home';
include_once $base_path.'helpers/function.php';
include_once $base_path.'config/Database.php';
include_once $base_path.'models/Base_Model.php';

$database = new Database();
$db = $database->getKoneksi();
$base_model = new Base_Model($db);

$act_post = input_post('act');
$act_get = input_get('act');

if ($act_get == 'get_count') {
    $data = [
        'user' => $base_model->count('users', 'id'),
        'criteria' => $base_model->count('criterias', 'id'),
        'alternative' => $base_model->count('alternative', 'id'),
        'evaluation' => $base_model->count('users', 'id'),
    ];

    header('Content-Type: application/json');
    echo json_encode($data);
}
