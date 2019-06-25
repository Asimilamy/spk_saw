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
} elseif ($act_get == 'load_criterias') {
    $id = input_get('id');
    $values = $m_alternative->get_values($id);
    $criterias = $base_model->get_data('criterias', [], 'result');
    if (!empty($criterias)) {
        foreach ($criterias as $criteria) {
            $criteria_id[] = $criteria->id;
        }
        $options = $base_model->get_data('criteria_options', ['in' => ['criteria_id' => $criteria_id]], 'result');
    }
    include_once $base_path . $view_path . 'values_form.php';
}

if ($act_post == 'submit_form') {
    $id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $criteria_ids = filter_input(INPUT_POST, 'criteria_ids', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $option_ids = filter_input(INPUT_POST, 'option_ids', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $criteria_weights = filter_input(INPUT_POST, 'criteria_weights', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $criteria_values = filter_input(INPUT_POST, 'criteria_values', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    
    $master_data = [
        'name' => $name,
    ];
    if (!empty($id)) {
        $master_data = array_merge($master_data, ['id' => $id]);
    }
    
    $submit = $base_model->submit_data('alternatives', $master_data);
    if ($submit['status'] == 'error') {
        $submit['status'] = 'error';
        $submit['alert'] = render_alert_lte('danger', TRUE, 'Error!', 'Sorry system encountered error!');

        header('Content-Type: application/json');
        echo json_encode($submit);
        exit;
    }
    if (!empty($criteria_ids)) {
        $master_id = $submit['insert_id'];
        $delete = $base_model->delete_data('alternative_values', ['alternative_id' => $master_id]);
        if ($delete['status'] == 'error') {
            header('Content-Type: application/json');
            echo json_encode($delete);
            exit;
        }
        $total_child = count($criteria_ids);
        for ($i = 0; $i < $total_child; $i++) {
            $child_data = [
                'alternative_id' => $master_id,
                'criteria_id' => $criteria_ids[$i],
                'weight' => $criteria_weights[$i],
                'value' => $criteria_values[$i],
            ];
            if (!empty($option_ids[$i])) {
                $child_data = array_merge($child_data, ['criteria_option_id' => $option_ids[$i]]);
            }
            $submit = $base_model->submit_data('alternative_values', $child_data);
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($submit);
} elseif ($act_post == 'delete_data') {
    $master = $base_model->delete_data('alternatives', ['id' => input_post('id')]);
    if ($master['status'] == 'error') {
        header('Content-Type: application/json');
        echo json_encode($master);
        exit();
    }
    $child = $base_model->delete_data('alternative_values', ['alternative_id' => input_post('id')]);
    
    header('Content-Type: application/json');
    echo json_encode($child);
}
