<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodBike - Manajemen Suku Cadang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        .main-content {
            flex: 1;
            margin-left: 215px;
            padding: 20px;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .page-title {
            font-size: 24px;
            color: #333;
        }
        
        .btn-add {
            background-color: #d32f2f;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        
        .btn-add:hover {
            background-color: #b71c1c;
        }
        
        .btn-add::before {
            content: "+";
            margin-right: 5px;
            font-size: 18px;
        }
        
        .user-table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .user-table th {
            background-color: #f5f5f5;
            text-align: left;
            padding: 12px 15px;
            font-weight: 500;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .user-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .user-table tr:last-child td {
            border-bottom: none;
        }
        
        .action-links {
            display: flex;
            gap: 10px;
        }
        
        .action-links a {
            text-decoration: none;
        }
        
        .edit-link {
            color: #2196f3;
        }
        
        .delete-link {
            color: #d32f2f;
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            width: 500px;
            max-width: 90%;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-title {
            font-size: 18px;
            color: #333;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #666;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .form-select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: white;
        }
        
        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background-color: #d32f2f;
            color: white;
        }
        
        .btn-secondary {
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
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
        <a href="<?= base_url('admin/datakendaraan') ?>" class="menu-item">Data Kendaraan</a>
        <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
        <a href="<?= base_url('admin/statistik') ?>" class="menu-item">Statistik</a>
        <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        <a href="<?= base_url('admin/logaktivitas') ?>" class="menu-item">Log Aktivitas</a>
        </div>
        <div class="logout">
            Logout
        </div>
    </div>
    <div class="main-content">
        <div class="top-bar">
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <i class="fas fa-search"></i>
            </div>
            <div class="user-menu">
                <div class="logo-text">GOODBIKE</div>
                <i class="fas fa-chevron-down"></i>
                <i class="far fa-bell"></i>
            </div>
        </div>

        <div class="parts-management-header">
            <div class="section-title">Manajemen Kendaraan</div>
            <a href="<?= base_url('datakendaraan/add'); ?>" class="add-button">
                <i class="fas fa-plus"></i>
                Tambah Kendaraan
            </a>
        </div>

        <div class="parts-table">
            <table>
                <thead>
                    <tr>
                        <th>Nama Kendaraan</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga (IDR)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Motor A</td>
                        <td>Sport</td>
                        <td class="stock-ok">10</td>
                        <td>Rp 25.000.000</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="edit-btn">Edit</a>
                                <a href="#" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Motor B</td>
                        <td>Cruiser</td>
                        <td class="stock-low">2</td>
                        <td>Rp 30.000.000</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="edit-btn">Edit</a>
                                <a href="#" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
