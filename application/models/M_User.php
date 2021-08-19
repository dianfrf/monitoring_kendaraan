<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');  
    class M_User extends CI_Model {
        public function do_user_tambah($nama,$username,$password,$level)
        {
            $object = array (
                'nama'                  => $nama,
                'username'              => $username,
                'password'              => $password,
                'level_user'            => $level
            );
            $this->db->insert('user', $object);
            if ($this->db->affected_rows()>0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function do_user_login($username,$password)
        {
            return $this->db->where('username', $username)->where('password', $password)->get('user');
        }

        public function count_penyetuju()
        {
            return $this->db->where('level_user', '2')->get('user')->num_rows();
        } 

        public function get_dataatasan()
        {
            return $this->db->order_by('nama','ASC')->where('level_user','2')->get('user')->result();
        }

        public function get_dataatasanl()
        {
            return $this->db->order_by('nama','ASC')->where('level_user','2')->limit(3)->get('user')->result();
        }

        public function do_atasan_tambah($nama,$username,$password)
        {
            $object = array (
                'nama'                  => $nama,
                'username'              => $username,
                'password'              => $password,
                'level_user'            => 2
            );
            $this->db->insert('user', $object);
            if ($this->db->affected_rows()>0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function do_get_atasan_id($id)
        {
            return $this->db->where('id_user', $id)->get('user')->row();
        }

        public function do_atasan_edit($id_user,$nama,$username)
        {
            $object = array (
                'nama'        => $nama,
                'username'    => $username
            );
            return $this->db->where('id_user', $id_user)->update('user', $object);
        }

        public function do_atasan_hapus($id)
        {
            return $this->db->where('id_user', $id)->delete('user');
        }
    }
?>