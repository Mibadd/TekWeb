<?php

namespace App\Controllers;
use App\Models\LaporanModel;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class LaporanController extends BaseController
{

    protected $laporanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function index()
    {
        $model = new LaporanModel();
        $data['laporan'] = $this->laporanModel->getLaporan();
        $data['total'] = $this->laporanModel->getTotalPendapatan();
        return view('admin/laporan', $data);
    }


    public function filter()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');

        $model = new LaporanModel();
        $data['laporan'] = $model->getLaporan($start, $end);
        $data['total'] = $model->getTotalPendapatan($start, $end);
        return view('admin/laporan', $data);
    }

    public function exportPdf()
    {
        require_once ROOTPATH . 'vendor/autoload.php';

        // Ambil parameter filter dari URL
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');

        $model = new LaporanModel();
        $data['laporan'] = $model->getLaporan($start, $end);
        $data['total'] = $model->getTotalPendapatan($start, $end);

        $dompdf = new Dompdf();
        $html = view('admin/laporan/pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan.pdf');
    }


    public function exportExcel()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');

        $model = new LaporanModel();
        $laporan = $model->getLaporan($start, $end);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $header = ['Tanggal', 'Nama Pelanggan', 'Kendaraan', 'Jenis Servis', 'Total (IDR)'];

        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1976D2']
            ],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);

        $sheet->fromArray($header, NULL, 'A1');

        $row = 2;
        foreach ($laporan as $item) {
            $sheet->setCellValue("A{$row}", $item['tanggal']);
            $sheet->setCellValue("B{$row}", $item['nama_pelanggan']);
            $sheet->setCellValue("C{$row}", $item['kendaraan']);
            $sheet->setCellValue("D{$row}", $item['jenis_servis']);
            $sheet->setCellValue("E{$row}", $item['total']);
            $row++;
        }

        $sheet->getStyle("A2:A{$row}")->getNumberFormat()->setFormatCode('yyyy-mm-dd');
        $sheet->getStyle("E2:E{$row}")->getNumberFormat()->setFormatCode('#,##0');

        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'laporan_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

}
