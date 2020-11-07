<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }
    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('login');
        $this->load->view('layout/footer');
    }

    public function auth()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $res = $this->Login_model->auth($email, $pass);

        if ($res === "locked") {
            echo json_encode(['error' => TRUE, 'message' => 'Account locked']);
        } else if ($res) {
            echo json_encode(['error' => FALSE, 'redirect' => base_url('Profile')]);
        } else {
            echo json_encode(['error' => TRUE, 'message' => 'Invalid email or password']);
        }
    }

    public function logout()
    {
        $user_id = $this->session->userdata('user_id');

        $this->Login_model->recordLogout($user_id);
        $this->session->sess_destroy();
        redirect('Login');
    }
}
