<?php

class Login_model extends CI_Model
{
    public function auth($email, $password)
    {
        $user = $this->db->from('users')->where('email', $email)->limit(1)->get();

        if ($user->num_rows() > 0) {
            $data = $user->row();

            if (password_verify($password, $data->password)) {

                if ($data->is_locked == "Y") {
                    return "locked";
                }

                $this->recordLastLoggedIn($data->id);

                $this->session->set_userdata([
                    'user_id' => $data->id,
                    'role' => $data->role,
                    'fullname' => $data->fullname,
                    'email' => $data->email,
                ]);

                return TRUE;
            } else {

                if ($data->is_locked != "Y") {
                    $try_num = $data->is_locked == "N" ? 0 : $data->is_locked;
                    $try_num = ($try_num == 2 ? "Y" : $try_num + 1);

                    $this->db->where('email', $email);
                    $this->db->update('users', ['is_locked' => $try_num]);
                }

                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function recordLastLoggedIn($id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', [
            'is_logged_in' => "Y",
            'last_logged_in' => date('Y-m-d h:i:s')
        ]);
    }

    public function recordLogout($id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', [
            'is_logged_in' => "N"
        ]);
    }
}
