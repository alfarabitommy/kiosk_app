<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function verify_login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('sys_users');

        if ($query->num_rows() === 1) {
            $user = $query->row();
            // Verifikasi hash password (pastikan password di-hash dengan password_hash() saat pembuatan user)
            if (password_verify($password, $user->password)) {
                // Update waktu last login
                $this->db->where('id', $user->id);
                $this->db->update('sys_users', array('last_login' => date('Y-m-d H:i:s')));
                
                return $user;
            }
        }
        return FALSE;
    }
}