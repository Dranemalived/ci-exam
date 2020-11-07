<?php

class Kickout_model extends CI_Model
{
    public function if_not_logged_in()
    {
        if ($this->session->userdata('user_id')) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
