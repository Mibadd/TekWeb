<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin GOODBIKE</title>
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
            height: 100vh;
        }

        .sidebar {
            width: 215px;
            height: 100vh;
            background-color: white;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
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
            flex-direction: column; /* Susunan vertikal */
        }

        .menu-item {
            padding: 15px 20px;
            cursor: pointer;
            color: #333;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f5f5f5;
            text-decoration: none; /* Hilangkan underline */
            display: block; /* Pastikan menu memenuhi lebar penuh */
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

        .content {
            flex: 1;
            padding: 30px;
            background-color: #f5f5f5;
        }

        .content-header {
            margin-bottom: 30px;
        }

        .content-header h2 {
            font-size: 24px;
            color: #333;
            font-weight: 500;
        }

        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .stat-card .value {
            font-size: 28px;
            font-weight: bold;
        }

        .stat-card .value.red {
            color: #e74c3c;
        }

        .stat-card .value.yellow {
            color: #f39c12;
        }

        .stat-card .value.green {
            color: #27ae60;
        }

        .charts-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            flex: 1;
            min-height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #999;
        }

        .activities-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .activities-header {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .activity-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: #555;
        }

        .activity-icon {
            width: 24px;
            height: 24px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            color: #6c757d;
            font-size: 12px;
        }

        .activity-time {
            font-weight: bold;
            margin-right: 5px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Admin GOODBIKE</h1>
        </div>
        <div class="menu">
        <a href="<?= base_url('admin/dashboard') ?>" class="menu-item active">Dashboard</a>
        <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
        <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item">Manajemen Jadwal</a>
        <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
        <a href="<?= base_url('admin/statistik') ?>" class="menu-item">Statistik</a>
        <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
        <a href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
    </div>

    <div class="content">
        <div class="content-header">
            <h2>Dashboard</h2>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Servis</h3>
                <div class="value red"><?= $totalServices ?></div>
            </div>
            <div class="stat-card">
                <h3>Antrean Hari Ini</h3>
                <div class="value yellow"><?= $pendingRequests ?></div>
            </div>
            <div class="stat-card">
                <h3>Pendapatan</h3>
                <div class="value green">Rp <?= number_format($income, 0, ',', '.') ?></div>
            </div>
        </div>

        <div class="charts-container">
            <div class="chart-card">
                [ Grafik Servis Bulanan ]
            </div>
            <div class="chart-card">
                [ Grafik Suku Cadang / Pendapatan ]
            </div>
        </div>

        <div class="activities-card">
            <div class="activities-header">Aktivitas Terakhir</div>
            <div class="activity-item">
                <div class="activity-icon">●</div>
                <span class="activity-time">[08:15]</span>
                <span>Admin menambahkan data kendaraan baru.</span>
            </div>
            <div class="activity-item">
                <div class="activity-icon">●</div>
                <span class="activity-time">[08:40]</span>
                <span>Stok oli berkurang - notifikasi dikirim.</span>
            </div>
            <div class="activity-item">
                <div class="activity-icon">●</div>
                <span class="activity-time">[09:00]</span>
                <span>Pengguna baru ditambahkan oleh Admin2.</span>
            </div>
        </div>
    </div>
</body>
</html>
