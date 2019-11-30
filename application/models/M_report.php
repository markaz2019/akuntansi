<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model
{
    public function jumlah()
    {
        $this->db->select_sum('jml_trx');
        $query = $this->db->get('data');
        if ($query->num_rows() > 0) {
            return $query->row()->jml_trx;
        } else {
            return 0;
        }
    }
}
