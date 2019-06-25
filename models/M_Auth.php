<?php
$base_path = isset($base_path) ? $base_path : '../' ;
include_once $base_path . 'helpers/function.php';

class M_Auth {
    private $db = NULL;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function attempt_login(array $data)
    {
        $query = 'SELECT * FROM users WHERE username = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute([$data['username']]);
        $num_rows = $stmt->rowCount();
        if ($num_rows > 0) {
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            if (verify_hash($data['password'], $row->password)) {
                $this->register_session($row);
                $alert = render_alert('success', TRUE, 'Success!', 'Welcome to App!');
                $results = ['status' => 'success', 'msg' => $alert];
            } else {
                $alert = render_alert('danger', TRUE, 'Error!', 'Password doesnt match!');
                $results = ['status' => 'error', 'msg' => $alert];
            }
        } else {
            $alert = render_alert('danger', TRUE, 'Error!', 'Username doesnt exist!');
            $results = ['status' => 'error', 'msg' => $alert];
        }

        return $results;
    }

    public function register_session($row)
    {
        $_SESSION['auth'] = [
            'id' => $row->id,
            'username' => $row->username,
            'name' => $row->name,
            'email' => $row->email,
            'user_img' => $row->user_img,
            'created_at' => $row->created_at,
        ];
    }
}
