<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');  
    class M_Kendaraan extends CI_Model {
        public function count_datakendaraan()
        {
            return $this->db->get('kendaraan')->num_rows();
        } 
        
        public function get_datakendaraan()
        {
            return $this->db->order_by('id_kendaraan','ASC')->get('kendaraan')->result();
        }

        public function get_datakendaraanl()
        {
            return $this->db->order_by('id_kendaraan','ASC')->limit(3)->get('kendaraan')->result();
        }

        public function do_kendaraan_tambah($nama_kendaraan,$no_pol,$jenis_kendaraan)
        {
            $object = array (
                'nama_kendaraan'    => $nama_kendaraan,
                'no_pol'            => $no_pol,
                'jenis_kendaraan'   => $jenis_kendaraan,
                'is_ready'          => 1
            );
            $this->db->insert('kendaraan', $object);
            if ($this->db->affected_rows()>0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function do_get_kendaraan_id($id)
        {
            return $this->db->where('id_kendaraan', $id)->get('kendaraan')->row();
        }

        public function do_kendaraan_edit($id_kendaraan,$nama_kendaraan,$no_pol,$jenis_kendaraan)
        {
            $object = array (
                'nama_kendaraan'        => $nama_kendaraan,
                'no_pol'                => $no_pol,
                'jenis_kendaraan'       => $jenis_kendaraan,
                'is_ready'              => 1
            );
            return $this->db->where('id_kendaraan', $id_kendaraan)->update('kendaraan', $object);
        }

        public function do_kendaraan_hapus($id)
        {
            return $this->db->where('id_kendaraan', $id)->delete('kendaraan');
        }
    } 
?>