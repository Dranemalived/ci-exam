<?php

class Profile_model extends CI_Model
{

    public function fetch()
    {
        $res = $this->db->from('users')->where('id', $this->session->userdata('user_id'))->get();

        return $res->row();
    }
}
