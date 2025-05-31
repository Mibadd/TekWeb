<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODBIKE - Statistik Bengkel</title>
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
            height: 100vh;
        }

        /* Sidebar styles dari dashboard.php */
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

        /* Content styles dari statistik.php */
        .content {
            flex: 1;
            padding: 30px;
            background-color: #f5f5f7;
            overflow-y: auto;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 24px;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 36px;
            flex-wrap: wrap;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            padding: 16px;
            border-radius: 8px;
        }

        .stat-card.blue {
            background-color: #e6f0ff;
        }

        .stat-card.yellow {
            background-color: #fff9e6;
        }

        .stat-card.green {
            background-color: #e6f7ef;
        }

        .stat-label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
        }

        .stat-card.blue .stat-value {
            color: #1a56db;
        }

        .stat-card.yellow .stat-value {
            color: #b45309;
        }

        .stat-card.green .stat-value {
            color: #047857;
        }

        .chart-container {
            margin-top: 20px;
            padding: 10px;
        }

        h2 {
            color: #333;
            font-size: 18px;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .chart {
            height: 300px;
            position: relative;
            margin-top: 20px;
        }

        .chart-line {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .chart-grid {
            position: absolute;
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-template-rows: repeat(10, 1fr);
        }

        .grid-line {
            border-bottom: 1px solid #e5e5e5;
        }

        .grid-line:last-child {
            border-bottom: none;
        }

        .x-axis {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .x-label {
            flex: 1;
            text-align: center;
            color: #666;
            font-size: 13px;
        }

        .y-axis {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .y-label {
            color: #666;
            font-size: 12px;
            transform: translateY(-50%);
        }

        .legend {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-left: 20px;
            font-size: 14px;
            color: #666;
        }

        .legend-color {
            width: 16px;
            height: 2px;
            margin-right: 8px;
            background-color: #3DB9A6;
        }

        svg {
            width: 100%;
            height: 100%;
            overflow: visible;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .sidebar {
                display: none; /* Hide sidebar on mobile */
                width: 100%;
                height: auto;
            }
            
            .content {
                padding: 15px;
            }
            
            .dashboard-container {
                padding: 15px;
            }
            
            .stats-container {
                flex-direction: column;
            }
            
            .mobile-menu-toggle {
                display: block !important;
                position: fixed;
                top: 10px;
                right: 10px;
                z-index: 100;
                background-color: #e74c3c;
                color: white;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            }
        }

        .mobile-menu-toggle {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar dari dashboard.php -->
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

    <!-- Konten dari statistik.php -->
    <div class="content">
        <button class="mobile-menu-toggle" id="show-mobile-nav">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="dashboard-container">
            <h1>Monitoring Statistik Bengkel</h1>
            
            <div class="stats-container">
                <div class="stat-card blue">
                    <div class="stat-label">Servis Hari Ini</div>
                    <div class="stat-value">17</div>
                </div>
                
                <div class="stat-card yellow">
                    <div class="stat-label">Antrean Saat Ini</div>
                    <div class="stat-value">5</div>
                </div>
                
                <div class="stat-card green">
                    <div class="stat-label">Pendapatan Hari Ini</div>
                    <div class="stat-value">Rp 2.350.000</div>
                </div>
            </div>
            
            <h2>Grafik Servis Mingguan</h2>
            
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-color"></div>
                    <span>Jumlah Servis</span>
                </div>
            </div>
            
            <div class="chart">
                <!-- Grid lines -->
                <div class="chart-grid">
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                </div>
                
                <!-- Y-axis labels -->
                <div class="y-axis">
                    <div class="y-label">18</div>
                    <div class="y-label">16</div>
                    <div class="y-label">14</div>
                    <div class="y-label">12</div>
                    <div class="y-label">10</div>
                    <div class="y-label">8</div>
                    <div class="y-label">6</div>
                    <div class="y-label">4</div>
                    <div class="y-label">2</div>
                    <div class="y-label">0</div>
                </div>
                
                <!-- Line chart -->
                <svg>
                    <path d="M40,180 Q90,100 130,90 T240,210 T350,120 T460,40 T570,160 T680,230" 
                          fill="none" 
                          stroke="#3DB9A6" 
                          stroke-width="3" 
                          stroke-linecap="round" 
                          stroke-linejoin="round"/>
                    
                    <circle cx="40" cy="180" r="4" fill="#3DB9A6"/>
                    <circle cx="130" cy="90" r="4" fill="#3DB9A6"/>
                    <circle cx="240" cy="210" r="4" fill="#3DB9A6"/>
                    <circle cx="350" cy="120" r="4" fill="#3DB9A6"/>
                    <circle cx="460" cy="40" r="4" fill="#3DB9A6"/>
                    <circle cx="570" cy="160" r="4" fill="#3DB9A6"/>
                    <circle cx="680" cy="230" r="4" fill="#3DB9A6"/>
                </svg>
            </div>
            
            <!-- X-axis labels -->
            <div class="x-axis">
                <div class="x-label">Senin</div>
                <div class="x-label">Selasa</div>
                <div class="x-label">Rabu</div>
                <div class="x-label">Kamis</div>
                <div class="x-label">Jumat</div>
                <div class="x-label">Sabtu</div>
                <div class="x-label">Minggu</div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.getElementById('show-mobile-nav').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            if (sidebar.style.display === 'none' || sidebar.style.display === '') {
                sidebar.style.display = 'flex';
                sidebar.style.position = 'fixed';
                sidebar.style.zIndex = '99';
                sidebar.style.top = '0';
                sidebar.style.left = '0';
            } else {
                sidebar.style.display = 'none';
            }
        });

        // Check for mobile view
        function checkMobileView() {
            if (window.innerWidth <= 768) {
                document.getElementById('show-mobile-nav').style.display = 'block';
            } else {
                document.getElementById('show-mobile-nav').style.display = 'none';
                document.querySelector('.sidebar').style.display = 'flex';
                document.querySelector('.sidebar').style.position = 'static';
            }
        }

        // Initial check and event listener for resize
        window.addEventListener('resize', checkMobileView);
        checkMobileView();
    </script>
</body>
</html>