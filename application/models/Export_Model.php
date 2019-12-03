<?php defined('BASEPATH') or die('No direct script access allowed');

class Export_model extends CI_Model
{

    public function excel()
    {
        $this->db->select('*');
        $this->db->from('data');
        return $this->db->get();
    }
}
