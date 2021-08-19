<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class User extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_User');
        }
        
        public function index()
        {
            $this->load->view('auth/v_login');
        }

        public function register()
        {
            $this->load->view('auth/v_register');
        }

        public function user_register()
        {
            $this->form_validation->set_rules('nama', 'Nama User', 'trim|required', array('required' => 'Nama User harus diisi.'));
            $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi.'));
            $this->form_validation->set_rules('level_user', 'Level', 'trim|required', array('required' => 'Level harus diisi.'));
            if ($this->form_validation->run() == TRUE) {
                $nama           = $this->input->post('nama');
                $username       = $this->input->post('username');
                $password       = md5($this->input->post('password'));
                $level          = $this->input->post('level_user');

                if ($this->input->post('register')) {
                    if ($this->M_User->do_user_tambah($nama,$username,$password,$level) == TRUE) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses registrasi.</div>');
                        redirect('');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal registrasi.</div>');
                        redirect('Register');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
                    redirect('Register');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning">'.validation_errors().'</div>');
                redirect('Register');
            }
        }

        public function user_login()
        {
            $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi.'));
            if ($this->form_validation->run() == TRUE) {
                $username       = $this->input->post('username');
                $password       = md5($this->input->post('password'));

                if ($this->M_User->do_user_login($username,$password)->num_rows() > 0) {
                    $data = $this->M_User->do_user_login($username,$password)->row();
                    $datauser = array(
                        'login' => TRUE,
                        'username' => $data->username,
                        'nama' => $data->nama,
                        'level' => $data->level_user,
                        'id_user' => $data->id_user
                    );
                    $this->session->set_userdata($datauser);
                    redirect('Dashboard','refresh');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal Login. Periksa username dan password Anda!</div>');
                    redirect('');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning">'.validation_errors().'</div>');
                redirect('');
            }
        }

        public function user_logout()
        {
            $this->session->sess_destroy();
            redirect('', 'refresh');
        }

        public function data_atasan()
        {
            $data['content'] = 'masterdata/v_dataatasan';
            $data['active'] = 'Atasan';
            $data['count'] = $this->M_User->count_penyetuju();
            $data['atasan'] = $this->M_User->get_dataatasan();
            $data['PageTitle'] = 'Data Atasan / Penyetuju';
            $this->load->view('layout/v_template', $data);  
        }

        public function tambah_atasan()
        {
            $this->form_validation->set_rules('nama', 'Nama User', 'trim|required', array('required' => 'Nama User harus diisi.'));
            $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password harus diisi.'));
            if ($this->form_validation->run() == TRUE) {
                $nama           = $this->input->post('nama');
                $username       = $this->input->post('username');
                $password       = md5($this->input->post('password'));

                if ($this->input->post('add')) {
                    if ($this->M_User->do_atasan_tambah($nama,$username,$password) == TRUE) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menambah data.</div>');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal rmenambah data.</div>');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning">'.validation_errors().'</div>');
            }
            redirect('Data_Atasan');
        }

        public function get_atasan_id($id)
        {
            $data = $this->M_User->do_get_atasan_id($id);
            echo (json_encode($data));
        }

        public function edit_atasan()
        {
            $this->form_validation->set_rules('nama', 'Nama User', 'trim|required', array('required' => 'Nama User harus diisi.'));
            $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username harus diisi.'));
            if ($this->form_validation->run() == TRUE) {
                $id_user        = $this->input->post('id_user');
                $nama           = $this->input->post('nama');
                $username       = $this->input->post('username');
                if ($this->input->post('edit')) {
                    if ($this->M_User->do_atasan_edit($id_user,$nama,$username) == TRUE) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses mengubah data.</div>');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengubah data.</div>');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning">'.validation_errors().'</div>');
            }
            redirect('Data_Atasan');
        }

        public function hapus_atasan($id='')
        {
            $delete = $this->M_User->do_atasan_hapus($id);
            if ($delete == TRUE) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menghapus data.</div>');
            }
            else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus data.</div>');
            }
            redirect('Data_Atasan');
        }
    }
?>