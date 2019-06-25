<?php
$base_path = isset($base_path) ? $base_path : '../' ;
include_once $base_path . 'helpers/function.php';

class Base_Model {
    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert($tbl_name, $data = [])
    {
		if (!empty($data)) {
			$query = 'INSERT INTO '.$tbl_name.' SET ';
			foreach ($data as $column => $value) {
				$querys[] = $column.' = ?';
				$val[] = $value;
			}
			$query .= implode(', ', $querys);
			$stmt = $this->db->prepare($query);
			$data['query'] = $query;
			$data['result'] = $stmt->execute($val);
			$data['insert_id'] = $this->db->lastInsertId();
		} else {
			$data['query'] = 'Are you mad vroh?!?';
			$data['result'] = FALSE;
			$data['insert_id'] = null;
		}
		return $data;
	}

    public function update($tbl_name, $data = [], $params = [])
    {
		if (!empty($data) && !empty($params)) {
			$query = 'UPDATE '.$tbl_name.' SET ';
			foreach ($data as $column => $value) {
				$querys[] = $column.' = ?';
				$val[] = $value;
			}
			$query .= implode(', ', $querys);
			$query .= ' WHERE ';
			foreach ($params as $column => $value) {
				$param[] = $column.' = ?';
				$val[] = $value;
			}
			$query .= implode(', ', $param);

			$stmt = $this->db->prepare($query);
			$data['query'] = $query;
			$data['result'] = $stmt->execute($val);
			$data['insert_id'] = $data['id'];
		} else {
			$data['query'] = 'Are you mad vroh?!?';
			$data['result'] = FALSE;
			$data['insert_id'] = null;
		}
		return $data;
	}

	public function submit_data(string $tbl_name, array $data)
	{
		if (empty($data['id'])) {
			$label = 'Insert';
			$data = array_merge($data, ['created_at' => date('Y-m-d H:i:s')]);
			$act = self::insert($tbl_name, $data);
		} else {
			$label = 'Update';
			$data = array_merge($data, ['updated_at' => date('Y-m-d H:i:s')]);
			$act = self::update($tbl_name, $data, ['id' => $data['id']]);
		}
		$err_msg = $act['result']?'Success!':'Error!';
		$is_success = $act['result']?'success':'danger';
		$alert = $err_msg.' '.$label.' '.ucwords(str_replace('_', ' ', $tbl_name)).' Data!';
		$msg['status'] = $act ? 'success' : 'error' ;
		$msg['alert'] = render_alert_lte($is_success, TRUE, $err_msg, $alert);
		$msg['insert_id'] = $act['insert_id'];
		return $msg;
	}

	public function delete_data(string $tbl_name, array $params)
	{
		$query = 'DELETE FROM '.$tbl_name.' WHERE ';
        foreach ($params as $column => $value) {
            $setters[] = $column.' = ?';
            $values[] = $value;
        }
        $query .= implode(', ', $setters);
		$stmt = $this->db->prepare($query);
		$act = $stmt->execute($values);
		if ($act) {
			$msg['status'] = 'success';
			$msg['alert'] = render_alert_lte('success', TRUE, 'Success!', 'Success! Delete Criteria Data!');
		} else {
			$msg['status'] = 'error';
			$msg['alert'] = render_alert_lte('danger', TRUE, 'Error!', 'Error! Delete Criteria Data!');
		}
		
		return $msg;
	}
}
