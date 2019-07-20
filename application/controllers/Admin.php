<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Admin Home';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model("UserModel");

        $data['users'] =  $this->UserModel->get();

        $this->load->view('templates/home_header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/home_footer');
    }

    public function referral()
    {
        $this->load->model("ReferralModel");
        $data = array(
            "referrals" => $this->ReferralModel->get()
        );
        $this->load->view('templates/home_header', $data);
        $this->load->view('referral');
        $this->load->view('templates/home_footer');
    }

    public function adduser()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => "This email has already registered!"
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => "Password doesn't match!",
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to add new user
          </div>');

            redirect('admin');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'date_created' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New user successfully created
          </div>');
            redirect('admin');
        }
    }
}
