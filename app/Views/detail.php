<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Detail Permintaan Servis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }
        .service-list {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .service-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            background: #fff;
        }
        .service-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 8px;
            color: #333;
        }
        .price {
            color: #2a9d8f;
        }
        .service-detail p {
            margin: 4px 0;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="service-list">
        <h2>Ringkasan Permintaan Servis</h2>

        <div class="service-card">
            <div class="service-header">
                <span><?= esc($service['vehicle']) ?> - <?= esc($service['service_category']) ?></span>
                <span class="price">Rp<?= number_format($service['price'], 0, ',', '.') ?></span>
            </div>
            <div class="service-detail">
                <p><strong>Tanggal:</strong> <?= esc($service['date']) ?></p>
                <p><strong>Waktu Servis:</strong> <?= esc($service['service_time']) ?></p>
            </div>
        </div>
    </div>
</body>
</html>
