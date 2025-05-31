<?php

namespace App\Controllers;
use App\Models\LaporanModel;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class LaporanController extends BaseController
{
    public function index()
    {
        $model = new LaporanModel();
        $data['laporan'] = $model->getLaporan();
        $data['total'] = $model->getTotalPendapatan();
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

        $model = new LaporanModel();
        $data['laporan'] = $model->getLaporan();
        $data['total'] = $model->getTotalPendapatan();

        $dompdf = new Dompdf();
        $html = view('admin/laporan/pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan.pdf');
    }

    public function exportExcel()
    {
        
        $model = new LaporanModel();
        // Ambil data (bisa pakai filter tanggal jika mau)
        $laporan = $model->getLaporan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header tabel
        $header = ['Tanggal', 'Nama Pelanggan', 'Kendaraan', 'Jenis Servis', 'Total (IDR)'];

        // Styling header
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                       'startColor' => ['rgb' => '1976D2']],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);

        // Isi header
        $sheet->fromArray($header, NULL, 'A1');

        // Isi data mulai dari baris 2
        $row = 2;
        foreach ($laporan as $item) {
            $sheet->setCellValue("A{$row}", $item['tanggal']);
            $sheet->setCellValue("B{$row}", $item['nama_pelanggan']);
            $sheet->setCellValue("C{$row}", $item['kendaraan']);
            $sheet->setCellValue("D{$row}", $item['jenis_servis']);
            $sheet->setCellValue("E{$row}", $item['total']);
            $row++;
        }

        // Format kolom tanggal dan total
        $sheet->getStyle("A2:A{$row}")->getNumberFormat()
            ->setFormatCode('yyyy-mm-dd');

        $sheet->getStyle("E2:E{$row}")->getNumberFormat()
            ->setFormatCode('#,##0');

        // Auto size kolom
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output file
        $filename = 'laporan_' . date('Ymd_His') . '.xlsx';

        // Set header response agar langsung download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
