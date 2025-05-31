<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Riwayat Pembayaran</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Metode Pembayaran</th>
                <th>Total</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($payments)): ?>
                <?php foreach($payments as $index => $payment): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $payment['payment_method'] ?></td>
                        <td>Rp <?= number_format($payment['total_amount'], 0, ',', '.') ?></td>
                        <td><?= $payment['payment_status'] ?></td>
                        <td>
                            <?php if($payment['payment_proof']): ?>
                                <a href="<?= base_url($payment['payment_proof']) ?>" target="_blank">Lihat Bukti</a>
                            <?php else: ?>
                                Tidak Ada Bukti
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada riwayat pembayaran</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
