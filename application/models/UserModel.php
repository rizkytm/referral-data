<?php

class UserModel extends CI_Model
{
    public function get()
    {
        $this->load->database();
        $query = $this->db->query("select * from user");
        return $query->result();
    }
}
