<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ak_model extends CI_Model
{
    function ambil_data($nomor)
    {
        $this->db->where('nomor', $nomor);
        $query = $this->db->get('data');
        return $query->result_array();
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

    function excel()
    {
        $this->db->select('*');
        $this->db->from('data');
        return $this->db->get();
    }
}
