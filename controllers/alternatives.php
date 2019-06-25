<?php
session_start();
$base_path = '../';
$view_path = 'views/pages/users/';
include_once $base_path.'helpers/function.php';
include_once $base_path.'config/Database.php';
include_once $base_path.'models/M_Users.php';

$database = new Database();
$db = $database->getKoneksi();
$m_users = new M_Users($db);

$act_post = input_post('act');
$act_get = input_get('act');

if ($act_get == 'load_table') {
    include_once $base_path . $view_path . 'table.php';
} elseif ($act_get == 'get_table_data') {
    $data = $m_users->ssp_datatables();

    require($base_path . 'config/ssp.class.php');
    echo json_encode(
        SSP::simple( $_GET, $data['sql_details'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['extraWhere'], $data['groupBy'], $data['having'] )
    );
} elseif ($act_get == 'get_form') {
    $id = input_get('id');
    $data = $m_users->get_row($id);
    include_once $base_path . $view_path . 'form.php';
}

if ($act_post == 'submit_form') {
    $id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
    $username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_DEFAULT);
    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $msg = '';
    if (!$m_users->chk_username($username, $id)) {
        $msg .= '<li>Username exist, pick another Username!</li>';
    }

    if (empty($id) && empty($password)) {
        $msg .= '<li>Password field is required!</li>';
    }

    if (!empty($password) && !empty($password_confirm)) {
        if ($password != $password_confirm) {
            $msg .= '<li>Password and Password Confirm doesn\'t match!</li>';
        }
    }

    if (!empty($msg)) {
        $alert_msg = '<ul>' . $msg . '</ul>';
        $data['status'] = 'error';
        $data['alert'] = render_alert_lte('danger', TRUE, 'Error!', $alert_msg);

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    $submit_data = [
        'username' => $username,
        'name' => $name,
        'email' => $email,
    ];
    if (!empty($password)) {
        $submit_data = array_merge($submit_data, ['password' => hash_text($password)]);
    }
    if (!empty($id)) {
        $submit_data = array_merge($submit_data, ['id' => $id]);
    }
    if (!empty($_FILES['user_image']['name'])) {
        $upload = upload_files($_FILES['user_image'], $base_path . 'assets/img/');
        if ($upload['status'] == 'success') {
            $submit_data = array_merge($submit_data, ['user_img' => $upload['img_name']]);
        } else {
            $alert_msg = '<ul>' . $upload['msg'] . '</ul>';
            $data['status'] = 'error';
            $data['alert'] = render_alert_lte('danger', TRUE, 'Error!', $alert_msg);
    
            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }
    }
    $data = $m_users->submit_data($submit_data);
    
    header('Content-Type: application/json');
    echo json_encode($data);
} elseif ($act_post == 'delete_data') {
    $data = $m_users->delete_data($id);
    
    header('Content-Type: application/json');
    echo json_encode($data);
}
