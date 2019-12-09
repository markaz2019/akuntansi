
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


    public function excel()
    {
        $telkomsel = $this->Export_model->excel()->result();
        $spreadsheet = new Spreadsheet;
        $spreadsheet->getActiveSheet()->mergeCells('B2:K2');
        $spreadsheet->getActiveSheet()->getStyle('B2:k2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('f2dddc');
        $spreadsheet->getActiveSheet()->getStyle('B4:k4')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('d99795');
        $spreadsheet->getActiveSheet()->getStyle('B5:k5')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('d99795');
        //coumn dimension


        //marge

        $spreadsheet->getActiveSheet()->mergeCells('B3:K3');
        $spreadsheet->getActiveSheet()->mergeCells('B4:K4');

        //BORDER
        $spreadsheet->getActiveSheet()->getStyle('B2:k4')
            ->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        $spreadsheet->getActiveSheet()->getStyle('B5:k5')
            ->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B2', '"ASET MARKAZ"')
            ->setCellValue('B3', '09 - Desember 2019')
            ->setCellValue('B4', 'STATUS PENJUALAN MODUL H2H ALL SERVER')
            ->setCellValue('B5', 'No')
            ->setCellValue('C5', 'MODUL')
            ->setCellValue('D5', 'Jml. TRX')
            ->setCellValue('E5', 'SPL')
            ->setCellValue('F5', 'SELISIH TRX')
            ->setCellValue('G5', 'Saldo Awal')
            ->setCellValue('H5', 'Pn2/Deposit')
            ->setCellValue('I5', 'Pemakaian')
            ->setCellValue('J5', 'saldo_akhir_cs')
            ->setCellValue('K5', 'Selisih');
        $kolom = 6;
        $nomor = 1;
        foreach ($telkomsel as $report) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $kolom, $nomor)
                ->setCellValue('C' . $kolom, $report->modul)
                ->setCellValue('D' . $kolom, $report->jml_trx)
                ->setCellValue('E' . $kolom, $report->spl)
                ->setCellValue('F' . $kolom, $report->selisih_trx)
                ->setCellValue('G' . $kolom, $report->saldo_awal)
                ->setCellValue('H' . $kolom, $report->deposit)
                ->setCellValue('I' . $kolom, $report->pemakaian)
                ->setCellValue('J' . $kolom, $report->saldo_akhir_cs)
                ->setCellValue('K' . $kolom, $report->selisih);
            $kolom++;
            $nomor++;
        }
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="test.xls"');
        header("Pragma: no-cache");
        header("Expires: 0");
        $writer->save('php://output');
    }
    //     // dokumen properti
    //     $spreadsheet->getProperties()->setCreator('PT. MARKAZ JALAN BERSAMA')
    //         ->setLastModifiedBy('ADMIN')
    //         ->setTitle('Office 2007 XLSX Test Document')
    //         ->setSubject('Office 2007 XLSX Test Document')
    //         ->setDescription('')
    //         ->setKeywords('office 2007 openxml php')
    //         ->setCategory('Laporan');

    //     $spreadsheet->setActiveSheetIndex(0)
    //         ->setCellValue('A1', 'NOMOR')
    //         ->setCellValue('B1', 'MODUL')
    //         ->setCellValue('C1', 'JUMLAH TRX');

    //     $i = 2;
    //     foreach ($data as $row) {

    //         $spreadsheet->setActiveSheetIndex(0)
    //             ->setCellValue('A' . $i, $row->nomor)
    //             ->setCellValue('B' . $i, $row->modul);
    //         $i++;
    //     }


    //     $spreadsheet->getActiveSheet()->setTitle('Report Excel ' . date('d-m-Y H'));


    //     $spreadsheet->setActiveSheetIndex(0);


    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     header('Cache-Control: max-age=1');

    //     header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    //     header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    //     header('Cache-Control: cache, must-revalidate');
    //     header('Pragma: public');

    //     $writer = IOFactory::createWriter($spreadsheet, 'xls');
    //     $writer->save('php://output');
    //     exit;
    // }


    public function pdf()
    {


        $tanggal = date('d-m-Y', strtotime('yesterday', time()));
        $data = $this->Export_model->pdf()->result();
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Image('./assets/image/logo.png', 30, 8, 30, 0, 'PNG');
        $pdf->SetFont('Arial', '', 15);
        $pdf->Cell(200, 10, 'PT. MARKAZ JALAN BERSAMA', 0, 1, 'C');
        $pdf->Cell(200, 10, 'LAPORAN SPL', 0, 1, 'C');
        $pdf->Cell(200, 10, $tanggal, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 7, '', 0, 1);
        // $pdf->SetMargins(20, 20);
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



        $pdf->SetFont('Arial', '', 9);
        $pdf->SetFillColor(197, 190, 151);
        $pdf->Cell(196, 6, 'TELKOMSEL', 1, 1, 'C', 'COLOR');
        foreach ($data as $row) {
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetFillColor(197, 190, 151);
            $pdf->Cell(5, 6, $row->nomor, 1, 0, 'C', 'color');
            $pdf->Cell(20, 6, $row->modul, 1, 0, 'C');
            $pdf->Cell(21, 6, "Rp " . number_format($row->jml_trx), 1, 0, 'C');
            $pdf->Cell(21, 6, "Rp " . number_format($row->spl), 1, 0, 'C');
            $pdf->Cell(22, 6, "Rp " . number_format($row->jml_trx - $row->spl), 1, 0, 'C');
            $pdf->Cell(21, 6, "Rp " . number_format($row->saldo_awal), 1, 0, 'C');
            $pdf->Cell(21, 6, "Rp " . number_format($row->deposit), 1, 0, 'C');
            $pdf->Cell(21, 6, "Rp " . number_format($row->pemakaian), 1, 0, 'C');
            $pdf->Cell(21, 6, "Rp " . number_format($row->saldo_akhir_cs), 1, 0, 'C');
            $pdf->Cell(23, 6, "Rp " . number_format($row->saldo_akhir_cs + $row->pemakaian - $row->deposit - $row->saldo_awal), 1, 1, 'C');
        }

        //TOTAL
        $data = $this->Export_model->pdf_total()->result();
        $pdf->SetFillColor(217, 151, 149);
        $pdf->Cell(25, 6, 'TOTAL', 1, 0, 'C', 'color');
        foreach ($data as $row) {
            $pdf->Cell(21, 6, "Rp " . number_format($row->jml_trx), 1, 0, 'C', 'color');
            $pdf->Cell(21, 6, '', 1, 0, 'C', 'color');
            $pdf->Cell(22, 6, '', 1, 0, 'C', 'color');
            $pdf->Cell(21, 6, "Rp " . number_format($row->saldo_awal), 1, 0, 'C', 'color');
            $pdf->Cell(21, 6, "Rp " . number_format($row->deposit), 1, 0, 'C', 'color');
            $pdf->Cell(21, 6, "Rp " . number_format($row->pemakaian), 1, 0, 'C', 'color');
            $pdf->Cell(21, 6, "Rp " . number_format($row->saldo_akhir_cs), 1, 0, 'C', 'color');
            $pdf->Cell(23, 0, '', 1, 0, 'C');
        }


        //mlink
        $pdf->Cell(190, 7, '', 0, 1, 'C');
        $tanggal = date('d-m-Y', time());
        $data = $this->Export_model->pdf_mlink()->result();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(190, 7, '', 0, 1, 'C');
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
            $pdf->Cell(22, 6, "Rp " . number_format($row->jml_trx), 1, 0, 'C');
            $pdf->Cell(22, 6, "Rp " . number_format($row->spl), 1, 0, 'C');
            $pdf->Cell(24, 6, "Rp " . number_format($row->saldo_awal), 1, 0, 'C');
            $pdf->Cell(22, 6, "Rp " . number_format($row->deposit), 1, 0, 'C');
            $pdf->Cell(22, 6, "Rp " . number_format($row->pemakaian), 1, 0, 'C');
            $pdf->Cell(22, 6, "Rp " . number_format($row->saldo_akhir_cs), 1, 0, 'C');
            $pdf->Cell(22, 6, "Rp " . number_format($row->selisih), 1, 1, 'C');
        }

        //TOTAL MLINK
        $data = $this->Export_model->pdf_total_mlink()->result();
        $pdf->SetFillColor(184, 204, 228);
        $pdf->Cell(40, 6, '', 1, 0, 'C', 'color');
        foreach ($data as $row) {
            $pdf->Cell(22, 6, "Rp " . number_format($row->jml_trx), 1, 0, 'C', 'color');
            $pdf->Cell(22, 6, "Rp " . number_format($row->jml_trx - $row->spl), 1, 0, 'C', 'color');
            $pdf->Cell(24, 6, '', 1, 0, 'C', 'color');
            $pdf->Cell(22, 6, '', 1, 0, 'C', 'color');
            $pdf->SetTextColor(156, 0, 6);
            $pdf->Cell(22, 6, "Rp " . number_format($row->pemakaian), 1, 0, 'C', 'color');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(22, 6, '', 1, 0, 'C', 'color');
            $pdf->Cell(22, 6, '', 1, 1, 'C', 'color');
        }
        $pdf->SetFillColor(217, 151, 149);
        $pdf->Cell(40, 6, 'TOTAL', 1, 0, 'C', 'color');
        foreach ($data as $row) {
            $pdf->Cell(22, 6, '', 1, 0, 'C', 'color');
            $pdf->Cell(22, 6, '', 1, 0, 'C', 'color');
            $pdf->Cell(24, 6, '', 1, 0, 'C', 'color');
            $pdf->Cell(22, 6, '', 1, 0, 'C', 'color');
            $pdf->SetTextColor(156, 0, 6);
            $pdf->Cell(22, 6, "Rp " . number_format($row->pemakaian), 1, 0, 'C', 'color');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(22, 6, '', 1, 0, 'C', 'color');
            $pdf->Cell(22, 6, '', 1, 1, 'C', 'color');
        }

        $pdf->Cell(196, 0, '', 1, 1, 'C', '');
        //KISEL BARU
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
        $pdf->Cell(196, 6, 'HITUNGAN KISEL BARU', 1, 1, 'C', 'color');
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
        $pdf->SetFont('Arial', '', 6);
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
        $data = $this->Export_model->pdf_kisel_stockakhir()->result();
        $pdf->Cell(25, 6, 'STOCK AKHIR', 1, 0, 'C', 'color');
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



        //KISEL SELISIH CS

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
        $pdf->Cell(196, 6, 'KISEL BARU (selisih ss CS dan hitungan)', 1, 1, 'C', 'color');
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
        $pdf->SetFont('Arial', '', 6);
        $pdf->Cell(25, 6, 'SS CS', 1, 0, 'C', 'color');
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
        $pdf->Cell(25, 6, 'HITUNGAN', 1, 0, 'C', 'color');
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
        $pdf->Cell(25, 6, 'SELISIH', 1, 0, 'C', 'color');
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
