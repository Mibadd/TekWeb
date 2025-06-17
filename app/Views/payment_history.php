<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Resi Pembayaran Servis</h2>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title mb-3">Detail Pembayaran</h5>

            <div class="mb-2">
                <strong>Nomor Resi:</strong> <?= esc($payment['id']) ?>
            </div>
            <div class="mb-2">
    <strong>Jenis Servis:</strong> <?= esc($service['jenis_servis']) ?>
</div>
<div class="mb-2">
    <strong>Harga Servis:</strong> Rp <?= number_format($service['biaya_jasa'], 0, ',', '.') ?>
</div>


            <div class="mb-3">
                <strong>Suku Cadang:</strong>
                <?php if (!empty($suku_cadang)): ?>
                    <div class="table-responsive mt-2">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($suku_cadang as $sc): ?>
                                    <tr>
                                        <td><?= esc($sc['nama']) ?></td>
                                        <td><?= esc($sc['jumlah']) ?></td>
                                        <td>Rp <?= number_format($sc['harga'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($sc['harga'] * $sc['jumlah'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted mt-2">Tidak ada suku cadang</p>
                <?php endif ?>
            </div>

            <div class="mb-2">
                <strong>Total:</strong> Rp <?= number_format($payment['total_amount'], 0, ',', '.') ?>
            </div>
            <div class="mb-2">
                <strong>Metode Pembayaran:</strong> <?= esc($payment['payment_method']) ?>
            </div>
            <div class="mb-3">
                <strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($payment['created_at'])) ?>
            </div>

            <a href="<?= base_url("/payment/downloadPdf/{$payment['id']}") ?>" class="btn btn-primary" target="_blank">
                Download PDF
            </a>
        </div>
    </div>
</div>
</body>
</html>
