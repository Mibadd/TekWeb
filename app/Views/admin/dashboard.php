<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - GOODBIKE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --sidebar-width: 215px;
            --primary-color: #e74c3c;
            --secondary-color: #34495e;
            --background-color: #f5f5f7;
            --card-bg: #ffffff;
            --text-dark: #333;
            --text-light: #555;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { display: flex; background-color: var(--background-color); }
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--card-bg);
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            position: fixed;
        }
        .logo { padding: 20px 0; border-bottom: 1px solid #e0e0e0; text-align: center; }
        .logo h1 { color: var(--primary-color); font-size: 20px; font-weight: 600; }
        .menu { flex: 1; }
        .menu-item { padding: 15px 20px; color: var(--text-dark); text-decoration: none; display: block; border-bottom: 1px solid #f5f5f5; transition: background-color 0.2s; }
        .menu-item:hover, .menu-item.active { background-color: #f8f9fa; }
        .logout { padding: 15px 20px; }
        .btn-logout { background-color: #d32f2f; color: white; padding: 10px 20px; border-radius: 5px; display: block; text-align: center; font-weight: 600; text-decoration: none; transition: background-color 0.3s; }
        .btn-logout:hover { background-color: #b62828; }
        .content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            height: 100vh;
            overflow-y: auto;
            padding: 25px;
        }
        .content-header { margin-bottom: 25px; }
        .content-header h2 { font-size: 24px; color: var(--text-dark); font-weight: 600; }
        .content-header p { color: var(--text-light); }
        .stats-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 25px; }
        .stat-card { background-color: var(--card-bg); border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); }
        .stat-card h3 { font-size: 14px; color: var(--text-light); margin-bottom: 8px; font-weight: 500; }
        .stat-card .value { font-size: 24px; font-weight: bold; }
        .stat-card .value.red { color: #e74c3c; }
        .stat-card .value.yellow { color: #f39c12; }
        .stat-card .value.green { color: #27ae60; }
        .charts-container { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px; }
        .chart-card { background-color: var(--card-bg); border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .chart-card h4 { font-size: 16px; margin-bottom: 15px; color: var(--text-dark); }
        .activities-card { background-color: var(--card-bg); border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .activity-item { display: flex; align-items: center; margin-bottom: 15px; color: var(--text-light); gap: 10px; }
        .activity-item:last-child { margin-bottom: 0; }
        .text-danger { color: #dc3545 !important; }
        .text-warning { color: #fd7e14 !important; }

        @media (max-width: 992px) {
            .charts-container { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .sidebar { position: static; width: 100%; height: auto; }
            .content { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"><h1>Admin GOODBIKE</h1></div>
        <div class="menu">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item active">Dashboard</a>
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item">Manajemen Jadwal</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
            <a href="<?= base_url('auth/logout'); ?>" class="btn-logout">Logout</a>
        </div>
    </div>

    <div class="content">
        <div class="content-header">
            <h2>Admin Dashboard</h2>
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
                <h3>Pendapatan (All Time)</h3>
                <div class="value green">Rp <?= number_format($income, 0, ',', '.') ?></div>
            </div>
        </div>

        <div class="charts-container">
            <div class="chart-card">
                <h4>Grafik Servis Bulanan</h4>
                <canvas id="grafikBulanan"></canvas>
            </div>
            <div class="chart-card">
                <h4>Grafik Pendapatan Bulanan</h4>
                <canvas id="grafikPendapatan"></canvas>
            </div>
        </div>
        
        <div class="activities-card">
            <h4>Notifikasi Stok Suku Cadang Rendah</h4>
            <?php if (!empty($stokMenipis)): ?>
                <?php foreach ($stokMenipis as $item): ?>
                    <div class="activity-item">
                        <?php
                            $stok = (int)$item['stok'];
                            $nama = esc($item['nama']);
                            $icon = $stok == 0 ? '⚠️' : '🔔';
                            $colorClass = $stok == 0 ? 'text-danger' : 'text-warning';
                            $message = $stok == 0 ? "Stok <strong>{$nama}</strong> habis!" : "Stok <strong>{$nama}</strong> menipis, sisa <strong>{$stok}</strong> pcs.";
                        ?>
                        <span><?= $icon ?></span>
                        <div class="flex-grow-1 <?= $colorClass ?>"><?= $message ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Tidak ada notifikasi stok menipis saat ini.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Data dari PHP
        const chartLabels = <?= json_encode(array_column($chartData, 'bulan')) ?>;
        const serviceData = <?= json_encode(array_column($chartData, 'jumlah')) ?>;
        const incomeLabels = <?= json_encode(array_column($incomeChartData, 'bulan')) ?>;
        const incomeData = <?= json_encode(array_column($incomeChartData, 'total')) ?>;

        // Grafik Jumlah Servis
        new Chart(document.getElementById('grafikBulanan'), {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Servis',
                    data: serviceData,
                    backgroundColor: 'rgba(52, 152, 219, 0.7)',
                    borderColor: 'rgba(52, 152, 219, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });

        // Grafik Pendapatan
        new Chart(document.getElementById('grafikPendapatan'), {
            type: 'line',
            data: {
                labels: incomeLabels,
                datasets: [{
                    label: 'Pendapatan',
                    data: incomeData,
                    backgroundColor: 'rgba(39, 174, 96, 0.2)',
                    borderColor: 'rgba(39, 174, 96, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { callback: value => 'Rp ' + new Intl.NumberFormat('id-ID').format(value) }
                    }
                }
            }
        });
    </script>
</body>
</html>
