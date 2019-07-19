<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        echo 'Selamat datang ' . $data['user']['name'];
    }

    public function home()
    {
        $data['title'] = 'Home';
        $this->load->view('templates/home_header', $data);
        $this->load->view('home');
        $this->load->view('templates/home_footer');
    }

    public function referral()
    {
        $data['title'] = 'Referral';
        $this->load->view('templates/home_header', $data);
        $this->load->view('referral');
        $this->load->view('templates/home_footer');
    }

    public function member()
    {
        $data['title'] = 'Referral';
        $this->load->view('templates/home_header', $data);
        $this->load->view('user_referral');
        $this->load->view('templates/home_footer');
    }
}
