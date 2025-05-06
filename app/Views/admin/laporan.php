<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        
        .report-container {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .page-title {
            font-size: 24px;
            color: #333;
        }
        
        .export-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn-export-pdf {
            background-color: #d32f2f;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
        }
        
        .btn-export-excel {
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
        }
        
        .filter-container {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .date-range {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .date-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            width: 150px;
        }
        
        .btn-filter {
            background-color: #1976d2;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
        }
        
        .report-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .report-table th {
            background-color: #f5f5f5;
            text-align: left;
            padding: 12px 15px;
            font-weight: 500;
            color: #333;
            border: 1px solid #e0e0e0;
        }
        
        .report-table td {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }
        
        .report-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        
        .report-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        
        .total-amount {
            font-size: 16px;
            font-weight: 500;
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
            <a href="<?= base_url('admin/statistik') ?>" class="menu-item">Statistik</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
            <a href="<?= base_url('admin/logaktivitas') ?>" class="menu-item">Log Aktivitas</a>
        </div>
        <div class="logout">
            Logout
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="report-container">
            <div class="report-header">
                <h1 class="page-title">Laporan & Analitik</h1>
                <div class="export-buttons">
                    <button class="btn-export-pdf" id="exportPDF">Export PDF</button>
                    <button class="btn-export-excel" id="exportExcel">Export Excel</button>
                </div>
            </div>
            
            <div class="filter-container">
                <div class="date-range">
                    <label for="startDate">Dari Tanggal:</label>
                    <input type="date" id="startDate" class="date-input" placeholder="hh/bb/tttt">
                </div>
                <div class="date-range">
                    <label for="endDate">Sampai Tanggal:</label>
                    <input type="date" id="endDate" class="date-input" placeholder="hh/bb/tttt">
                </div>
                <button class="btn-filter" id="filterBtn">Filter</button>
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
                    <tr>
                        <td>2025-05-01</td>
                        <td>Budi Santoso</td>
                        <td>Yamaha NMAX</td>
                        <td>Ganti Oli</td>
                        <td>75.000</td>
                    </tr>
                    <tr>
                        <td>2025-05-02</td>
                        <td>Ayu Wulandari</td>
                        <td>Honda Vario</td>
                        <td>Servis Lengkap</td>
                        <td>150.000</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="report-footer">
                <div class="total-amount">Total Pendapatan: Rp 225.000</div>
            </div>
        </div>
    </div>

    <script>
        // Initialize date inputs with placeholders
        document.addEventListener('DOMContentLoaded', function() {
            // Set default date range (current month)
            const today = new Date();
            const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
            const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            
            // Format dates for input
            const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };
            
            document.getElementById('startDate').value = formatDate(firstDay);
            document.getElementById('endDate').value = formatDate(lastDay);
        });
        
        // Filter button action
        document.getElementById('filterBtn').addEventListener('click', function() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            
            // In a real application, this would fetch data from a server
            alert(`Filtering data from ${startDate} to ${endDate}`);
        });
        
        // Export buttons actions
        document.getElementById('exportPDF').addEventListener('click', function() {
            alert('Exporting report as PDF...');
            // In a real application, this would generate and download a PDF
        });
        
        document.getElementById('exportExcel').addEventListener('click', function() {
            alert('Exporting report as Excel...');
            // In a real application, this would generate and download an Excel file
        });
        
        // Active menu item
        document.querySelectorAll('.sidebar-menu li').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.sidebar-menu li').forEach(el => el.classList.remove('active'));
                item.classList.add('active');
            });
        });
    </script>
</body>
</html>