
<?php defined('BASEPATH') or die('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Export_model');
        $this->load->library('pdf');
    }

    public function index()
    {
        $data['data'] = $this->Export_model->excel()->result();
        $this->load->view('export', $data);
    }

    // public function export()
    // {
    //     $telkomsel = $this->Export_model->excel()->result();

    //     $spreadsheet = new Spreadsheet;

    //     $spreadsheet->setActiveSheetIndex(0)
    //         ->setCellValue('A1', 'Nomor')
    //         ->setCellValue('B1', 'Modul_id')
    //         ->setCellValue('C1', 'modul')
    //         ->setCellValue('D1', 'jml_trx')
    //         ->setCellValue('E1', 'spl')
    //         ->setCellValue('F1', 'saldo_awal')
    //         ->setCellValue('G1', 'deposit')
    //         ->setCellValue('H1', 'pemakaian')
    //         ->setCellValue('I1', 'saldo_akhir_cs')
    //         ->setCellValue('J1', 'selisih')
    //         ->setCellValue('K1', 'jenis')
    //         ->setCellValue('L1', 'tanggal');

    //     $kolom = 2;
    //     $nomor = 1;
    //     foreach ($telkomsel as $report) {

    //         $spreadsheet->setActiveSheetIndex(0)
    //             ->setCellValue('A' . $kolom, $nomor)
    //             ->setCellValue('B' . $kolom, $report->modul_id)
    //             ->setCellValue('C' . $kolom, $report->modul)
    //             ->setCellValue('D' . $kolom, $report->jml_trx)
    //             ->setCellValue('E' . $kolom, $report->spl)
    //             ->setCellValue('F' . $kolom, $report->saldo_awal)
    //             ->setCellValue('G' . $kolom, $report->deposit)
    //             ->setCellValue('H' . $kolom, $report->pemakaian)
    //             ->setCellValue('I' . $kolom, $report->saldo_akhir_cs)
    //             ->setCellValue('J' . $kolom, $report->selisih)
    //             ->setCellValue('K' . $kolom, $report->jenis)
    //             ->setCellValue('L' . $kolom, date('j F Y', strtotime($report->tanggal)));


    //         $kolom++;
    //         $nomor++;
    //     }

    //     $writer = new Xlsx($spreadsheet);

    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="Laporan Telkomsel.xls"');
    //     header('Cache-Control: max-age=0');

    //     $writer->save('php://output');
    // }

    //PDF
    public function pdf()
    {

        $tanggal = date('d-m-Y', time());
        $data = $this->Export_model->pdf($tanggal)->result();
        $pdf = new FPDF('l', 'mm', 'A5');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 7, 'LAPORAN SPL - PT. MARKAZ JALAN BERSAMA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(242, 221, 220);
        $pdf->Cell(196, 6, '"ASSET MARKAZ"', 1, 1, 'C', 'color');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(196, 6, $tanggal, 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(217, 151, 149);
        $pdf->Cell(196, 6, 'STATUS PENJUALAN MODUL H2H ALL SERVER', 1, 1, 'C', 'color');
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->SetFillColor(217, 151, 149);
        $pdf->Cell(5, 6, 'NO', 1, 0, 'C', 'color');
        $pdf->Cell(20, 6, 'MODUL', 1, 0, 'C', 'color');
        $pdf->Cell(21, 6, 'Jml. Trx', 1, 0, 'C', 'color');
        $pdf->Cell(21, 6, 'SPL', 1, 0, 'C', 'color');
        $pdf->Cell(22, 6, 'SELISIH TRX', 1, 0, 'C', 'color');
        $pdf->Cell(21, 6, 'Saldo Awal', 1, 0, 'C', 'color');
        $pdf->Cell(21, 6, 'Pn2/Deposit', 1, 0, 'C', 'color');
        $pdf->Cell(21, 6, 'Pemakaian', 1, 0, 'C', 'color');
        $pdf->Cell(21, 6, 'Saldo Akhir CS', 1, 0, 'C', 'color');
        $pdf->Cell(23, 6, 'Selisih Akhir', 1, 1, 'C', 'color');

        //$data = $this->db->get('data')->result();
        //$tanggal = $this->input->post('tanggal');
        //$data['pdf'] = $this->Export_model->pdf($tanggal)->result();
        //$this->load->view('supplier/telkomsel/laporan_harian', $data);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetFillColor(197, 190, 151);
        $pdf->Cell(196, 6, 'TELKOMSEL', 1, 1, 'C', 'COLOR');
        $total = array(10, 20, 30, 40, 50);
        foreach ($data as $row) {
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetFillColor(197, 190, 151);
            $pdf->Cell(5, 6, $row->nomor, 1, 0, 'C', 'color');
            $pdf->Cell(20, 6, $row->modul, 1, 0, 'C');
            $pdf->Cell(21, 6, number_format($row->jml_trx), 1, 0, 'C');
            $pdf->Cell(21, 6, number_format($row->spl), 1, 0, 'C');
            $pdf->Cell(22, 6, number_format($row->jml_trx - $row->spl), 1, 0, 'C');
            $pdf->Cell(21, 6, number_format($row->saldo_awal), 1, 0, 'C');
            $pdf->Cell(21, 6, number_format($row->deposit), 1, 0, 'C');
            $pdf->Cell(21, 6, number_format($row->pemakaian), 1, 0, 'C');
            $pdf->Cell(21, 6, number_format($row->saldo_akhir_cs), 1, 0, 'C');
            $pdf->Cell(23, 6, number_format($row->saldo_akhir_cs + $row->pemakaian - $row->deposit - $row->saldo_awal), 1, 1, 'C');
        }



        //mlink
        $pdf->Cell(190, 7, '', 0, 1, 'C');
        $tanggal = date('d-m-Y', time());
        $data = $this->Export_model->pdf_mlink()->result();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 7, '', 0, 1, 'C');
        //  $pdf->Cell(190, 7, 'LAPORAN SPL - PT. MARKAZ JALAN BERSAMA', 0, 1, 'C');
        $pdf->SetFillColor(242, 221, 220);
        $pdf->Cell(196, 6, '"ASSET MARKAZ"', 1, 1, 'C', 'color');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(196, 6, $tanggal, 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(217, 151, 149);
        $pdf->Cell(196, 6, 'STATUS PENJUALAN MODUL H2H ALL SERVER', 1, 1, 'C', 'color');
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->SetFillColor(217, 151, 149);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C', 'color');
        $pdf->Cell(30, 6, 'MODUL', 1, 0, 'C', 'color');
        $pdf->Cell(22, 6, 'Jml. Trx', 1, 0, 'C', 'color');
        $pdf->Cell(22, 6, 'SPL', 1, 0, 'C', 'color');
        $pdf->Cell(22, 6, 'SELISIH TRX', 1, 0, 'C', 'color');
        $pdf->Cell(24, 6, 'Saldo Awal', 1, 0, 'C', 'color');
        $pdf->Cell(22, 6, 'Pn2/Deposit', 1, 0, 'C', 'color');
        $pdf->Cell(22, 6, 'Pemakaian', 1, 0, 'C', 'color');
        $pdf->Cell(22, 6, 'Saldo Akhir CS', 1, 1, 'C', 'color');

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetFillColor(197, 190, 151);
        $pdf->Cell(196, 6, 'MLINK', 1, 1, 'C', 'color');

        foreach ($data as $row) {
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetFillColor(197, 190, 151);
            $pdf->Cell(10, 6, $row->nomor, 1, 0, 'C', 'color');
            $pdf->Cell(30, 6, $row->modul, 1, 0, 'C');
            $pdf->Cell(22, 6, number_format($row->jml_trx), 1, 0);
            $pdf->Cell(22, 6, number_format($row->spl), 1, 0);
            $pdf->Cell(24, 6, number_format($row->saldo_awal), 1, 0);
            $pdf->Cell(22, 6, number_format($row->deposit), 1, 0);
            $pdf->Cell(22, 6, number_format($row->pemakaian), 1, 0);
            $pdf->Cell(22, 6, number_format($row->saldo_akhir_cs), 1, 0);
            $pdf->Cell(22, 6, number_format($row->selisih), 1, 1);
        }
        //KISEL
        $tanggal = date('d-m-Y', time());
        $data = $this->Export_model->pdf_kisel_stokawal()->result();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 7, '', 0, 1, 'C');
        //  $pdf->Cell(190, 7, 'LAPORAN SPL - PT. MARKAZ JALAN BERSAMA', 0, 1, 'C');

        $pdf->SetFillColor(242, 221, 220);
        $pdf->Cell(196, 6, '"ASSET MARKAZ"', 1, 1, 'C', 'color');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(196, 6, $tanggal, 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(217, 151, 149);
        $pdf->Cell(196, 6, 'STATUS PENJUALAN MODUL H2H ALL SERVER', 1, 1, 'C', 'color');
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetFillColor(197, 190, 151);
        $pdf->Cell(196, 6, 'KISEL', 1, 1, 'C', 'color');
        $pdf->SetFillColor(217, 151, 149);
        $pdf->Cell(25, 6, '', 1, 0, 'C', 'color');
        $pdf->Cell(15, 6, '10k', 1, 0, 'C', 'color');
        $pdf->Cell(15, 6, '15k', 1, 0, 'C', 'color');
        $pdf->Cell(15, 6, '25k', 1, 0, 'C', 'color');
        $pdf->Cell(15, 6, '30k', 1, 0, 'C', 'color');
        $pdf->Cell(15, 6, '40k', 1, 0, 'C', 'color');
        $pdf->SetFillColor(242, 221, 220);
        $pdf->SetTextColor(156, 0, 6);
        $pdf->Cell(15, 6, '75k', 1, 0, 'C', 'color');
        $pdf->SetFillColor(217, 151, 149);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(15, 6, '100k', 1, 0, 'C', 'color');
        $pdf->Cell(15, 6, '105k', 1, 0, 'C', 'color');
        $pdf->Cell(15, 6, '200k', 1, 0, 'C', 'color');
        $pdf->Cell(14, 6, '300k', 1, 0, 'C', 'color');
        $pdf->Cell(11, 6, '500k', 1, 0, 'C', 'color');
        $pdf->Cell(11, 6, '1000k', 1, 1, 'C', 'color');
        $pdf->SetFillColor(197, 190, 151);
        $pdf->Cell(25, 6, 'STOK AWAL', 1, 0, 'C', 'color');
        foreach ($data as $row) {
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(15, 6, number_format($row->sepuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->limabelas), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->dualima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->tigapuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->empatpuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->tujuhlima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->seratus), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->seratuslima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->duaratus), 1, 0, 'C');
            $pdf->Cell(14, 6, number_format($row->tigaratus), 1, 0, 'C');
            $pdf->Cell(11, 6, number_format($row->limaratus), 1, 0, 'C');
            $pdf->Cell(11, 6, number_format($row->satujuta), 1, 1, 'C');
        }

        $data = $this->Export_model->pdf_kisel_deposit()->result();
        $pdf->SetFillColor(197, 190, 151);
        $pdf->Cell(25, 6, 'DEPOSIT', 1, 0, 'C', 'color');
        foreach ($data as $row) {
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(15, 6, number_format($row->sepuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->limabelas), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->dualima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->tigapuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->empatpuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->tujuhlima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->seratus), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->seratuslima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->duaratus), 1, 0, 'C');
            $pdf->Cell(14, 6, number_format($row->tigaratus), 1, 0, 'C');
            $pdf->Cell(11, 6, number_format($row->limaratus), 1, 0, 'C');
            $pdf->Cell(11, 6, number_format($row->satujuta), 1, 1, 'C');
        }
        $data = $this->Export_model->pdf_kisel_pemakaian()->result();
        $pdf->SetFillColor(197, 190, 151);
        $pdf->Cell(25, 6, 'PEMAKAIAN', 1, 0, 'C', 'color');
        foreach ($data as $row) {
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(15, 6, number_format($row->sepuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->limabelas), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->dualima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->tigapuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->empatpuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->tujuhlima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->seratus), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->seratuslima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->duaratus), 1, 0, 'C');
            $pdf->Cell(14, 6, number_format($row->tigaratus), 1, 0, 'C');
            $pdf->Cell(11, 6, number_format($row->limaratus), 1, 0, 'C');
            $pdf->Cell(11, 6, number_format($row->satujuta), 1, 1, 'C');
        }
        $data = $this->Export_model->pdf_kisel_pemakaian()->result();
        $pdf->SetFillColor(197, 190, 151);
        $pdf->Cell(25, 6, 'STOK AKHIR', 1, 0, 'C', 'color');
        foreach ($data as $row) {
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(15, 6, number_format($row->sepuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->limabelas), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->dualima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->tigapuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->empatpuluh), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->tujuhlima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->seratus), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->seratuslima), 1, 0, 'C');
            $pdf->Cell(15, 6, number_format($row->duaratus), 1, 0, 'C');
            $pdf->Cell(14, 6, number_format($row->tigaratus), 1, 0, 'C');
            $pdf->Cell(11, 6, number_format($row->limaratus), 1, 0, 'C');
            $pdf->Cell(11, 6, number_format($row->satujuta), 1, 1, 'C');
        }

        $pdf->SetFont('Arial', '', 8);




        $pdf->Output();

        $this->load->view('all/laporan_harian', $data);
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
        $total = $this->Export_model->row_harian($tgldb);
        $config['base_url']         = base_url() . 'Export/laporan_harian/' . $tgl_uri;
        $config['total_rows']         = $total;
        $config['per_page']         = 10000000000000000000000000;
        $this->pagination->initialize($config);
        $from = $this->uri->segment(4);
        $data = array(
            'tanggal'         => $tgldb,
            'ttl_masuk'        => $this->Export_model->total_harian_masuk($tgldb),
            'ttl_keluar'    => $this->Export_model->total_harian_keluar($tgldb),
            'halaman'         => $this->pagination->create_links(),
            'result'         => $this->Export_model->laporan_harian($tgldb, $config['per_page'], $from)
        );
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('all/search');
        $this->load->view('all/laporan_harian', $data);
        $this->load->view('template/footer');
    }
}
