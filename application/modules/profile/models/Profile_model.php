<?php

class Profile_model extends CI_Model
{

    public function fetch()
    {
        $res = $this->db->from('users')->where('id', $this->session->userdata('user_id'))->get();

        return $res->row();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $res = $this->db->update('users', $data);

        if ($res) {
            return TRUE;
        }
    }
}
