<?php
session_start();
$base_path = '../';
$view_path = 'views/pages/criterias/';
$view = 'criterias';
include_once $base_path.'helpers/function.php';
include_once $base_path.'config/Database.php';
include_once $base_path.'models/M_Criteria.php';
include_once $base_path.'models/Base_Model.php';
include_once $base_path . $view_path . 'options_form.php';

$database = new Database();
$db = $database->getKoneksi();
$m_criteria = new M_Criteria($db);
$base_model = new Base_Model($db);

$act_post = input_post('act');
$act_get = input_get('act');

if ($act_get == 'load_table') {
    include_once $base_path . $view_path . 'table.php';
} elseif ($act_get == 'get_table_data') {
    $data = $m_criteria->ssp_datatables();

    require($base_path . 'config/ssp.class.php');
    echo json_encode(
        SSP::simple( $_GET, $data['sql_details'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['extraWhere'], $data['groupBy'], $data['having'] )
    );
} elseif ($act_get == 'get_form') {
    $id = input_get('id');
    $data = $m_criteria->get_row($id);
    include_once $base_path . $view_path . 'form.php';
} elseif($act_get == 'view_detail') {
    $id = input_get('id');
    $data = $m_criteria->get_row($id);
    include_once $base_path . $view_path . 'detail.php';
} elseif ($act_get == 'get_options_form') {
    $criteria_id = input_get('criteria_id');
    $type = input_get('type');
    $view = input_get('view');
    $data_options = $m_criteria->get_options($criteria_id);
    if ($type == 'value') {
        echo render_alert_lte('info', FALSE, 'Attention!', 'Take attributes values as criterias values!');
    } elseif ($type == 'option') {
        echo render_options($data_options, $view);
    }
} elseif ($act_get == 'add_options') {
    echo options_form(TRUE, '', '', 'remove', 'form');
}

if ($act_post == 'submit_form') {
    $id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $attribute = filter_input(INPUT_POST, 'attribute', FILTER_DEFAULT);
    $type = filter_input(INPUT_POST, 'type', FILTER_DEFAULT);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_DEFAULT);
    $option_name = filter_input(INPUT_POST, 'option_name', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $option_value = filter_input(INPUT_POST, 'option_value', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    
    $master_data = [
        'name' => $name,
        'attribute' => $attribute,
        'type' => $type,
        'weight' => $weight,
    ];
    if (!empty($id)) {
        $master_data = array_merge($master_data, ['id' => $id]);
    }
    
    $master = $base_model->submit_data('criterias', $master_data);
    if ($master['status'] == 'error') {
        $master['status'] = 'error';
        $master['alert'] = render_alert_lte('danger', TRUE, 'Error!', 'Sorry system encountered error!');

        header('Content-Type: application/json');
        echo json_encode($master);
        exit;
    }
    $delete = $base_model->delete_data('criteria_options', ['criteria_id' => $master['insert_id']]);
    if ($delete['status'] == 'error') {
        header('Content-Type: application/json');
        echo json_encode($delete);
        exit;
    }
    $total_child = count($option_name);
    for ($i = 0; $i < $total_child; $i++) {
        $child_data = [
            'criteria_id' => $master['insert_id'],
            'name' => $option_name[$i],
            'value' => $option_value[$i],
        ];
        $child = $base_model->submit_data('criteria_options', $child_data);
    }
    
    header('Content-Type: application/json');
    echo json_encode($child);
} elseif ($act_post == 'delete_data') {
    $master = $base_model->delete_data('criterias', ['id' => input_post('id')]);
    if ($master['status'] == 'error') {
        header('Content-Type: application/json');
        echo json_encode($master);
        exit();
    }
    $child = $base_model->delete_data('criteria_options', ['criteria_id' => input_post('id')]);
    
    header('Content-Type: application/json');
    echo json_encode($child);
}
