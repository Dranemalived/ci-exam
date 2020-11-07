<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('core/Kickout_model', 'kickout');
        $this->load->model('Users_model', 'users');
    }
    public function index()
    {
        if ($this->kickout->if_not_logged_in()) {
            redirect('Login');
        }

        $data['userlist'] = $this->users->fetchAll();

        $this->load->view('layout/header');
        $this->load->view('layout/nav');
        $this->load->view('users', $data);
        $this->load->view('layout/footer');
    }
}
