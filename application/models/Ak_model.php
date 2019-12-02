<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ak_model extends CI_Model
{
    // Start Hitung Penjumlahan 

    public function jumlah_trx()
    {
        $this->db->select_sum('jml_trx');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->jml_trx;
        } else {
            return 0;
        }
    }
    public function jumlah_spl()
    {
        $this->db->select_sum('spl');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->spl;
        } else {
            return 0;
        }
    }
    public function jumlah_selisih_trx()
    {
        $this->db->select_sum('jml_trx');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->jml_trx;
        } else {
            return 0;
        }
    }
    public function Jumlah_saldo_awal()
    {
        $this->db->select_sum('jml_trx');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->jml_trx;
        } else {
            return 0;
        }
    }
    public function jumlah_deposit()
    {
        $this->db->select_sum('jml_trx');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->jml_trx;
        } else {
            return 0;
        }
    }
    public function jumlah_pemakaian()
    {
        $this->db->select_sum('jml_trx');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->jml_trx;
        } else {
            return 0;
        }
    }
    public function jumlah_saldo_akhir_cs()
    {
        $this->db->select_sum('jml_trx');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->jml_trx;
        } else {
            return 0;
        }
    }
    public function jumlah_selisih_akhir()
    {
        $this->db->select_sum('jml_trx');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->jml_trx;
        } else {
            return 0;
        }
    }

    // End Hitung penjumlahan



    function login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('login');
        return $query->result_array();
    }

    function nomor()
    {
        $this->db->select('nomor');
        $this->db->order_by('nomor DESC');
        $query = $this->db->get('data');
        return $query->result_array();
    }

    function ambil_data($nomor)
    {
        $this->db->where('nomor', $nomor);
        $query = $this->db->get('data');
        return $query->result_array();
    }

    function tambah_pemasukan($data)
    {
        $query = $this->db->insert('data', $data);
        return $query;
    }

    function tambah_pengeluaran($data)
    {
        $query = $this->db->insert('data', $data);
        return $query;
    }

    function ubah($nomor, $data)
    {
        $this->db->where('nomor', $nomor);
        $query = $this->db->update('data', $data);
        return $query;
    }

    function hapus($nomor)
    {
        $this->db->where('nomor', $nomor);
        $query = $this->db->delete('data');
        return $query;
    }

    function row_harian($tanggal)
    {
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get('data');
        return $query->num_rows();
    }

    function laporan_harian($tanggal, $number, $offset)
    {
        $this->db->where('tanggal', $tanggal);
        $this->db->order_by('nomor ASC');
        $query = $this->db->get('data', $number, $offset);
        return $query->result();
    }

    function row_periode($mulai, $sampai)
    {
        $this->db->where('tanggal >=', $mulai);
        $this->db->where('tanggal <=', $sampai);
        $query = $this->db->get('data');
        return $query->num_rows();
    }

    function laporan_periode($mulai, $sampai, $number, $offset)
    {
        $this->db->where('tanggal >=', $mulai);
        $this->db->where('tanggal <=', $sampai);
        $this->db->order_by('nomor DESC');
        $query = $this->db->get('data', $number, $offset);
        return $query->result();
    }

    function row_masuk()
    {
        $this->db->where('jenis', 'masuk');
        $query = $this->db->get('data');
        return $query->num_rows();
    }

    function masuk($number, $offset)
    {
        $this->db->where('jenis', 'masuk');
        $this->db->order_by('nomor ASC');
        $query = $this->db->get('data', $number, $offset);
        return $query->result();
    }

    function row_keluar()
    {
        $this->db->where('jenis', 'keluar');
        $query = $this->db->get('data');
        return $query->num_rows();
    }

    function keluar($number, $offset)
    {
        $this->db->where('jenis', 'keluar');
        $this->db->order_by('nomor ASC');
        $query = $this->db->get('data', $number, $offset);
        return $query->result();
    }

    function row_cari($search)
    {
        $this->db->from('data');
        $this->db->or_like($search);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function cari($batas = null, $offset = null, $search = null)
    {
        $this->db->from('data');
        if ($batas != null) {
            $this->db->limit($batas, $offset);
        }
        if ($search != null) {
            $this->db->or_like($search);
        }
        $this->db->order_by('nomor ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function total_masuk()
    {
        $this->db->select('selisih');
        $this->db->from('data');
        $this->db->where('jenis', 'masuk');
        $query = $this->db->get();
        return $query->result();
    }

    function total_keluar()
    {
        $this->db->select('jumlah');
        $this->db->from('data');
        $this->db->where('jenis', 'keluar');
        $query = $this->db->get();
        return $query->result();
    }

    function total_harian_masuk($tanggal)
    {
        $this->db->select('selisih');
        $this->db->from('data');
        $this->db->where('tanggal', $tanggal);
        $this->db->where('jenis', 'masuk');
        $query = $this->db->get();
        return $query->result();
    }

    function total_harian_keluar($tanggal)
    {
        $this->db->select('selisih');
        $this->db->from('data');
        $this->db->where('tanggal', $tanggal);
        $this->db->where('jenis', 'masuk');
        $query = $this->db->get();
        return $query->result();
    }

    function total_periode_masuk($mulai, $sampai)
    {
        $this->db->select('selisih');
        $this->db->from('data');
        $this->db->where('tanggal >=', $mulai);
        $this->db->where('tanggal <=', $sampai);
        $this->db->where('jenis', 'masuk');
        $query = $this->db->get();
        return $query->result();
    }

    function total_periode_keluar($mulai, $sampai)
    {
        $this->db->select('selisih');
        $this->db->from('data');
        $this->db->where('tanggal >=', $mulai);
        $this->db->where('tanggal <=', $sampai);
        $this->db->where('jenis', 'keluar');
        $query = $this->db->get();
        return $query->result();
    }

    function bersihkan()
    {
        $query = $this->db->truncate('data');
        return $query;
    }

    function excel()
    {
        $this->db->select('*');
        $this->db->from('data');
        return $this->db->get();
    }
}
