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

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }

        .main-content {
            margin-left: 0;
            width: 100%;
            padding: 20px 15px;
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
            <a href="<?= base_url('admin/datakendaraan') ?>" class="menu-item">Data Kendaraan</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
        <a href="<?= base_url('auth/logout'); ?>">Logout</a>
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
                    <a href="<?= base_url('laporan/export-pdf?' . $query) ?>" class="btn-export-pdf">Export PDF</a>
                    <a href="<?= base_url('laporan/export-excel?' . $query) ?>" class="btn-export-excel">Export Excel</a>
                </div>
            </div>

            <div class="filter-container">
                <form action="<?= site_url('laporan/filter') ?>" method="GET"> 
                    <label>Dari Tanggal:</label>
                    <input type="date" name="start" value="<?= isset($_GET['start']) ? esc($_GET['start']) : '' ?>">
                    <label>Sampai Tanggal:</label>
                    <input type="date" name="end" value="<?= isset($_GET['end']) ? esc($_GET['end']) : '' ?>">
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
                                <td><?= htmlspecialchars($item['tanggal']) ?></td>
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
        const today = new Date();
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

        const formatDate = (date) => {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return ${y}-${m}-${d};
        };

        document.getElementById('startDate').value = formatDate(firstDay);
        document.getElementById('endDate').value = formatDate(lastDay);
    });

    document.getElementById('filterBtn').addEventListener('click', function() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        alert(Filtering data dari ${startDate} sampai ${endDate});
    });
</script>
</body>
</html>