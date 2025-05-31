<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas & Keamanan - GOODBIKE</title>
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

        /* Sidebar Styles - Diambil dari Dashboard */
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

        /* Content Styles - Dimodifikasi dari halaman Log Aktivitas */
        .content {
            flex: 1;
            padding: 30px;
            background-color: #f5f5f7;
            overflow-y: auto;
        }

        .content-header {
            margin-bottom: 30px;
        }

        .content-header h2 {
            font-size: 24px;
            color: #1a3153;
            font-weight: 600;
        }

        .log-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 24px;
        }

        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            align-items: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        label {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        input[type="text"] {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            width: 180px;
        }

        .filter-button {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .filter-button:hover {
            background-color: #1d4ed8;
        }

        .log-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .log-table th {
            background-color: #f8fafc;
            text-align: left;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }

        .log-table td {
            padding: 12px 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }

        .log-table tr:nth-child(even) {
            background-color: #fafafa;
        }

        .status-sukses {
            color: #047857;
            font-weight: 500;
        }

        .status-tinjauan {
            color: #b91c1c;
            font-weight: 500;
        }

        .footer-note {
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
        }

        .warning-text {
            color: #b91c1c;
            font-weight: 500;
        }

        .date-input {
            position: relative;
            display: inline-block;
        }

        .date-input input {
            padding-right: 30px;
            cursor: pointer;
        }

        .date-input::after {
            content: "📅";
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Sidebar - Diambil dari Dashboard -->
    <div class="sidebar">
        <div class="logo">
            <h1>Admin GOODBIKE</h1>
        </div>
        <div class="menu">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item">Dashboard</a>
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/datakendaraan') ?>" class="menu-item">Data Kendaraan</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
            <a href="<?= base_url('admin/statistik') ?>" class="menu-item">Statistik</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
            <a href="<?= base_url('admin/logaktivitas') ?>" class="menu-item active">Log Aktivitas</a>
        </div>
        <div class="logout">
        <a href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
    </div>

    <!-- Content - Diambil dari halaman Log Aktivitas -->
    <div class="content">
        <div class="content-header">
            <h2>Log Aktivitas & Keamanan</h2>
        </div>

        <div class="log-container">
            <div class="filter-container">
                <div class="filter-group">
                    <label for="tanggal">Tanggal:</label>
                    <div class="date-input">
                        <input type="text" id="tanggal" placeholder="hh/bb/tttt">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label for="pengguna">Pengguna:</label>
                    <input type="text" id="pengguna" placeholder="Nama pengguna">
                </div>
                
                <button class="filter-button">Filter</button>
            </div>
            
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Aksi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2025-05-05 10:12</td>
                        <td>admin_bengkel</td>
                        <td>Login</td>
                        <td>Berhasil masuk</td>
                        <td class="status-sukses">Sukses</td>
                    </tr>
                    <tr>
                        <td>2025-05-05 10:15</td>
                        <td>user01</td>
                        <td>Hapus Data</td>
                        <td>Menghapus suku cadang: Kampas Rem</td>
                        <td class="status-tinjauan">Perlu Tinjauan</td>
                    </tr>
                    <tr>
                        <td>2025-05-05 10:17</td>
                        <td>admin_bengkel</td>
                        <td>Edit</td>
                        <td>Update stok oli mesin</td>
                        <td class="status-sukses">Sukses</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="footer-note">
                Aktivitas dengan status "<span class="warning-text">Perlu Tinjauan</span>" menunjukkan potensi tindakan mencurigakan dan harus diperiksa.
            </div>
        </div>
    </div>
</body>
</html>