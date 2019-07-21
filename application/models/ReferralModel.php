<?php

class ReferralModel extends CI_Model
{
    public function get()
    {
        $this->load->database();
        $query = $this->db->query("select * from referral_data");
        return $query->result();
    }

    public function update($id, $name, $no_hp, $email)
    {
        $update = $this->db->query("UPDATE referral_data SET name='$name', no_hp='$no_hp', email='$email' WHERE id='$id'");
        return $update;
    }

    public function delete($id)
    {
        $this->load->database();
        $this->db->where('id', $id);
        return $this->db->delete('referral_data');
    }
}
