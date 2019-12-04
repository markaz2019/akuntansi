
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

    public function export()
    {
        $data = $this->Export_model->excel()->result();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomor')
            ->setCellValue('B1', 'Modul_id')
            ->setCellValue('C1', 'modul')
            ->setCellValue('D1', 'jml_trx')
            ->setCellValue('E1', 'spl')
            ->setCellValue('F1', 'saldo_awal')
            ->setCellValue('G1', 'deposit')
            ->setCellValue('H1', 'pemakaian')
            ->setCellValue('I1', 'saldo_akhir_cs')
            ->setCellValue('J1', 'selisih')
            ->setCellValue('K1', 'jenis')
            ->setCellValue('L1', 'tanggal');

        $kolom = 2;
        $nomor = 1;
        foreach ($data as $report) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $report->modul_id)
                ->setCellValue('C' . $kolom, $report->modul)
                ->setCellValue('D' . $kolom, $report->jml_trx)
                ->setCellValue('E' . $kolom, $report->spl)
                ->setCellValue('F' . $kolom, $report->saldo_awal)
                ->setCellValue('G' . $kolom, $report->deposit)
                ->setCellValue('H' . $kolom, $report->pemakaian)
                ->setCellValue('I' . $kolom, $report->saldo_akhir_cs)
                ->setCellValue('J' . $kolom, $report->selisih)
                ->setCellValue('K' . $kolom, $report->jenis)
                ->setCellValue('L' . $kolom, date('j F Y', strtotime($report->tanggal)));


            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan Telkomsel.xls"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    //PDF
    public function pdf()
    {
        $tanggal = date('d-m-Y h:i:s A', time());
        //$tanggal = $this->Export_model->pdf()->result();
        $pdf = new FPDF('l', 'mm', 'A5');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 7, 'LAPORAN SPL - PT. MARKAZ JALAN BERSAMA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(67, 187, 70);H    
        $pdf->Cell(196, 6, '"ASSET MARKAZ"', 1, 1, 'C', 'green');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(196, 6, $tanggal, 1, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(67, 187, 70);
        $pdf->Cell(196, 6, 'STATUS PENJUALAN MODUL H2H ALL SERVER', 1, 1, 'C', 'green');
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->Cell(5, 6, 'NO', 1, 0);
        $pdf->Cell(18, 6, 'MODUL', 1, 0);
        $pdf->Cell(20, 6, 'JUMLAH TRX', 1, 0);
        $pdf->Cell(13, 6, 'SPL', 1, 0);
        $pdf->Cell(20, 6, 'SALDO AWAL', 1, 0);
        $pdf->Cell(20, 6, 'DEPOSIT', 1, 0);
        $pdf->Cell(20, 6, 'PEMAKAIAN', 1, 0);
        $pdf->Cell(20, 6, 'SALDO AKHIR CS', 1, 0);
        $pdf->Cell(20, 6, 'SELISIH', 1, 0);
        $pdf->Cell(20, 6, 'JENIS', 1, 0);
        $pdf->Cell(20, 6, 'TANGGAL', 1, 1);
        $pdf->SetFont('Arial', '', 8);
        $data = $this->db->get('data')->result();
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetFillColor(67, 187, 70);
        $pdf->Cell(196, 6, 'TELKOMSEL', 1, 1, 'C', 'green');

        foreach ($data as $row) {
            $pdf->Cell(5, 6, $row->nomor, 1, 0);

            $pdf->Cell(18, 6, $row->modul, 1, 0);
            $pdf->Cell(20, 6, number_format($row->jml_trx), 1, 0);
            $pdf->Cell(13, 6, number_format($row->spl), 1, 0);
            $pdf->Cell(20, 6, number_format($row->saldo_awal), 1, 0);
            $pdf->Cell(20, 6, number_format($row->deposit), 1, 0);
            $pdf->Cell(20, 6, number_format($row->pemakaian), 1, 0);
            $pdf->Cell(20, 6, number_format($row->saldo_akhir_cs), 1, 0);
            $pdf->Cell(20, 6, number_format($row->selisih), 1, 0);
            $pdf->Cell(20, 6, $row->jenis, 1, 0);
            $pdf->Cell(20, 6, $row->tanggal, 1, 1);
        }


        foreach ($data as $row) {

            $pdf->Cell(23, 6, 'TOTAL', 1, 0);
            $pdf->Cell(20, 6, $row->jml_trx, 1, 0 * 5);
            $pdf->Cell(13, 6, $row->spl, 1, 0 * 5);

            $pdf->Output();

            $this->load->view('supplier/telkomsel/laporan_harian');
        }
    }
}
