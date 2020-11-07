<?php

class Registration_model extends CI_Model
{
    public $tableName = 'users';
    public $data = [];

    public function save()
    {
        $stmt = $this->db->insert($this->tableName, $this->data);

        if ($stmt) {
            return TRUE;
        }
    }

    public function validateEmail($email)
    {
        $stmt = $this->db->select('email')
            ->from($this->tableName)
            ->where('email', $email)
            ->get();

        if ($stmt->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
