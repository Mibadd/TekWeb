<!-- app/Views/riwayatperawatan.php -->
<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            background-color: #f5f5f5;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .content {
            width: 111%;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 15px;
            overflow-x: auto;
        }

        .content-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            table-layout: auto;
            min-width: 600px; /* Ensures table doesn't get too narrow */
        }

        th, td {
            padding: 12px 8px;
            border: 1px solid #ddd;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background-color: rgb(236, 236, 236);
            color: #000;
            position: sticky;
            top: 0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-selesai {
            color: green;
            font-weight: bold;
        }

        .status-tertunda {
            color: orange;
            font-weight: bold;
        }

        .status-belum {
            color: red;
            font-weight: bold;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .content {
                padding: 10px;
                margin: 10px;
            }
            
            th, td {
                padding: 8px 6px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .content-header h2 {
                font-size: 1.3rem;
            }
            
            th, td {
                padding: 6px 4px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="content-header">
            <h2>Riwayat Service</h2>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Kendaraan</th>
                        <th>Tanggal Service</th>
                        <th>Jenis Service</th>
                        <th>Tindakan</th>
                        <th>Suku Cadang</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>XMAX 250</td>
                        <td>2025-05-18</td>
                        <td>Ganti Oli</td>
                        <td>Pembersihan mesin, penggantian oli</td>
                        <td>Oli Mesin 10W-40</td>
                    </tr>
                    <tr>
                        <td>XMAX 250</td>
                        <td>2025-05-17</td>
                        <td>Service Rem</td>
                        <td>Pemeriksaan dan penggantian kampas rem</td>
                        <td>Kampas Rem Depan</td>
                    </tr>
                    <tr>
                        <td>XMAX 250</td>
                        <td>2025-05-16</td>
                        <td>Perbaikan Sistem Kelistrikan</td>
                        <td>Pengecekan kabel dan aki</td>
                        <td>Aki Baru</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?= $this->endSection(); ?>