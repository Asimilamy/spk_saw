<?php
session_start();
$base_path = '../';
$view_path = 'views/pages/evaluations/';
$view = 'evaluations';
include_once $base_path.'helpers/function.php';
include_once $base_path.'config/Database.php';
include_once $base_path.'models/Base_Model.php';

$database = new Database();
$db = $database->getKoneksi();
$base_model = new Base_Model($db);

$act_post = input_post('act');
$act_get = input_get('act');

if ($act_post == 'start_evaluating') {
    $alternatives = $base_model->get_data('alternatives', [], 'result');
    $alternative_values = $base_model->get_data('alternative_values', [], 'result');
    $criterias = $base_model->get_data('criterias', [], 'result');
    $criteria_options = $base_model->get_data('criteria_options', [], 'result');
    include_once $base_path . $view_path .'result.php';
}
