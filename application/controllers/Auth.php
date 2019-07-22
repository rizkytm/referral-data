<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user_account', ['email' => $email])->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                // Jika role_id == 1, maka masuk ke halaman admin
                if ($user['role_id'] == 1) {
                    $this->session->set_userdata($data);
                    redirect('admin');
                    // Jika role_id == 2, maka masuk ke halaman user
                } else {
                    $this->session->set_userdata($data);
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
                Wrong Password</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
            Email is not registered</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user_account.email]', [
            'is_unique' => "This email has already registered!"
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => "Password doesn't match!",
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'date_created' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('user_account', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
            Congratulations! your account created. Please Login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
        You have been logged out</div>');
        redirect('auth');
    }
}
