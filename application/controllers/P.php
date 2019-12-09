<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class P extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ak_model');
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
		$total = $this->ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->ak_model->laporan_harian($tgldb, $config['per_page'], $from),
			'nirwana' 		=> $this->ak_model->laporan_harian_nirwana($tgldb, $config['per_page'], $from),
			'nirwana_oto' 	=> $this->ak_model->laporan_harian_nirwana_oto($tgldb, $config['per_page'], $from),
			'kisel' 		=> $this->ak_model->laporan_harian_kisel($tgldb, $config['per_page'], $from),
			'kisel_selisih' => $this->ak_model->laporan_harian_kisel_selisih($tgldb, $config['per_page'], $from)

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
		$total = $this->ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from),
			'nirwana' 		=> $this->ak_model->laporan_periode_nirwana($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from),
			'nirwana_oto' 	=> $this->ak_model->laporan_periode_nirwana_oto($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from),
			'kisel' 		=> $this->ak_model->laporan_periode_kisel($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from),
			'kisel_selisih' => $this->ak_model->laporan_periode_kisel_selisih($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
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
		$total = $this->ak_model->row_masuk();
		$config['base_url'] 		= base_url() . 'p/telkomsel';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'halaman' 	=> $this->pagination->create_links(),
			'result' 	=> $this->ak_model->masuk($config['per_page'], $from),
			'ttl' 		=> $this->ak_model->total_masuk()
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
		$total = $this->ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_telkomsel/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'telkomsel' 	=> $this->ak_model->laporan_harian($tgldb, $config['per_page'], $from)
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
		$total = $this->ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_telkomsel/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'telkomsel' 		=> $this->ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
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
		$total = $this->ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_nirwana/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->ak_model->total_harian_masuk_nirwana($tgldb),
			'ttl_keluar'	=> $this->ak_model->total_harian_keluar_nirwana($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'nirwana' 		=> $this->ak_model->laporan_harian_nirwana($tgldb, $config['per_page'], $from)
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
		$total = $this->ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_nirwana/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->ak_model->total_periode_masuk_nirwana($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->ak_model->total_periode_keluar_nirwana($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'nirwana' 		=> $this->ak_model->laporan_periode_nirwana($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
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
		$total = $this->ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_nirwana_oto/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->ak_model->total_harian_masuk_nirwana_oto($tgldb),
			'ttl_keluar'	=> $this->ak_model->total_harian_keluar_nirwana_oto($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'nirwana_oto' 	=> $this->ak_model->laporan_harian_nirwana_oto($tgldb, $config['per_page'], $from)
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
		$total = $this->ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_nirwana_oto/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->ak_model->total_periode_masuk_nirwana_oto($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->ak_model->total_periode_keluar_nirwana_oto($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'nirwana_oto' 	=> $this->ak_model->laporan_periode_nirwana_oto($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
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
		$this->load->view('supplier/kisel/kisel');
		$this->load->view('supplier/kisel/deposit');
		$this->load->view('supplier/kisel/stockakhir');
		$this->load->view('supplier/kisel/pemakaian');
		$this->load->view('supplier/kisel_selisih/hitungan');
		$this->load->view('supplier/kisel_selisih/ss_css');
		// $this->load->view('supplier/kisel_selisih/kisel_selisih');
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
		$total = $this->ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_kisel/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->ak_model->total_harian_masuk_kisel($tgldb),
			'ttl_keluar'	=> $this->ak_model->total_harian_keluar_kisel($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'kisel' 		=> $this->ak_model->laporan_harian_kisel($tgldb, $config['per_page'], $from)
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
		$total = $this->ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_kisel/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->ak_model->total_periode_masuk_kisel($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->ak_model->total_periode_keluar_kisel($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'kisel' 		=> $this->ak_model->laporan_periode_kisel($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
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
		$total = $this->ak_model->row_harian($tgldb);
		$config['base_url'] 		= base_url() . 'p/harian_supplier_kisel_selisih/laporan_harian/' . $tgl_uri;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(4);
		$data = array(
			'tanggal' 		=> $tgldb,
			'ttl_masuk'		=> $this->ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'kisel_selisih' => $this->ak_model->laporan_harian_kisel_selisih($tgldb, $config['per_page'], $from)
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
		$total = $this->ak_model->row_periode($tgl_mulai_db, $tgl_sampai_db);
		$config['base_url'] 		= base_url() . 'p/periode_supplier_kisel_selisih/laporan_periode/' . $tgl_mulai . '/' . $tgl_sampai;
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 10000000000000000000000000;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(5);
		$data = array(
			'tgl_mulai' 	=> $tgl_mulai_db,
			'tgl_sampai'	=> $tgl_sampai_db,
			'ttl_masuk'		=> $this->ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'kisel_selisih' 		=> $this->ak_model->laporan_periode_kisel_selisih($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/kisel_selisih/search');
		$this->load->view('supplier/kisel_selisih/laporan_periode', $data);
		$this->load->view('template/footer');
	}

	public function tambah_kisel()
	{
		// $kisel_stockawal = array(
		// 	'id_stockawal'	=> $this->input->post('id_stockawal'),
		// 	'sepuluh'		=> $this->input->post('stockawal10'),
		// 	'limabelas'		=> $this->input->post('stockawal15'),
		// 	'dualima'		=> $this->input->post('stockawal25'),
		// 	'tigapuluh'		=> $this->input->post('stockawal30'),
		// 	'empatpuluh'	=> $this->input->post('stockawal40'),
		// 	'limapuluh'		=> $this->input->post('stockawal50'),
		// 	'tujuhlima'		=> $this->input->post('stockawal75'),
		// 	'seratus'		=> $this->input->post('stockawal100'),
		// 	'seratuslima'	=> $this->input->post('stockawal105'),
		// 	'duaratus'		=> $this->input->post('stockawal200'),
		// 	'tigaratus'		=> $this->input->post('stockawal300'),
		// 	'limaratus'		=> $this->input->post('stockawal500'),
		// 	'satujuta'		=> $this->input->post('stockawal1000'),
		// 	'tanggal'		=> $this->input->post('tanggal'),
		// );
		// $this->db->insert('kisel_stockawal', $kisel_stockawal);
		// $id_stokawal = $this->db->insert_id();

		$kisel_pemakaian = array(
			'id_pemakaian'	=> $this->input->post('id_pemakaian'),
			'sepuluh'		=> $this->input->post('sepuluh'),
			'limabelas'		=> $this->input->post('lima_belas'),
			'dualima'		=> $this->input->post('dua_lima'),
			'tigapuluh'		=> $this->input->post('tiga_puluh'),
			'empatpuluh'	=> $this->input->post('empat_puluh'),
			'limapuluh'		=> $this->input->post('lima_puluh'),
			'tujuhlima'		=> $this->input->post('tujuh_lima'),
			'seratus'		=> $this->input->post('seratus'),
			'seratuslima'	=> $this->input->post('seratus_lima'),
			'duaratus'		=> $this->input->post('dua_ratus'),
			'tigaratus'		=> $this->input->post('tiga_ratus'),
			'limaratus'		=> $this->input->post('lima_ratus'),
			'satujuta'		=> $this->input->post('satu_juta'),
			// 'tanggal'		=> $this->input->post('tanggal'),

		);

		$kisel_deposit = array(
			'id_deposit'	=> $this->input->post('id_deposit'),
			'sepuluh'		=> $this->input->post('d_sepuluh'),
			'limabelas'		=> $this->input->post('d_lima_belas'),
			'dualima'		=> $this->input->post('d_dua_lima'),
			'tigapuluh'		=> $this->input->post('d_tiga_puluh'),
			'empatpuluh'	=> $this->input->post('d_empat_puluh'),
			'limapuluh'		=> $this->input->post('d_lima_puluh'),
			'tujuhlima'		=> $this->input->post('d_tujuh_lima'),
			'seratus'		=> $this->input->post('d_seratus'),
			'seratuslima'	=> $this->input->post('d_seratus_lima'),
			'duaratus'		=> $this->input->post('d_dua_ratus'),
			'tigaratus'		=> $this->input->post('d_tiga_ratus'),
			'limaratus'		=> $this->input->post('d_lima_ratus'),
			'satujuta'		=> $this->input->post('d_satu_juta'),
			// 'tanggal'		=> $this->input->post('tanggal'),
		);

		$kisel_stokakhir = array(
			'id_stokakhir'	=> $this->input->post('id_stokakhir'),
			'sepuluh'		=> $this->input->post('akhir_1'),
			'limabelas'		=> $this->input->post('akhir_2'),
			'dualima'		=> $this->input->post('akhir_3'),
			'tigapuluh'		=> $this->input->post('akhir_4'),
			'empatpuluh'	=> $this->input->post('akhir_5'),
			'limapuluh'		=> $this->input->post('akhir_6'),
			'tujuhlima'		=> $this->input->post('akhir_7'),
			'seratus'		=> $this->input->post('akhir_8'),
			'seratuslima'	=> $this->input->post('akhir_9'),
			'duaratus'		=> $this->input->post('akhir_10'),
			'tigaratus'		=> $this->input->post('akhir_11'),
			'limaratus'		=> $this->input->post('akhir_12'),
			'satujuta'		=> $this->input->post('akhir_13'),
			// 'tanggal'		=> $this->input->post('tanggal'),
		);


		$kisel_cs = array(
			'id_cs'	=> $this->input->post('id_cs'),
			'sepuluh'		=> $this->input->post('s_sepuluh'),
			'limabelas'		=> $this->input->post('s_lima_belas'),
			'dualima'		=> $this->input->post('s_dua_lima'),
			'tigapuluh'		=> $this->input->post('s_tiga_puluh'),
			'empatpuluh'	=> $this->input->post('s_empat_puluh'),
			'limapuluh'		=> $this->input->post('s_lima_puluh'),
			'tujuhlima'		=> $this->input->post('s_tujuh_lima'),
			'seratus'		=> $this->input->post('s_seratus'),
			'seratuslima'	=> $this->input->post('s_seratus_lima'),
			'duaratus'		=> $this->input->post('s_dua_ratus'),
			'tigaratus'		=> $this->input->post('s_tiga_ratus'),
			'limaratus'		=> $this->input->post('s_lima_ratus'),
			'satujuta'		=> $this->input->post('s_satu_juta'),
			// 'tanggal'		=> $this->input->post('tanggal'),
		);


		$kisel_hitungan = array(
			'id_hitungan'	=> $this->input->post('id_hitungan'),
			'sepuluh'		=> $this->input->post('hitungan1'),
			'limabelas'		=> $this->input->post('hitungan2'),
			'dualima'		=> $this->input->post('hitungan3'),
			'tigapuluh'		=> $this->input->post('hitungan4'),
			'empatpuluh'	=> $this->input->post('hitungan5'),
			'limapuluh'		=> $this->input->post('hitungan6'),
			'tujuhlima'		=> $this->input->post('hitungan7'),
			'seratus'		=> $this->input->post('hitungan8'),
			'seratuslima'	=> $this->input->post('hitungan9'),
			'duaratus'		=> $this->input->post('hitungan10'),
			'tigaratus'		=> $this->input->post('hitungan11'),
			'limaratus'		=> $this->input->post('hitungan12'),
			'satujuta'		=> $this->input->post('hitungan13'),
			// 'tanggal'		=> $this->input->post('tanggal'),
		);


		$kisel_selisih = array(
			'id_selisih'	=> $this->input->post('id_selisih'),
			'sepuluh'		=> $this->input->post('selisih_1'),
			'limabelas'		=> $this->input->post('selisih_2'),
			'dualima'		=> $this->input->post('selisih_3'),
			'tigapuluh'		=> $this->input->post('selisih_4'),
			'empatpuluh'	=> $this->input->post('selisih_5'),
			'limapuluh'		=> $this->input->post('selisih_6'),
			'tujuhlima'		=> $this->input->post('selisih_7'),
			'seratus'		=> $this->input->post('selisih_8'),
			'seratuslima'	=> $this->input->post('selisih_9'),
			'duaratus'		=> $this->input->post('selisih_10'),
			'tigaratus'		=> $this->input->post('selisih_11'),
			'limaratus'		=> $this->input->post('selisih_12'),
			'satujuta'		=> $this->input->post('selisih_13'),
			// 'tanggal'		=> $this->input->post('tanggal'),
		);

		$hasil = $this->ak_model->tambah($kisel_stokakhir, $kisel_deposit, $kisel_pemakaian, $kisel_cs, $kisel_hitungan, $kisel_selisih);
		if ($hasil == null) {
			$this->session->set_flashdata(
				'msg',
				'<div class="alert alert-info alert-with-icon">
					<button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
						<i class="tim-icons icon-simple-remove"></i>
					</button>
					<span data-notify="icon" class="tim-icons icon-check-2"></span>
					<span><b> success - </b> data berhasil disimpan</span>
				</div>'
			);
			$this->load->view('supplier/kisel/kisel');
		} else {
			$this->session->set_flashdata(
				'msg',
				'<div class="alert alert-info alert-with-icon">
					<button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
						<i class="tim-icons icon-simple-remove"></i>
					</button>
					<span data-notify="icon" class="tim-icons icon-check-2"></span>
					<span><b> success - </b> data berhasil disimpan</span>
				</div>'
			);
		}
		redirect('p/kisel');
	}
}
