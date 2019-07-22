<?php

class UserModel extends CI_Model
{
    public function get()
    {
        $this->load->database();
        $query = $this->db->query("select * from user_account where role_id='2'");
        return $query->result();
    }

    // public function update($data = array(), $id)
    // {
    //     $this->load->database();
    //     $this->db->where('id', $id);
    //     return $this->db->update("user", $data);
    // }

    public function update($id, $name)
    {
        $update = $this->db->query("UPDATE user_account SET name='$name' WHERE id='$id'");
        return $update;
    }

    public function delete($id)
    {
        $this->load->database();
        $this->db->where('id', $id);
        return $this->db->delete('user_account');
    }

    public function get_referral($id)
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM referral_data WHERE referral_id='$id'");
        return $query->result();
    }

    public function get_all()
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM user_account");
        return $query->result();
    }
}
