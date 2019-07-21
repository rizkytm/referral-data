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
        if ($this->session->userdata('role_id') === '1') {
            $data['title'] = 'Admin Home';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

            $this->load->model("UserModel");

            $data['users'] =  $this->UserModel->get();

            $this->load->view('templates/home_header', $data);
            $this->load->view('home', $data);
            $this->load->view('templates/home_footer');
        } else {
            $data['title'] = 'Unauthorized';
            $this->load->view('templates/home_header', $data);
            $this->load->view('401');
            $this->load->view('templates/home_footer');
        }
    }

    public function referral()
    {
        if ($this->session->userdata('role_id') === '1') {
            $data['title'] = 'Admin Home';
            $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

            $this->load->model("ReferralModel");
            $this->load->model("UserModel");

            $data['referrals'] =  $this->ReferralModel->get();
            $data['users'] =  $this->UserModel->get_all();

            $this->load->view('templates/home_header', $data);
            $this->load->view('referral', $data);
            $this->load->view('templates/home_footer');
        } else {
            $data['title'] = 'Unauthorized';
            $this->load->view('templates/home_header', $data);
            $this->load->view('401');
            $this->load->view('templates/home_footer');
        }
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

    public function update()
    {
        $this->load->model("UserModel");

        $id = $this->input->post('id-edit');
        $name = $this->input->post('name-edit');
        $update = $this->UserModel->update($id, $name);
        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            User successfully updated
          </div>');
            redirect('admin');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to update user
          </div>');
            redirect('admin');
        }
    }

    public function delete()
    {
        $this->load->model("UserModel");
        $id = $this->input->post('id-delete');
        $delete = $this->UserModel->delete($id);
        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            User successfully removed
          </div>');
            redirect('admin');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to delete user
          </div>');
            redirect('admin');
        }
    }

    public function addreferraldata()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => "This email has already registered!"
        ]);
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric');
        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to add new referral data
          </div>');

            redirect('admin/referral');
        } else {
            $current_user['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'referral_id' => $current_user['user']['id'],
                'date_created' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('referral_data', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New referral data successfully created
          </div>');
            redirect('admin/referral');
        }
    }

    public function updatereferraldata()
    {
        $this->load->model("ReferralModel");

        $id = $this->input->post('id-edit');
        $name = $this->input->post('name-edit');
        $no_hp = $this->input->post('no_hp-edit');
        $email = $this->input->post('email-edit');
        $update = $this->ReferralModel->update($id, $name, $no_hp, $email);
        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Referral data successfully updated
          </div>');
            redirect('admin/referral');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to update referral data
          </div>');
            redirect('admin/referral');
        }
    }

    public function deletereferraldata()
    {
        $this->load->model("ReferralModel");
        $id = $this->input->post('id-delete');
        $delete = $this->ReferralModel->delete($id);
        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Referral data successfully removed
          </div>');
            redirect('admin/referral');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to delete referral data
          </div>');
            redirect('admin/referral');
        }
    }
}
