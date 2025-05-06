<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas & Keamanan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f7;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 24px;
        }

        h1 {
            color: #1a3153;
            font-size: 24px;
            margin-bottom: 24px;
            font-weight: 600;
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
    <div class="container">
        <h1>Log Aktivitas & Keamanan</h1>
        
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
</body>
</html>