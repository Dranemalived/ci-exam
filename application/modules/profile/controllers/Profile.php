<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('core/Kickout_model', 'kickout');
        $this->load->model('Profile_model', 'profile');
    }
    public function index()
    {
        if ($this->kickout->if_not_logged_in()) {
            redirect('Login');
        }

        $data['profile'] = $this->profile->fetch();

        $this->load->view('layout/header');
        $this->load->view('layout/nav');
        $this->load->view('profile', $data);
        $this->load->view('layout/footer');
    }

    public function update()
    {
        $data = $this->input->post();
        $id = $data['id'];
        $res = $this->profile->update($data, $id);

        if ($res) {
            echo json_encode(['error' => FALSE, 'message' => 'User information updated successfully']);
        }
    }
}
