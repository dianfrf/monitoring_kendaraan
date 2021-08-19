<?php   
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Kendaraan extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_Kendaraan');  
        }

        public function data_kendaraan()
        {
            $data['content'] = 'masterdata/v_datakendaraan';
            $data['active'] = 'Kendaraan';
            $data['count'] = $this->M_Kendaraan->count_datakendaraan();
            $data['kendaraan'] = $this->M_Kendaraan->get_datakendaraan();
            $data['PageTitle'] = 'Data Kendaraan';
            $this->load->view('layout/v_template', $data);  
        }

        public function tambah_kendaraan()
        {
            $this->form_validation->set_rules('nama_kendaraan', 'Nama Kendaraan', 'trim|required', array('required' => 'Nama Kendaraan harus diisi.'));
            $this->form_validation->set_rules('no_pol', 'Nomor Polisi', 'trim|required', array('required' => 'Nomor Polisi harus diisi.'));
            $this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'trim|required', array('required' => 'Jenis Kendaraan harus diisi.'));
            if ($this->form_validation->run() == TRUE) {
                $nama_kendaraan = $this->input->post('nama_kendaraan');
                $no_pol         = $this->input->post('no_pol');
                $jenis_kendaraan= $this->input->post('jenis_kendaraan');

                if ($this->input->post('add')) {
                    if ($this->M_Kendaraan->do_kendaraan_tambah($nama_kendaraan,$no_pol,$jenis_kendaraan) == TRUE) {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menambah data.</div>');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah data.</div>');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning">'.validation_errors().'</div>');
            }
            redirect('Data_Kendaraan');
        }

        public function get_kendaraan_id($id)
        {
            $data = $this->M_Kendaraan->do_get_kendaraan_id($id);
            echo (json_encode($data));
        }

        public function edit_kendaraan()
        {
            $this->form_validation->set_rules('nama_kendaraan', 'Nama Kendaraan', 'trim|required', array('required' => 'Nama Kendaraan harus diisi.'));
            $this->form_validation->set_rules('no_pol', 'Nomor Polisi', 'trim|required', array('required' => 'Nomor Polisi harus diisi.'));
            $this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'trim|required', array('required' => 'Jenis Kendaraan harus diisi.'));
            if ($this->form_validation->run() == TRUE) {
                $id_kendaraan   = $this->input->post('id_kendaraan');
                $nama_kendaraan = $this->input->post('nama_kendaraan');
                $no_pol         = $this->input->post('no_pol');
                $jenis_kendaraan= $this->input->post('jenis_kendaraan');
                if ($this->input->post('edit')) {
                    if ($this->M_Kendaraan->do_kendaraan_edit($id_kendaraan,$nama_kendaraan,$no_pol,$jenis_kendaraan) == TRUE) {
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
            redirect('Data_Kendaraan');
        }

        public function hapus_kendaraan($id='')
        {
            $delete = $this->M_Kendaraan->do_kendaraan_hapus($id);
            if ($delete == TRUE) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses menghapus data.</div>');
            }
            else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus data.</div>');
            }
            redirect('Data_Kendaraan');
        }
    }
?>