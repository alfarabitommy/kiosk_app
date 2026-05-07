<!-- // File: application/controllers/Auth.php -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('admin');
        }
        $this->load->view('admin/login_view');
    }

    public function login_process() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->Auth_model->verify_login($username, $password);

        if ($user) {
            $userdata = array(
                'user_id'   => $user->id,
                'username'  => $user->username,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($userdata);
            redirect('admin');
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}