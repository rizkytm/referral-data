<?php

class ReferralModel extends CI_Model
{
    public function get()
    {
        $this->load->database();
        $query = $this->db->query("select * from referral_data");
        return $query->result();
    }
}
