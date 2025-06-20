<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Bengkel Admin - Laporan & Analitik</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        display: flex;
        background-color: #f5f5f5;
        min-height: 100vh;
    }

    /* Sidebar */
.sidebar {
    width: 215px;
    height: 100vh;
    background-color: white;
    border-right: 1px solid #e0e0e0;
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
}

.logo {
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
    text-align: center;
}

.logo h1 {
    color: #e74c3c;
    font-size: 20px;
    font-weight: 600;
}

.menu {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.menu-item {
    padding: 15px 20px;
    cursor: pointer;
    color: #333;
    transition: background-color 0.2s;
    border-bottom: 1px solid #f5f5f5;
    text-decoration: none;
    display: block;
}

.menu-item:hover,
.menu-item.active {
    background-color: #f8f9fa;
}

.logout {
    border-top: 1px solid #e0e0e0;
    padding: 15px 20px;
    cursor: pointer;
    color: #333;
}

    /* Main Content */
    .main-content {
        margin-left: 215px;
        width: calc(100% - 215px);
        padding: 25px 30px;
        background-color: #f5f5f5;
        min-height: 100vh;
        display: flex;
        justify-content: center;
    }

    .report-container {
        width: 100%;
        max-width: 960px;
        background-color: white;
        border-radius: 6px;
        padding: 30px 35px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    }

    /* Header */
    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-title {
        font-size: 28px;
        color: #333;
        font-weight: 700;
    }

    .export-buttons {
        display: flex;
        gap: 15px;
    }

    .btn-export-pdf,
    .btn-export-excel {
        background-color: #d32f2f;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        transition: background-color 0.3s;
    }

    .btn-export-excel {
        background-color: #2e7d32;
    }

    .btn-export-pdf:hover {
        background-color: #b62828;
    }

    .btn-export-excel:hover {
        background-color: #27662a;
    }

    /* Filter */
    .filter-container {
        display: flex;
        gap: 20px;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .date-range {
        display: flex;
        gap: 10px;
        align-items: center;
        font-weight: 600;
        color: #444;
        font-size: 14px;
        min-width: 200px;
    }

    .date-range label {
        white-space: nowrap;
    }

    .date-input {
        padding: 8px 12px;
        border: 1.5px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
        width: 160px;
    }

    .date-input:focus {
        outline: none;
        border-color: #1976d2;
        box-shadow: 0 0 5px rgba(25, 118, 210, 0.5);
    }

    .btn-filter {
        background-color: #1976d2;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 22px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
        transition: background-color 0.3s;
        white-space: nowrap;
    }

    .btn-filter:hover {
        background-color: #145ea8;
    }

    /* Table */
    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }

    .report-table th {
        background-color: #f9f9f9;
        text-align: left;
        padding: 14px 18px;
        font-weight: 700;
        color: #555;
        border: 1px solid #e0e0e0;
        user-select: none;
    }

    .report-table td {
        padding: 14px 18px;
        border: 1px solid #e0e0e0;
        color: #333;
    }

    .report-table tr:nth-child(even) {
        background-color: #fbfbfb;
    }

    .report-table tr:hover {
        background-color: #f1f7ff;
    }

    /* Total Pendapatan */
    .total {
        margin-top: 25px;
        font-size: 18px;
        font-weight: 700;
        color: #1976d2;
        text-align: right;
        user-select: none;
    }

    /* Footer */
    .report-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 15px;
        border-top: 1px solid #e0e0e0;
    }
    .btn-logout {
        background-color: #d32f2f;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        display: block;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-logout:hover {
        background-color: #b62828;
    }

    /* Responsive */
    @media (max-width: 768px) {
    .sidebar {
        position: fixed;
        width: 180px;
        z-index: 10;
    }

    .main-content {
        margin-left: 180px;
        width: calc(100% - 180px);
        padding: 15px;
    }

        .report-container {
            padding: 20px 20px;
        }

        .filter-container {
            gap: 10px;
        }

        .date-range {
            min-width: unset;
            font-size: 13px;
        }

        .date-input {
            width: 120px;
            font-size: 13px;
        }

        .btn-filter {
            padding: 8px 15px;
            font-size: 13px;
        }

        .page-title {
            font-size: 22px;
        }
    }
