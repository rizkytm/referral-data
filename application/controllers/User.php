<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("UserModel");
        $this->load->model("ReferralModel");
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user_account', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['users'] = $this->UserModel->get_referral($data['user']['id']);

        $this->load->view('templates/home_header', $data);
        $this->load->view('user/user_referral', $data);
        $this->load->view('templates/home_footer');
    }

    public function addreferraldata()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user_account.email]', [
            'is_unique' => "This email has already registered!"
        ]);
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed to add new referral data
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('user');
        } else {
            $current_user['user'] = $this->db->get_where('user_account', ['email' =>
            $this->session->userdata('email')])->row_array();

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'referral_id' => $current_user['user']['id'],
                'date_created' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('referral_data', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            New referral data successfully created
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('user');
        }
    }

    public function updatereferraldata()
    {
        $id = $this->input->post('id-edit');
        $name = $this->input->post('name-edit');
        $no_hp = $this->input->post('no_hp-edit');
        $email = $this->input->post('email-edit');

        $update = $this->ReferralModel->update($id, $name, $no_hp, $email);

        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Referral data successfully updated
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('user');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed to update referral data
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('user');
        }
    }

    public function deletereferraldata()
    {
        $id = $this->input->post('id-delete');
        $delete = $this->ReferralModel->delete($id);
        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Referral data successfully removed
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('user');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed to delete referral data
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('user');
        }
    }
}
