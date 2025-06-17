<!DOCTYPE html>
<html>
<head>
    <title>Resi Pembayaran Servis</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
            color: #333;
        }

        .card {
            border: 1px solid #ccc;
            padding: 25px;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        ul {
            padding-left: 20px;
            margin: 0;
        }

        li {
            margin-bottom: 5px;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #e74c3c;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Resi Pembayaran Servis</h2>

        <div class="section">
            <div class="section-title">Nomor Resi:</div>
            <?= esc($payment['id']) ?>
        </div>

        <div class="section">
            <div class="section-title">Jenis Servis:</div>
            <?= esc($service['jenis_servis']) ?>
        </div>

        <div class="section">
            <div class="section-title">Biaya Servis:</div>
            Rp <?= number_format($service['biaya_jasa'], 0, ',', '.') ?>
        </div>

        <div class="section">
            <div class="section-title">Suku Cadang:</div>
            <?php if (!empty($suku_cadang)): ?>
                <ul>
                    <?php foreach ($suku_cadang as $sc): ?>
                        <li><?= esc($sc['nama']) ?> (<?= esc($sc['jumlah']) ?> × Rp <?= number_format($sc['harga'], 0, ',', '.') ?>)</li>
                    <?php endforeach ?>
                </ul>
            <?php else: ?>
                <p>Tidak ada suku cadang</p>
            <?php endif ?>
        </div>

        <div class="section total">
            Total: Rp <?= number_format($payment['total_amount'], 0, ',', '.') ?>
        </div>

        <div class="section">
            <div class="section-title">Metode Pembayaran:</div>
            <?= esc($payment['payment_method']) ?>
        </div>

        <div class="section">
            <div class="section-title">Tanggal Pembayaran:</div>
            <?= date('d-m-Y', strtotime($payment['created_at'])) ?>
        </div>

        <div class="footer">
            Sistem Servis Motor &copy; <?= date('Y') ?>
        </div>
    </div>
</body>
</html>
