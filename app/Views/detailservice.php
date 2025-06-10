<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', sans-serif;
        }

        .service-header {
            text-align: center;
            margin: 2rem 0 3rem;
        }

        .service-header h2 {
            font-weight: 700;
            font-size: 2rem;
            color: #1e293b;
            position: relative;
            display: inline-block;
        }

        .service-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            height: 3px;
            width: 60px;
            background-color: #3b82f6;
            border-radius: 2px;
        }

        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            background-color: #ffffff;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
            transition: transform 0.2s ease-in-out;
        }

        .card-custom:hover {
            transform: translateY(-3px);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0f172a;
        }

        .card-text {
            font-size: 0.95rem;
            color: #475569;
        }

        .btn-booking {
            background-color: #3b82f6;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            border: none;
            transition: background-color 0.2s;
        }

        .btn-booking:hover {
            background-color: #2563eb;
        }

        .text-muted {
            font-size: 0.8rem;
        }

        .alert-warning {
            border-radius: 10px;
            text-align: center;
        }
        .suku-cadang-list {
            font-size: 0.9rem;
            padding-left: 1.2rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="service-header">
        <h2>Jadwal Servis</h2>
    </div>

    <div class="row">
        <?php if (!empty($jadwals) && is_array($jadwals)) : ?>
            <?php foreach ($jadwals as $jadwal): ?>
                
                <?php
                    $totalHargaSukuCadang = 0;
                    if (!empty($jadwal['suku_cadang_dibeli'])) {
                        foreach ($jadwal['suku_cadang_dibeli'] as $item) {
                            $totalHargaSukuCadang += ($item['harga'] * $item['jumlah']);
                        }
                    }
                ?>

                <div class="col-md-4 mb-4">
                    <div class="card-custom h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><?= esc($jadwal['jenis_motor']) ?></h5>
                            <p class="card-text mb-2">
                                <strong>Tanggal:</strong> <?= esc(date('d M Y', strtotime($jadwal['tanggal']))) ?><br>
                                <strong>Jam:</strong> <?= esc($jadwal['jam']) ?><br>
                                <strong>Jenis Servis:</strong> <?= esc($jadwal['jenis_servis']) ?><br>
                                <strong>Status:</strong> 
                                <span class="badge bg-<?= strtolower(trim($jadwal['status'])) === 'tersedia' ? 'success' : 'secondary' ?>">
                                    <?= esc($jadwal['status']) ?>
                                </span>
                            </p>

                            <?php if (!empty($jadwal['suku_cadang_dibeli'])): ?>
                                <p class="card-text mb-0 mt-3"><strong>Suku Cadang Terpakai:</strong></p>
                                <ul class="suku-cadang-list">
                                    <?php foreach ($jadwal['suku_cadang_dibeli'] as $item): ?>
                                        <li><?= esc($item['nama']) ?> (<?= esc($item['jumlah']) ?>x)</li>
                                    <?php endforeach; ?>
                                </ul>
                                <p class="card-text mt-2 fw-bold">Sub-Total Suku Cadang: Rp <?= number_format($totalHargaSukuCadang, 0, ',', '.') ?></p>
                            <?php endif; ?>
                            
                            <p class="card-text mt-2 fw-bold">
                                Grand Total Biaya: Rp <?= number_format($jadwal['total_harga'], 0, ',', '.') ?>
                            </p>
                        </div>

                        <div>
                            
                            <?php if (strtolower(trim($jadwal['status'])) === 'tersedia'): ?>
                                <a href="<?= site_url('service/payment-form/' . esc($jadwal['id'])) ?>" class="btn btn-primary mt-3">
                                    Booking
                                </a>
                            <?php endif; ?>
                            
                            <small class="text-muted mt-3 d-block">
                                Terakhir diperbarui: <?= esc(date('d M Y H:i', strtotime($jadwal['updated_at']))) ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    Tidak ada data jadwal servis yang tersedia.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>