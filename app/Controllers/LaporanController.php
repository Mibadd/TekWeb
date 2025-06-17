<?php

namespace App\Controllers;
use App\Models\LaporanModel;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Mengimpor class dari library PhpSpreadsheet untuk membuat dan menulis file Excel.
use Dompdf\Dompdf; // Mengimpor class Dompdf untuk membuat file PDF dari HTML.

class LaporanController extends BaseController
// Mendefinisikan class LaporanController yang merupakan turunan dari BaseController.
{

    protected $laporanModel;
    // Menyimpan instance dari LaporanModel agar bisa digunakan di semua method dalam controller ini.

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
        // Constructor dijalankan otomatis saat class dibuat.
        // Di sini digunakan untuk membuat objek LaporanModel dan menyimpannya ke dalam properti $laporanModel.
    }

    public function index()
{
    $start = $this->request->getGet('start');
    $end = $this->request->getGet('end');

    $laporan = $this->laporanModel->getLaporan($start, $end);

    $total = array_sum(array_column($laporan, 'total'));

    return view('admin/laporan', [
        'laporan' => $laporan,
        'total' => $total
    ]);
}



    public function filter()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        // Mengambil tanggal awal dan akhir dari query string URL (misal: ?start=2024-01-01&end=2024-01-31).

        $model = new LaporanModel();
        $data['laporan'] = $model->getLaporan($start, $end);
        $data['total'] = $model->getTotalPendapatan($start, $end);
        // Mengambil data laporan dan total pendapatan berdasarkan rentang tanggal yang dipilih.
        return view('admin/laporan', $data);
    }

    public function exportPdf()
    {
        require_once ROOTPATH . 'vendor/autoload.php';
        // Memuat file autoload Composer agar bisa menggunakan Dompdf.

        // Ambil parameter filter dari URL
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');

        $model = new LaporanModel();
        $data['laporan'] = $model->getLaporan($start, $end);
        $data['total'] = $model->getTotalPendapatan($start, $end);
        // Mengambil data laporan dan total sesuai tanggal.

        $dompdf = new Dompdf(); // Membuat objek baru Dompdf.
        $html = view('admin/laporan/pdf', $data);
        // Merender view admin/laporan/pdf.php menjadi HTML (siap dikonversi ke PDF)
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // Memuat HTML ke Dompdf, mengatur ukuran dan orientasi kertas, lalu membuat PDF
        $dompdf->stream('laporan.pdf');
        // Menampilkan atau mengunduh file PDF ke browser
    }


    public function exportExcel()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        // Ambil tanggal dari parameter GET.

        $model = new LaporanModel();
        $laporan = $model->getLaporan($start, $end);
        // Ambil data laporan berdasarkan tanggal.

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat file Excel dan aktifkan worksheet.

        $header = ['Tanggal', 'Nama Pelanggan', 'Kendaraan', 'Jenis Servis', 'Total (IDR)'];
        // Menentukan judul kolom untuk laporan.

        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1976D2']
            ],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        // Menambahkan style ke header: huruf tebal, warna biru, teks putih, dan border
        ]);

        $sheet->fromArray($header, NULL, 'A1');
        // Menulis header ke sel A1 sampai E1

        $row = 2;
        foreach ($laporan as $item) {
            $sheet->setCellValue("A{$row}", $item['tanggal']);
            $sheet->setCellValue("B{$row}", $item['nama_pelanggan']);
            $sheet->setCellValue("C{$row}", $item['kendaraan']);
            $sheet->setCellValue("D{$row}", $item['jenis_servis']);
            $sheet->setCellValue("E{$row}", $item['total']);
            $row++;
            // Menulis isi data laporan ke setiap baris, mulai dari baris ke-2
        }

        $sheet->getStyle("A2:A{$row}")->getNumberFormat()->setFormatCode('yyyy-mm-dd');
        $sheet->getStyle("E2:E{$row}")->getNumberFormat()->setFormatCode('#,##0');
        // Format kolom tanggal dan total harga agar lebih rapi

        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
            // Atur lebar kolom agar menyesuaikan otomatis dengan isi
        }

        $filename = 'laporan_' . date('Ymd_His') . '.xlsx';
        // Membuat nama file yang unik berdasarkan waktu saat ini.

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');
        // Mengatur HTTP header agar browser mengenali file ini sebagai Excel dan langsung mengunduh

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
        // Simpan file Excel ke output dan hentikan eksekusi skrip
    }

}
