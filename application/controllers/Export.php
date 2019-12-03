<?php defined('BASEPATH') or die('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Export_model');
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
}
