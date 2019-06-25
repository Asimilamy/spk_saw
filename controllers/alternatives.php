<?php
session_start();
$base_path = '../';
$view_path = 'views/pages/alternatives/';
$view = 'alternatives';
include_once $base_path.'helpers/function.php';
include_once $base_path.'config/Database.php';
include_once $base_path.'models/M_Alternative.php';
include_once $base_path.'models/Base_Model.php';

$database = new Database();
$db = $database->getKoneksi();
$m_alternative = new M_Alternative($db);
$base_model = new Base_Model($db);

$act_post = input_post('act');
$act_get = input_get('act');

if ($act_get == 'load_table') {
    include_once $base_path . $view_path . 'table.php';
} elseif ($act_get == 'get_table_data') {
    $data = $m_alternative->ssp_datatables();

    require($base_path . 'config/ssp.class.php');
    echo json_encode(
        SSP::simple( $_GET, $data['sql_details'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['extraWhere'], $data['groupBy'], $data['having'] )
    );
} elseif ($act_get == 'get_form') {
    $id = input_get('id');
    $data = $m_alternative->get_row($id);
    include_once $base_path . $view_path . 'form.php';
} elseif($act_get == 'view_detail') {
    $id = input_get('id');
    $data = $m_alternative->get_row($id);
    include_once $base_path . $view_path . 'detail.php';
}

if ($act_post == 'submit_form') {
    $id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    
    $master_data = [
        'name' => $name,
    ];
    if (!empty($id)) {
        $master_data = array_merge($master_data, ['id' => $id]);
    }
    
    $master = $base_model->submit_data('alternatives', $master_data);
    
    header('Content-Type: application/json');
    echo json_encode($master);
} elseif ($act_post == 'delete_data') {
    $master = $base_model->delete_data('alternatives', ['id' => input_post('id')]);
    
    header('Content-Type: application/json');
    echo json_encode($master);
}
