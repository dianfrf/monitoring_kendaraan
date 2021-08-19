<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Monitoring extends CI_Controller {  
        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_Pemesanan');
            $this->load->model('M_Kendaraan');
            $this->load->model('M_User');
        }
        
        public function dashboard()
        {
            $data['content'] = 'v_dashboard';
            $data['active'] = 'Dashboard';
            $data['tothistori'] = $this->M_Pemesanan->count_histori();
            $data['totkendaraan'] = $this->M_Kendaraan->count_datakendaraan();
            $data['totpenyetuju'] = $this->M_User->count_penyetuju();
            $data['kendaraan'] = $this->M_Kendaraan->get_datakendaraanl();
            $data['atasan'] = $this->M_User->get_dataatasanl();
            $data['histori'] = $this->M_Pemesanan->get_historil();
            $data['hasil'] = $this->M_Pemesanan->bulan();
            $data['barang'] = $this->M_Pemesanan->barang();
            $data['orang'] = $this->M_Pemesanan->orang();
            $data['PageTitle'] = 'Dashboard';
            $this->load->view('layout/v_template', $data);  
        }

        public function pesan_kendaraan()
        {
            $data['content'] = 'pemesanan/v_pesankendaraan';
            $data['active'] = 'PesanKendaraan';
            $data['count'] = $this->M_Kendaraan->count_datakendaraan();
            $data['kendaraan'] = $this->M_Kendaraan->get_datakendaraan();
            $data['penyetuju'] = $this->M_User->get_dataatasan();
            $data['PageTitle'] = 'Pesan Kendaraan';
            $this->load->view('layout/v_template', $data);  
        }

        public function kendaraan_pesan()
        {
            $this->form_validation->set_rules('tgl_pemesanan', 'Tanggal Pemesanan', 'trim|required', array('required' => 'Tanggal Pemesanan harus diisi.'));
            $this->form_validation->set_rules('waktu_pemesanan', 'Waktu Pemesanan', 'trim|required', array('required' => 'Waktu Pemesanan harus diisi.'));
            $this->form_validation->set_rules('lama_pemesanan', 'Durasi Pemesanan', 'trim|required', array('required' => 'Durasi Pemesanan harus diisi.'));
            $this->form_validation->set_rules('nama_driver', 'Nama Driver', 'trim|required', array('required' => 'Nama Driver harus diisi.'));
            $this->form_validation->set_rules('penyetuju', 'Penyetuju', 'trim|required', array('required' => 'Penyetuju harus diisi.'));
            if ($this->form_validation->run() == TRUE) {
                $id_kendaraan       = $this->input->post('id_kendaraan');
                $tgl_pemesanan      = $this->input->post('tgl_pemesanan');
                $waktu_pemesanan    = $this->input->post('waktu_pemesanan');
                $lama_pemesanan     = $this->input->post('lama_pemesanan');
                $nama_driver        = $this->input->post('nama_driver');
                $penyetuju          = $this->input->post('penyetuju');

                if ($this->input->post('pesan')) {
                    if ($this->M_Pemesanan->do_pemesanan($id_kendaraan,$tgl_pemesanan,$waktu_pemesanan,$lama_pemesanan,$nama_driver,$penyetuju) == TRUE) {
                        $this->M_Pemesanan->do_edit_kendaraan_status($id_kendaraan);
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses memesan kendaraan.</div>');
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal memesan kendaraan.</div>');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Terjadi kesalahan pada jaringan.</div>');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning">'.validation_errors().'</div>');
            }
            redirect('Pesan_Kendaraan');
        }

        public function daftar_pemesanan()
        {
            $data['content'] = 'pemesanan/v_daftarpemesanan';
            $data['active'] = 'DaftarPemesanan';
            $id_user = $this->session->userdata('id_user');
            $data['count'] = $this->M_Pemesanan->count_datapemesanan($id_user);
            $data['pemesanan'] = $this->M_Pemesanan->get_datapemesanan($id_user);
            $data['PageTitle'] = 'Data Pemesanan';
            $this->load->view('layout/v_template', $data);  
        }

        public function verifikasi($id='')
        {
            if ($this->input->post('yes')) {
                $this->M_Pemesanan->do_setujui_verifikasi($id);
                $pemesanan = $this->db->where('id_pemesanan', $id)->get('pemesanan')->row();
                $id_kendaraan = $pemesanan->id_kendaraan;
                $this->db->query("UPDATE kendaraan SET is_ready=0 WHERE id_kendaraan='$id_kendaraan'");
            }
            else {
                $this->M_Pemesanan->do_tolak_verifikasi($id);
                $pemesanan = $this->db->where('id_pemesanan', $id)->get('pemesanan')->row();
                $id_kendaraan = $pemesanan->id_kendaraan;
                $this->db->query("UPDATE kendaraan SET is_ready=1 WHERE id_kendaraan='$id_kendaraan'");
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sukses verifikasi.</div>');
            redirect('Daftar_Pemesanan');
        }

        public function inputhistori($id='')
        {
            if ($this->input->post('selesaikan')) {
                $this->M_Pemesanan->do_selesai($id);
                $pemesanan = $this->db->where('id_kendaraan', $id)->order_by('id_pemesanan', 'DESC')->limit(1)->get('pemesanan')->row();
                $id_pemesanan = $pemesanan->id_pemesanan;
                $this->db->query("INSERT INTO histori_pemesanan VALUES('','$id_pemesanan')");
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Pesanan Selesai.</div>');
            redirect('Pesan_Kendaraan');
        }

        public function histori_pemesanan()
        {
            $data['content'] = 'pemesanan/v_historipemesanan';
            $data['active'] = 'Histori';
            $data['count'] = $this->M_Pemesanan->count_histori();
            $data['histori'] = $this->M_Pemesanan->get_histori();
            $data['PageTitle'] = 'Histori Pemesanan';
            $this->load->view('layout/v_template', $data);  
        }

        public function export_excel()
        {
            $data['PageTitle'] = "Histori Pemesanan";
            $data['histori'] = $this->M_Pemesanan->get_histori();
            $this->load->view('pemesanan/v_export', $data);  
        }
    }
?>