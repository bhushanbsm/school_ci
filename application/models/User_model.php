<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    var $userId = null;

    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->getUserId();
    }

    public function login($data)
    {
        if (empty($data)) {
            return [];
        }
        $password = trim($data['password']);
        
        $this->db->select('users.*');
        $this->db->where('users.username', $data['username']);
        $this->db->where('users.password', md5($password));
        return $this->db->get($this->table)->row_array();
    }

    function getUserId() {
        $request_headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $request_headers) && !empty($request_headers['Authorization'])) {
            $bearer = $request_headers['Authorization'];
            $temp = explode(":", $bearer);
            $token = $temp[1];

            $this->load->helper('authorization');
            $decodedToken = AUTHORIZATION::validateTimestamp($token);
            if ($decodedToken != false) {
                $this->userId = $decodedToken->id;
            }
        }
        return $this->userId;
    }

}
