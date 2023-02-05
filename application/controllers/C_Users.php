<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Users_model');
        $this->load->helper('security');
        if (!$this->session->userdata('user_username')) redirect('C_login');
    }

    public function index()
    {
        $data['users'] = $this->M_Users_model->read();
        $this->load->view('template/header');
        $this->load->view('users/V_listuser', $data);
        $this->load->view('template/footer');
    }

    function create()
    {
        $this->load->view('template/header');
        $this->load->view('users/V_formuser');
        $this->load->view('template/footer');
    }

    function alpha_dash_space($user_password)
    {
        if (preg_match("/^([-a-z_ ])+$/i", $user_password)) {
            $this->form_validation->set_message('alpha_dash_space', 'Harap Masukan Password Angka dan huruf');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function add()
    {

        $this->form_validation->set_rules('user_password', 'user_password', 'trim|xss_clean|required|callback_alpha_dash_space', array('user_password' => 'angka dan number'));
        $this->form_validation->set_rules('user_username', 'Username', 'required');
        $this->form_validation->set_rules('user_email', 'Email', 'required');
        $this->form_validation->set_rules('user_type', 'User Tipe', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">
            ' . validation_errors() . '
          </div>',);
            $this->load->view('template/header');
            $this->load->view('users/V_formuser');
            $this->load->view('template/footer');
        } else {
            if ($this->input->post('submit')) {
                $data = [
                    'user_username' => $this->input->post('user_username'),
                    'user_password' => md5($this->input->post('user_password')),
                    'user_email' => $this->input->post('user_email'),
                    'user_type' => $this->input->post('user_type')
                ];
                $this->M_Users_model->create($data);
                $this->session->set_flashdata('success', 'User Berhasil ditambahkan');
                redirect('C_Users');
            }
        }
    }

    public function edit($id)
    {
        if ($this->input->post('submit')) {
            $query = $this->M_Users_model->update($id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('msg', '<p style="color:orange"> successfuly updated !</p>');
            } else {
                $this->session->set_flashdata('msg', '<p style="color:red"> update failed !</p>');
            }
            redirect('C_Users');
        }

        $data['user'] = $this->M_Users_model->read_by($id);
        $this->load->view('template/header');
        $this->load->view('users/V_edituser', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        $this->M_Users_model->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', ' successfuly deleted !');
        } else {
            $this->session->set_flashdata('msg', ' delete failed !');
        }
        redirect('C_Users');
    }

    function update()
    {
        $user_id = $this->input->post('user_id');
        $user_username = $this->input->post('user_username');
        $user_password = $this->input->post('user_password');
        $user_email = $this->input->post('user_email');
        $user_type = $this->input->post('user_type');

        $data = [
            'user_username' => $user_username,
            'user_email' => $user_email,
            'user_type' => $user_type,
        ];


        $this->M_Users_model->update($user_id, $data);

        redirect('C_Users');
    }
}
