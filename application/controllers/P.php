<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ak_model');
	}
	// index
	function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('beranda');
		$this->load->view('template/footer');
	}

	// Laporan Keseluruhan
	function laporan()
	{
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('all/laporan');
		$this->load->view('template/footer');
	}

	function laporan_harian()
	{
		if (!$this->uri->segment(3)) {
			$cek = $this->input->post('tanggal');
		} else {
			$cek = $this->uri->segment(3);
		}
		$tgl_uri = str_replace('/', '-', $cek);
		$tgldb = str_replace('-', '/', $cek);
		$total = $this->Ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from),
			'nirwana' 		=> $this->Ak_model->laporan_harian_nirwana($tgldb, $config['per_page'], $from),
			'nirwana_oto' 	=> $this->Ak_model->laporan_harian_nirwana_oto($tgldb, $config['per_page'], $from),
			'kisel' 		=> $this->Ak_model->laporan_harian_kisel($tgldb, $config['per_page'], $from),
			'kisel_selisih' => $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)

		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('all/search');
		$this->load->view('all/laporan_harian', $data);
		$this->load->view('template/footer');
	}

	function laporan_periode()
	{
		if (!$this->uri->segment(3) && !$this->uri->segment(4)) {
			$tgl_mulai = str_replace('/', '-', $this->input->post('tgl_mulai'));
			$tgl_sampai = str_replace('/', '-', $this->input->post('tgl_sampai'));
		} else {
			$tgl_mulai = $this->uri->segment(3);
			$tgl_sampai = $this->uri->segment(4);
		}
		$tgl_mulai_db = str_replace('-', '/', $tgl_mulai);
		$tgl_sampai_db = str_replace('-', '/', $tgl_sampai);
		$total = $this->Ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->Ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('all/search');
		$this->load->view('all/laporan_periode', $data);
		$this->load->view('template/footer');
	}

	// Telkomsel Supplier
	public function telkomsel()
	{

		$total = $this->Ak_model->row_masuk();
		$config['base_url'] 		= base_url() . 'p/telkomsel';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'halaman' 	=> $this->pagination->create_links(),
			'result' 	=> $this->Ak_model->masuk($config['per_page'], $from),
			'ttl' 		=> $this->Ak_model->total_masuk()
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/telkomsel/telkomsel', $data);
		$this->load->view('template/footer');
	}

	public function harian_supplier_telkomsel()
	{
		if (!$this->uri->segment(3)) {
			$cek = $this->input->post('tanggal');
		} else {
			$cek = $this->uri->segment(3);
		}
		$tgl_uri = str_replace('/', '-', $cek);
		$tgldb = str_replace('-', '/', $cek);
		$total = $this->Ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_telkomsel/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'telkomsel' 		=> $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/telkomsel/search');
		$this->load->view('supplier/telkomsel/laporan_harian', $data);
		$this->load->view('template/footer');
	}
	public function periode_supplier_telkomsel()
	{
		if (!$this->uri->segment(3) && !$this->uri->segment(4)) {
			$tgl_mulai = str_replace('/', '-', $this->input->post('tgl_mulai'));
			$tgl_sampai = str_replace('/', '-', $this->input->post('tgl_sampai'));
		} else {
			$tgl_mulai = $this->uri->segment(3);
			$tgl_sampai = $this->uri->segment(4);
		}
		$tgl_mulai_db = str_replace('-', '/', $tgl_mulai);
		$tgl_sampai_db = str_replace('-', '/', $tgl_sampai);
		$total = $this->Ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_telkomsel/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'telkomsel' 		=> $this->Ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/telkomsel/search');
		$this->load->view('supplier/telkomsel/laporan_periode', $data);
		$this->load->view('template/footer');
	}

	// Laporan Nirwana
	public function nirwana()
	{
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/nirwana/search');
		$this->load->view('template/footer');
	}

	public function harian_supplier_nirwana()
	{
		if (!$this->uri->segment(3)) {
			$cek = $this->input->post('tanggal');
		} else {
			$cek = $this->uri->segment(3);
		}
		$tgl_uri = str_replace('/', '-', $cek);
		$tgldb = str_replace('-', '/', $cek);
		$total = $this->Ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_nirwana/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk_nirwana($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar_nirwana($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'nirwana' 		=> $this->Ak_model->laporan_harian_nirwana($tgldb, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/nirwana/search');
		$this->load->view('supplier/nirwana/laporan_harian', $data);
		$this->load->view('template/footer');
	}
	public function periode_supplier_nirwana()
	{
		if (!$this->uri->segment(3) && !$this->uri->segment(4)) {
			$tgl_mulai = str_replace('/', '-', $this->input->post('tgl_mulai'));
			$tgl_sampai = str_replace('/', '-', $this->input->post('tgl_sampai'));
		} else {
			$tgl_mulai = $this->uri->segment(3);
			$tgl_sampai = $this->uri->segment(4);
		}
		$tgl_mulai_db = str_replace('-', '/', $tgl_mulai);
		$tgl_sampai_db = str_replace('-', '/', $tgl_sampai);
		$total = $this->Ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_nirwana/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk_nirwana($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar_nirwana($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'nirwana' 		=> $this->Ak_model->laporan_periode_nirwana($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/nirwana/search');
		$this->load->view('supplier/nirwana/laporan_periode', $data);
		$this->load->view('template/footer');
	}

	// // Nirwana Oto Laporan
	public function nirwana_oto()
	{
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/nirwana_oto/search');
		$this->load->view('template/footer');
	}

	public function harian_supplier_nirwana_oto()
	{
		if (!$this->uri->segment(3)) {
			$cek = $this->input->post('tanggal');
		} else {
			$cek = $this->uri->segment(3);
		}
		$tgl_uri = str_replace('/', '-', $cek);
		$tgldb = str_replace('-', '/', $cek);
		$total = $this->Ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_nirwana_oto/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk_nirwana_oto($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar_nirwana_oto($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'nirwana_oto' 		=> $this->Ak_model->laporan_harian_nirwana_oto($tgldb, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/nirwana_oto/search');
		$this->load->view('supplier/nirwana_oto/laporan_harian', $data);
		$this->load->view('template/footer');
	}
	public function periode_supplier_nirwana_oto()
	{
		if (!$this->uri->segment(3) && !$this->uri->segment(4)) {
			$tgl_mulai = str_replace('/', '-', $this->input->post('tgl_mulai'));
			$tgl_sampai = str_replace('/', '-', $this->input->post('tgl_sampai'));
		} else {
			$tgl_mulai = $this->uri->segment(3);
			$tgl_sampai = $this->uri->segment(4);
		}
		$tgl_mulai_db = str_replace('-', '/', $tgl_mulai);
		$tgl_sampai_db = str_replace('-', '/', $tgl_sampai);
		$total = $this->Ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_nirwana_oto/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk_nirwana_oto($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar_nirwana_oto($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'nirwana_oto' 		=> $this->Ak_model->laporan_periode_nirwana_oto($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/nirwana_oto/search');
		$this->load->view('supplier/nirwana_oto/laporan_periode', $data);
		$this->load->view('template/footer');
	}

	// Laporan kisel
	public function kisel()
	{

		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/kisel/search');
		$this->load->view('template/footer');
	}

	public function harian_supplier_kisel()
	{
		if (!$this->uri->segment(3)) {
			$cek = $this->input->post('tanggal');
		} else {
			$cek = $this->uri->segment(3);
		}
		$tgl_uri = str_replace('/', '-', $cek);
		$tgldb = str_replace('-', '/', $cek);
		$total = $this->Ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_kisel/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk_kisel($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar_kisel($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'kisel' 		=> $this->Ak_model->laporan_harian_kisel($tgldb, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/kisel/search');
		$this->load->view('supplier/kisel/laporan_harian', $data);
		$this->load->view('template/footer');
	}
	public function periode_supplier_kisel()
	{
		if (!$this->uri->segment(3) && !$this->uri->segment(4)) {
			$tgl_mulai = str_replace('/', '-', $this->input->post('tgl_mulai'));
			$tgl_sampai = str_replace('/', '-', $this->input->post('tgl_sampai'));
		} else {
			$tgl_mulai = $this->uri->segment(3);
			$tgl_sampai = $this->uri->segment(4);
		}
		$tgl_mulai_db = str_replace('-', '/', $tgl_mulai);
		$tgl_sampai_db = str_replace('-', '/', $tgl_sampai);
		$total = $this->Ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_kisel/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk_kisel($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar_kisel($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'kisel' 		=> $this->Ak_model->laporan_periode_kisel($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/kisel/search');
		$this->load->view('supplier/kisel/laporan_periode', $data);
		$this->load->view('template/footer');
	}
	// Kisel Selisih Laporan
	public function kisel_selisih()
	{
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/kisel_selisih/search');
		$this->load->view('template/footer');
	}

	public function harian_supplier_kisel_selisih()
	{
		if (!$this->uri->segment(3)) {
			$cek = $this->input->post('tanggal');
		} else {
			$cek = $this->uri->segment(3);
		}
		$tgl_uri = str_replace('/', '-', $cek);
		$tgldb = str_replace('-', '/', $cek);
		$total = $this->Ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_kisel_selisih/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'kisel_selisih' => $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/kisel_selisih/search');
		$this->load->view('supplier/kisel_selisih/laporan_harian', $data);
		$this->load->view('template/footer');
	}
	public function periode_supplier_kisel_selisih()
	{
		if (!$this->uri->segment(3) && !$this->uri->segment(4)) {
			$tgl_mulai = str_replace('/', '-', $this->input->post('tgl_mulai'));
			$tgl_sampai = str_replace('/', '-', $this->input->post('tgl_sampai'));
		} else {
			$tgl_mulai = $this->uri->segment(3);
			$tgl_sampai = $this->uri->segment(4);
		}
		$tgl_mulai_db = str_replace('-', '/', $tgl_mulai);
		$tgl_sampai_db = str_replace('-', '/', $tgl_sampai);
		$total = $this->Ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_kisel_selisih/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'kisel_selisih' 		=> $this->Ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/kisel_selisih/search');
		$this->load->view('supplier/kisel_selisih/laporan_periode', $data);
		$this->load->view('template/footer');
	}
}
