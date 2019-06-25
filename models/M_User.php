<?php
$base_path = isset($base_path) ? $base_path : '../' ;
include_once $base_path . 'helpers/function.php';

class M_User {
    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ssp_datatables()
    {
		// Nama Table yang digunakan
		$data['table'] = 'users';

		// Kolom Primary dalam Tabel
		$data['primaryKey'] = 'id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$data['columns'] = array(
			array( 'db' => 'id', 'dt' => 1, 'field' => 'id',
				'formatter' => function($d, $row) {
					return $this->tbl_btn($d, $row[3]);
				} ),
			array( 'db' => 'id', 'dt' => 2, 'field' => 'id' ),
			array( 'db' => 'username', 'dt' => 3, 'field' => 'username' ),
			array( 'db' => 'name', 'dt' => 4, 'field' => 'name' ),
			array( 'db' => 'email', 'dt' => 5, 'field' => 'email' ),
			array( 'db' => 'created_at', 'dt' => 6, 'field' => 'created_at',
				'formatter' => function($d) {
					return format_date($d, 'd-m-Y H:i:s');
				} ),
		);

		// SQL server connection information
		$data['sql_details'] = datatables_conn();

		$data['joinQuery'] = '';
		$data['extraWhere'] = 'id != \'' . $_SESSION['auth']['id'] . '\'';
		$data['groupBy'] = '';
		$data['having'] = '';

		return $data;
    }

	private function tbl_btn($id = '', $var = '')
	{
		$is_read_access = true;
		$is_update_access = true;
		$is_delete_access = true;

		$btns = array();
		$btns[] = get_btn(array('access' => $is_read_access, 'title' => 'Detail Users', 'icon' => 'search', 'onclick' => 'view_detail(\''.$id.'\')'));
		$btns[] = get_btn(array('access' => $is_update_access, 'title' => 'Ubah', 'icon' => 'pencil', 'onclick' => 'get_form(\''.$id.'\')'));
		$btns[] = get_btn_divider();
		$btns[] = get_btn(array('access' => $is_delete_access, 'title' => 'Hapus', 'icon' => 'trash',
			'onclick' => 'return confirm(\'Do you really want to delete User = '.$var.'?\')?delete_data(\''.$id.'\'):false'));
		$btn_group = group_btns($btns, 'Opsi');

		return $btn_group;
	}

	public function get_row($id = '')
	{
		$query = 'SELECT * FROM users WHERE id = ?';
		$stmt = $this->db->prepare($query);
		$stmt->execute([$id]);
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		if (!empty($row)) {
			$data = (object) ['id' => $row->id, 'username' => $row->username, 'password' => $row->password, 'name' => $row->name, 'email' => $row->email, 'user_img' => $row->user_img, 'created_at' => $row->created_at, 'updated_at' => $row->updated_at];
		} else {
			$data = (object) ['id' => '', 'username' => '', 'password' => '', 'name' => '', 'email' => '', 'user_img' => '', 'created_at' => '', 'updated_at' => ''];
		}

		return $data;
	}

	public function chk_username($new_username, $id)
	{
		$query = 'SELECT * FROM users WHERE username = ? AND id != ?';
		$stmt = $this->db->prepare($query);
		$stmt->execute([$new_username, $id]);
		$num_rows = $stmt->rowCount();
		return $num_rows > 0 ? false : true ;
	}
}
