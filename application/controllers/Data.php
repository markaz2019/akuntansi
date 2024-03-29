<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
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
			'result' 		=> $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)
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
			'result' 		=> $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)
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
			'result' 		=> $this->Ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/telkomsel/search');
		$this->load->view('supplier/telkomsel/laporan_periode', $data);
		$this->load->view('template/footer');
	}

	// Nirwana Laporan
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
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)
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
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->Ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
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
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)
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
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->Ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/nirwana_oto/search');
		$this->load->view('supplier/nirwana_oto/laporan_periode', $data);
		$this->load->view('template/footer');
	}

	// Kisel Laporan
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
			'ttl_masuk'		=> $this->Ak_model->total_harian_masuk($tgldb),
			'ttl_keluar'	=> $this->Ak_model->total_harian_keluar($tgldb),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)
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
			'ttl_masuk'		=> $this->Ak_model->total_periode_masuk($tgl_mulai, $tgl_sampai),
			'ttl_keluar'	=> $this->Ak_model->total_periode_keluar($tgl_mulai, $tgl_sampai),
			'halaman' 		=> $this->pagination->create_links(),
			'result' 		=> $this->Ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
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
			'result' 		=> $this->Ak_model->laporan_harian($tgldb, $config['per_page'], $from)
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
			'result' 		=> $this->Ak_model->laporan_periode($tgl_mulai_db, $tgl_sampai_db, $config['per_page'], $from)
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('supplier/kisel_selisih/search');
		$this->load->view('supplier/kisel_selisih/laporan_periode', $data);
		$this->load->view('template/footer');
	}

	function pemasukan()
	{

		$result = $this->Ak_model->nomor();
		if (empty($result[0]['nomor'])) {
			$no = date('Ymd') . "000001";
		} else {
			$no = $result[0]['nomor'] + 1;
		}
		$data['nomor'] = $no;
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('pemasukan', $data);
		$this->load->view('template/footer');
	}

	function tambah_pemasukan()
	{

		$data = array(
			'nomor'			=> $this->input->post('nomor'),
			'tanggal' 		=> $this->input->post('tanggal'),
			'modul'			=> $this->input->post('modul'),
			'jml_trx' 		=> $this->input->post('jml_trx'),
			'saldo_awal' 	=> $this->input->post('saldo_awal'),
			'deposit' 		=> $this->input->post('deposit'),
			'pemakaian'		=> $this->input->post('pemakaian'),
			'saldo_akhir'	=> $this->input->post('saldo_akhir'),
			'saldo_akhir_cs' => $this->input->post('saldo_akhir_cs'),
			'selisih' 		=> $this->input->post('selisih'),
			'jenis' 		=> 'masuk',
		);
		$input = $this->Ak_model->tambah_pemasukan($data);
		if ($input) {
			$this->session->set_flashdata('message', 'Data pemasukkan berhasil ditambahkan');
			redirect(base_url('p/masuk'));
		} else {
			$this->session->set_flashdata('message', 'Data pemasukan gagal ditambahkan');
			redirect(base_url('p/tambah_pemasukan'));
		}
	}

	function ubah_pemasukan($nomor)
	{

		$result = $this->Ak_model->ambil_data($nomor);
		$data = array(
			'nomor'			=> $result[0]['nomor'],
			'tanggal'			=> $result[0]['tanggal'],
			'modul'			=> $result[0]['modul'],
			'jml_trx'		=> $result[0]['jml_trx'],
			'saldo_awal'	=> $result[0]['saldo_awal'],
			'deposit'		=> $result[0]['deposit'],
			'pemakaian'		=> $result[0]['pemakaian'],
			'saldo_akhir'	=> $result[0]['saldo_akhir'],
			'saldo_akhir_cs' => $result[0]['saldo_akhir_cs'],
			'selisih'		=> $result[0]['selisih'],
			'jenis'			=> $result[0]['jenis'],

		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('ubah_pemasukan', $data);
		$this->load->view('template/footer');
	}

	function update_pemasukan()
	{

		$data = array(
			'nomor'			=> $this->input->post('nomor'),
			'tanggal'	=> $this->input->post('tanggal'),
			'modul'			=> $this->input->post('modul'),
			'jml_trx' 		=> $this->input->post('jml_trx'),
			'saldo_awal' 	=> $this->input->post('saldo_awal'),
			'deposit' 		=> $this->input->post('deposit'),
			'pemakaian'		=> $this->input->post('pemakaian'),
			'saldo_akhir'	=> $this->input->post('saldo_akhir'),
			'saldo_akhir_cs' => $this->input->post('saldo_akhir_cs'),
			'selisih' 		=> $this->input->post('selisih'),
			'jenis' 		=> 'masuk',
		);
		$input = $this->Ak_model->ubah($this->input->post('nomor'), $data);
		if ($input) {
			$this->session->set_flashdata('message', 'Data pemasukkan berhasil diubah');
			redirect(base_url('p/masuk'));
		} else {
			$this->session->set_flashdata('message', 'Data pemasukan gagal diubah');
			redirect(base_url('p/ubah_pemasukan/' . $this->input->post('nomor')));
		}
	}

	function hapus_pemasukan($nomor)
	{

		$hapus = $this->Ak_model->hapus($nomor);
		if ($hapus) {
			$this->session->set_flashdata('message', 'Data barhasil dihapus');
			redirect(base_url('p/masuk'));
		} else {
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			redirect(base_url('p/masuk'));
		}
	}

	function keluar()
	{

		$total = $this->Ak_model->row_keluar();
		$config['base_url'] 		= base_url() . 'p/keluar';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 5;
		$this->pagination->initialize($config);
		$from = $this->uri->segment(3);
		$data = array(
			'halaman' 	=> $this->pagination->create_links(),
			'result' 	=> $this->Ak_model->keluar($config['per_page'], $from),
			'ttl' 		=> $this->Ak_model->total_keluar()
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('keluar', $data);
		$this->load->view('template/footer');
	}

	function pengeluaran()
	{

		$result = $this->Ak_model->nomor();
		if (empty($result[0]['nomor'])) {
			$no = date('Ymd') . "000001";
		} else {
			$no = $result[0]['nomor'] + 1;
		}
		$data['nomor'] = $no;
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('pengeluaran', $data);
		$this->load->view('template/footer');
	}

	function tambah_pengeluaran()
	{

		$data = array(
			'nomor'			=> $this->input->post('nomor'),
			'keterangan'	=> $this->input->post('keterangan'),
			'tanggal' 		=> $this->input->post('tanggal'),
			'jumlah' 		=> $this->input->post('jumlah'),
			'jenis' 		=> 'keluar'
		);
		$input = $this->Ak_model->tambah_pengeluaran($data);
		if ($input) {
			$this->session->set_flashdata('message', 'Data pengeluaran berhasil ditambahkan');
			redirect(base_url('p/keluar'));
		} else {
			$this->session->set_flashdata('message', 'Data pengeluaran gagal ditambahkan');
			redirect(base_url('p/tambah_pengeluaran'));
		}
	}

	function ubah_pengeluaran($nomor)
	{

		$result = $this->Ak_model->ambil_data($nomor);
		$data = array(
			'nomor'			=> $result[0]['nomor'],
			'keterangan'	=> $result[0]['keterangan'],
			'tanggal'		=> $result[0]['tanggal'],
			'jumlah'		=> $result[0]['jumlah']
		);
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('ubah_pengeluaran', $data);
		$this->load->view('template/footer');
	}

	function update_pengeluaran()
	{

		$data = array(
			'nomor'			=> $this->input->post('nomor'),
			'keterangan'	=> $this->input->post('keterangan'),
			'tanggal' 		=> $this->input->post('tanggal'),
			'jumlah' 		=> $this->input->post('jumlah'),
			'jenis' 		=> 'keluar'
		);
		$input = $this->Ak_model->ubah($this->input->post('nomor'), $data);
		if ($input) {
			$this->session->set_flashdata('message', 'Data pengeluaran berhasil diubah');
			redirect(base_url('p/keluar'));
		} else {
			$this->session->set_flashdata('message', 'Data pengeluaran gagal diubah');
			redirect(base_url('p/ubah_pengeluaran/' . $this->input->post('nomor')));
		}
	}

	function hapus_pengeluaran($nomor)
	{

		$hapus = $this->Ak_model->hapus($nomor);
		if ($hapus) {
			$this->session->set_flashdata('message', 'Data barhasil dihapus');
			redirect(base_url('p/keluar'));
		} else {
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			redirect(base_url('p/keluar'));
		}
	}


	function cari()
	{
		$key = $this->input->get('s');
		if (!empty($key)) {
			$page = $this->input->get('per_page');
			$cari = array(
				'nomor' => $key,
				'tanggal' => $key,
				'jenis' => $key,
			);
			$batas = 5;
			if (!$page) {
				$offset = 0;
			} else {
				$offset = $page;
			}
			$this->load->model('Ak_model');
			$total = $this->Ak_model->row_cari($cari);
			$config['page_query_string'] = TRUE;
			$config['base_url'] = base_url() . 'p/cari?s=' . $key;
			$config['total_rows'] = $total;
			$config['per_page'] = $batas;
			$config['uri_segment'] = $page;
			$config['full_tag_open']    = '<div><ul class="pagination">';
			$config['full_tag_close']   = '</ul></div>';
			$config['first_link']       = '<li class="page-item page-link">Awal</li>';
			$config['last_link']        = '<li class="page-item page-link">Akhir</li>';
			$config['prev_link']        = '&laquo';
			$config['prev_tag_open']    = '<li class="page-item page-link">';
			$config['prev_tag_close']   = '</li>';
			$config['next_link']        = '&raquo';
			$config['next_tag_open']    = '<li class="page-item page-link">';
			$config['next_tag_close']   = '</li>';
			$config['cur_tag_open']     = '<li class="page-item page-link">';
			$config['cur_tag_close']    = '</li>';
			$config['num_tag_open']     = '<li class="page-item page-link">';
			$config['num_tag_close']    = '</li>';
			$this->pagination->initialize($config);
			$data['cari'] = $key;
			$data['halaman'] = $this->pagination->create_links();
			$data['result'] = $this->Ak_model->cari($batas, $offset, $cari);
			$this->load->view('template/header');
			$this->load->view('template/navbar');
			$this->load->view('cari', $data);
			$this->load->view('template/footer');
		}



		function bersihkan()
		{
			$exec = $this->Ak_model->bersihkan();
			if ($exec) {
				$this->session->set_flashdata('message', 'Semua data berhasil dihapus');
				redirect(base_url('p/beranda'));
			} else {
				$this->session->set_flashdata('message', 'Semua data gagal dihapus');
				redirect(base_url('p/bersihkan'));
			}
		}
	}
}
