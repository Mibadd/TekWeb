<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard GOODBIKE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f5f5f5;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 200px;
            background-color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .logo {
            color: #D61C1F;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .menu-item {
            padding: 10px 0;
            color: #333;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #eee;
        }
        .menu-item:last-child {
            border-bottom: none;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .dashboard-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 20px;
        }
        .bike-img {
            width: 200px;
            margin: 20px 0;
        }
        .detail-title {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .detail-subtitle {
            font-size: 14px;
            color: #666;
        }
        .history-section, .schedule-section {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .section-title {
            font-size: 18px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .section-link {
            font-size: 14px;
            color: blue;
            text-decoration: none;
        }
        ul {
            list-style-position: inside;
            margin-left: 10px;
        }
        li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .cross-icon {
            color: red;
            margin-right: 8px;
            font-weight: bold;
        }
        .check-icon {
            color: green;
            margin-right: 8px;
            font-weight: bold;
        }
        .service-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        /* Styling for the logout button in sidebar */
        .logout-btn {
            background-color: #D61C1F;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-top: auto;
            text-decoration: none;
            font-weight: bold;
        }
        .logout-btn:hover {
            background-color: #b0171f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">GOODBIKE</div>
            <a href="#" class="menu-item">Dashboard</a>
            <a href="#" class="menu-item">Statistik Service</a>
            <a href="#" class="menu-item">Riwayat Perawatan</a>
            <a href="#" class="menu-item">Jadwal Service</a>
            <div style="margin-top: 10px;"></div>
            <a href="#" class="menu-item">Pengaturan</a>
            <a href="#" class="menu-item">Pembayaran</a>
            <a href="#" class="menu-item">Akun</a>
            <a href="#" class="menu-item">Bantuan</a>
            
            <!-- Logout Button -->
            <a href="<?= base_url('auth/logout'); ?>" class="logout-btn">Logout</a>
        </div>
        <div class="main-content">
            <h1>Dashboard</h1>
            
            <div class="dashboard-card">
                <img src="/api/placeholder/200/150" alt="Motorcycle" class="bike-img">
                
                <div class="detail-title">Jarak Tempuh</div>
                <div class="detail-value">12.345 km</div>
                <div class="detail-subtitle">Diupdate dari terakhir service</div>
                
                <div class="info-row">
                    <div>
                        <div style="margin-bottom: 5px;">Terakhir Service:</div>
                        <div style="font-weight: bold;">22/09/2024</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="margin-bottom: 5px;">Service Selanjutnya:</div>
                        <div style="font-weight: bold;">22/12/2024</div>
                    </div>
                </div>
            </div>
            
            <div class="service-grid">
                <div class="history-section">
                    <div class="section-title">
                        <span>Riwayat Perawatan</span>
                    </div>
                    <ul style="list-style-type: none;">
                        <li><span class="cross-icon">✕</span> Service berkala - 20/03/2024</li>
                        <li><span class="cross-icon">✕</span> Service berkala - 20/06/2024</li>
                        <li><span class="cross-icon">✕</span> Service CVT - 19/07/2024</li>
                        <li><span class="cross-icon">✕</span> Service berkala - 22/09/2024</li>
                    </ul>
                </div>
                
                <div class="schedule-section">
                    <div class="section-title">
                        <span>Jadwal Service</span>
                        <a href="#" class="section-link">Lihat Jadwal</a>
                    </div>
                    <ul style="list-style-type: none;">
                        <li><span class="check-icon">✓</span> 20/03/2024</li>
                        <li><span class="check-icon">✓</span> 20/06/2024</li>
                        <li><span class="check-icon">✓</span> 22/09/2024</li>
                        <li><span class="cross-icon">✕</span> 22/12/2024</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
