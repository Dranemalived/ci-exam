<?php

class Users_model extends CI_Model
{

    public function fetchAll()
    {
        $stmt = $this->db->from('users')->get();

        return $stmt->result();
    }
}
