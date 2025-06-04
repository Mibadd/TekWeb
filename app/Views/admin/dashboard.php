<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin GOODBIKE</title>
    <style>
        /* Reset dan font */
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
        overflow: hidden;
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

    .content {
        flex: 1;
        padding: 20px 30px; /* sedikit dikurangi padding vertikal */
        background-color: #f5f5f5;
        height: 100vh;
        overflow-y: auto; /* agar scroll jika konten melebihi */
        display: flex;
        flex-direction: column;
    }

    .content-header {
        margin-bottom: 20px;
        flex-shrink: 0;
    }

    .content-header h2 {
        font-size: 22px;
        color: #333;
        font-weight: 500;
    }

    .stats-container {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-shrink: 0;
    }

    .stat-card {
        background-color: white;
        border-radius: 8px;
        padding: 15px 20px;
        flex: 1;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .stat-card h3 {
        font-size: 13px;
        color: #555;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .stat-card .value {
        font-size: 22px;
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
        gap: 15px;
        margin-bottom: 15px;
        flex-shrink: 0;
        height: 250px; /* batasi tinggi container grafik */
    }

    .chart-card {
        background-color: white;
        border-radius: 8px;
        padding: 15px 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        flex: 1;
        min-height: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #999;
    }

    .chart-card canvas {
        max-height: 200px;
        width: 100% !important;
        height: auto !important;
    }

    .activities-card {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        flex-shrink: 0;
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
        flex-shrink: 0;
    }

    .activity-time {
        font-weight: bold;
        margin-right: 5px;
        color: #555;
        flex-shrink: 0;
        min-width: 55px;
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
                <canvas id="grafikBulanan" width="400" height="200"></canvas>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('grafikBulanan').getContext('2d');
                    const labels = <?= json_encode(array_column($chartData, 'bulan')) ?>;
                    const data = <?= json_encode(array_column($chartData, 'jumlah')) ?>;

                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Servis per Bulan',
                                data: data,
                                backgroundColor: '#42A5F5'
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                </script>
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
