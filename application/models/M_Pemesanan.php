<?php  
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    class M_Pemesanan extends CI_Model {
        public function do_pemesanan($id_kendaraan,$tgl_pemesanan,$waktu_pemesanan,$lama_pemesanan,$nama_driver,$penyetuju)
        {
            $object = array (
                'id_kendaraan'          => $id_kendaraan,
                'tgl_pemesanan'         => $tgl_pemesanan,
                'waktu_pemesanan'       => $waktu_pemesanan,
                'lama_pemesanan'        => $lama_pemesanan,
                'nama_driver'           => $nama_driver,
                'penyetuju'             => $penyetuju,
                'verifikasi'            => 2
            );
            $this->db->insert('pemesanan', $object);
            if ($this->db->affected_rows()>0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function do_edit_kendaraan_status($id_kendaraan)
        {
            $object = array (
                'is_ready'  => 2
            );
            return $this->db->where('id_kendaraan', $id_kendaraan)->update('kendaraan', $object);
        }

        public function count_datapemesanan($id_user)
        {
            return $this->db->where('penyetuju', $id_user)->get('pemesanan')->num_rows();
        } 
        
        public function get_datapemesanan($id_user)
        {
            return $this->db->join('kendaraan','pemesanan.id_kendaraan=kendaraan.id_kendaraan')
                            ->where('penyetuju', $id_user)->order_by('pemesanan.id_kendaraan','ASC')->get('pemesanan')->result();
        }

        public function do_setujui_verifikasi($id)
        {
            $object = array (
                'verifikasi'  => 1
            );
            return $this->db->where('id_pemesanan', $id)->update('pemesanan', $object);
        }
        public function do_tolak_verifikasi($id)
        {
            $object = array (
                'verifikasi'  => 0
            );
            return $this->db->where('id_pemesanan', $id)->update('pemesanan', $object);
        }

        public function do_selesai($id)
        {
            $object = array (
                'is_ready'  => 1
            );
            return $this->db->where('id_kendaraan', $id)->update('kendaraan', $object);
        }

        public function count_histori()
        {
            return $this->db->get('histori_pemesanan')->num_rows();
        } 
        
        public function get_histori()
        {
            return $this->db->join('pemesanan','histori_pemesanan.id_pemesanan=pemesanan.id_pemesanan')
                            ->join('kendaraan', 'pemesanan.id_kendaraan=kendaraan.id_kendaraan')
                            ->join('user', 'pemesanan.penyetuju=user.id_user')
                            ->order_by('tgl_pemesanan','DESC')->get('histori_pemesanan')->result();
        }

        public function get_historil()
        {
            return $this->db->join('pemesanan','histori_pemesanan.id_pemesanan=pemesanan.id_pemesanan')
                            ->join('kendaraan', 'pemesanan.id_kendaraan=kendaraan.id_kendaraan')
                            ->join('user', 'pemesanan.penyetuju=user.id_user')
                            ->order_by('tgl_pemesanan','DESC')->limit(3)->get('histori_pemesanan')->result();
        }

        public function bulan()
        {
            $query = $this->db->query("SELECT MONTH(tgl_pemesanan) as bulan, 
                                        COUNT(MONTH(tgl_pemesanan)) as jumlah 
                                        FROM histori_pemesanan 
                                        INNER JOIN pemesanan ON histori_pemesanan.id_pemesanan=pemesanan.id_pemesanan
                                        GROUP BY MONTH(tgl_pemesanan) 
                                        ORDER BY MONTH(tgl_pemesanan) ASC");
            return $query->result();
        }

        public function orang()
        {
            return $this->db->where('jenis_kendaraan', '1')->get('kendaraan')->num_rows();
        }

        public function barang()
        {
            return $this->db->where('jenis_kendaraan', '2')->get('kendaraan')->num_rows();
        }
    }
?>