</style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h1>Admin GOODBIKE</h1>
        </div>
        <div class="menu">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item active">Dashboard</a>
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item">Manajemen Jadwal</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
<<<<<<< HEAD
            <a href="<?= base_url('auth/logout'); ?>" class="btn-logout">Logout</a>
=======
        <a href="<?= base_url('auth/logout'); ?>">Logout</a>
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="report-container">
            <div class="report-header">
                <h1 class="page-title">Laporan & Analitik</h1>
                <?php
                $start = isset($_GET['start']) ? $_GET['start'] : '';
                $end = isset($_GET['end']) ? $_GET['end'] : '';
                $query = http_build_query(['start' => $start, 'end' => $end]);
                ?>

                <div class="export-buttons">
    <a href="<?= base_url('admin/laporan/export-pdf?' . $query) ?>" class="btn-export-pdf">Export PDF</a>
    <a href="<?= base_url('admin/laporan/export-excel?' . $query) ?>" class="btn-export-excel">Export Excel</a>
        </div>

            </div>

            <div class="filter-container">
                <form action="<?= site_url('admin/laporan/filter') ?>" method="GET">
                    <label>Dari Tanggal:</label>
                    <input type="date" id="startDate" name="start" value="<?= esc($start) ?>">
                    <label>Sampai Tanggal:</label>
                    <input type="date" id="endDate" name="end" value="<?= esc($end) ?>">
                    <button type="submit">Filter</button>
                </form>
            </div>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Kendaraan</th>
                        <th>Jenis Servis</th>
                        <th>Total (IDR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan) && is_array($laporan)): ?>
                        <?php foreach ($laporan as $item): ?>
                            <tr>
                                <td><?= date('Y-m-d', strtotime($item['tanggal'])) ?></td>
                                <td><?= htmlspecialchars($item['nama_pelanggan']) ?></td>
                                <td><?= htmlspecialchars($item['kendaraan']) ?></td>
                                <td><?= htmlspecialchars($item['jenis_servis']) ?></td>
                                <td><?= number_format($item['total'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center; font-style:italic; color:#777;">
                                Tidak ada data laporan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="total">
                Total Pendapatan: Rp <?= isset($total) ? number_format($total, 0, ',', '.') : '0' ?>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() { 
        //Artinya: tunggu sampai halaman selesai dimuat, lalu jalankan kode di dalamnya.Ini penting agar semua elemen HTML seperti input tanggal sudah siap diproses.
        const today = new Date();
        //Membuat objek Date yang berisi waktu saat ini (sekarang).
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        // today.getFullYear() → misalnya 2025

        //today.getMonth() → misalnya 5 (karena bulan dimulai dari 0 = Januari)

        //1 → artinya tanggal 1

        //Jadi ini akan menghasilkan 2025-06-01

        const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        // getMonth() + 1 → pindah ke bulan berikutnya
        // 0 → artinya satu hari sebelum tanggal 1 bulan berikutnya, yaitu hari terakhir bulan sekarang
        // Jadi kalau sekarang Juni, hasilnya 2025-06-30

        const formatDate = (date) => {
            const y = date.getFullYear(); //ambil tahun
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
<<<<<<< HEAD
            //bulan dimulai dari 0, jadi ditambah 1
            // .padStart(2, '0') → kalau hanya 1 digit, ditambah nol di depan. Misalnya 6 jadi 06
            return '${y}-${m}-${d}'; //mengembalikan string seperti2025-06-01
=======
            return ${y}-${m}-${d};
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
        };

        document.getElementById('startDate').value = formatDate(firstDay);
        document.getElementById('endDate').value = formatDate(lastDay);
        // Mengatur nilai input tanggal (yang punya id="startDate" dan id="endDate") secara otomatis saat halaman dimuat.
        // Jadi user langsung dapat rentang tanggal 1 Juni – 30 Juni (misalnya), tanpa memilih manual.
    });

    document.getElementById('filterBtn').addEventListener('click', function() {
        // Setelah fungsi awal selesai, ini menambahkan event listener ke tombol dengan id="filterBtn" agar menjalankan fungsi saat diklik.
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        // Mengambil isi input dari form (tanggal awal dan akhir) saat tombol diklik.

        alert(Filtering data dari ${startDate} sampai ${endDate});
    });
</script>
</body>
</html>