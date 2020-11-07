<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Registration_model');
    }

    public function save()
    {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password1', 'Password', 'required', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]');
        $this->form_validation->set_rules('terms', 'Terms and Condition', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['error' => TRUE, 'message' => validation_errors()]);
            exit;
        }
        if (!$this->email_check()) {
            echo json_encode(['error' => TRUE, 'message' => 'Email already existing']);
            exit;
        }

        $data = $this->input->post();
        $this->Registration_model->data = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => password_hash($data['password1'], PASSWORD_DEFAULT)
        ];

        $res = $this->Registration_model->save();
        echo json_encode(['error' => FALSE, 'message' => 'Registration success']);
    }

    public function email_check($jsonMode = FALSE)
    {
        $email = $this->input->post('email');
        $check = $this->Registration_model->validateEmail($email);

        if ($jsonMode == FALSE) {
            return $check;
        } else {
            if (!$check) {
                echo json_encode(['error' => TRUE, 'message' => 'Email already existing']);
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['error' => TRUE, 'message' => 'Invalid email format']);
            } else {
                echo json_encode(['error' => FALSE, 'message' => 'Email is valid']);
            }
        }
    }
}
