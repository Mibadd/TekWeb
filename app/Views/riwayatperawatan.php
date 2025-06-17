<?= $this->extend('templates/main_template'); ?>
<?= $this->section('content'); ?>

<style>
    body {
        display: flex;
        background-color: #f5f5f5;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    .content {
        width: 100%;
        max-width: 1500px;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: 20px;
    }
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .content-header h2 { margin: 0; font-size: 1.5rem; }
    .table-responsive { overflow-x: auto; }
    .service-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    .service-table th, .service-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
        vertical-align: top;
    }
    .service-table th { background-color: rgb(236, 236, 236); color: #000; }
    .service-table tr:hover { background-color: #f4f4f9; }
    .suku-cadang-riwayat-list { list-style: none; padding: 0; margin: 0; font-size: 0.9em; }
</style>

<div class="content">
<<<<<<< HEAD
    <div class="card">
        <div class="card-title">Riwayat Perawatan Kendaraan</div>

        <?php if (!empty($riwayat)) : ?>
            <div class="table-responsive">
                <table class="excel-table">
                    <thead>
                        <tr>
                            <th>Tanggal Servis</th>
                            <th>Kendaraan</th>
                            <th>Detail Servis</th>
                            <th>Rincian Biaya</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($riwayat as $item): ?>
                            <tr>
                                <td><?= esc(date('d F Y', strtotime($item['tanggal_servis'] ?? 'now'))) ?></td>
                                <td><?= esc($item['jenis_motor']) ?></td>
                                <td>
                                    <strong><?= esc($item['jenis_servis']) ?></strong>
                                    <?php if (!empty($item['suku_cadang'])): ?>
                                        <ul class="suku-cadang-list">
                                            <?php foreach ($item['suku_cadang'] as $sc): ?>
                                                <li><?= esc($sc['nama']) ?> (<?= esc($sc['jumlah']) ?> pcs)</li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    Biaya Jasa: Rp <?= number_format($item['biaya_jasa'], 0, ',', '.') ?>
                                    <?php if (!empty($item['suku_cadang'])): ?>
                                        <ul class="suku-cadang-list">
                                            <?php 
                                            $total_sc = 0;
                                            foreach ($item['suku_cadang'] as $sc) {
                                                $subtotal_sc = $sc['harga'] * $sc['jumlah'];
                                                $total_sc += $subtotal_sc;
                                            }
                                            ?>
                                            <li>Biaya Suku Cadang: Rp <?= number_format($total_sc, 0, ',', '.') ?></li>
                                        </ul>
                                    <?php endif; ?>
                                </td>
                                <td class="total-biaya">
                                    Rp <?= number_format($item['total_bayar'], 0, ',', '.') ?><br>
                                    <small>(via <?= esc($item['metode_bayar']) ?>)</small>
                                </td>
                                <td>
                                    <a href="<?= base_url('/payment/downloadPdf/' . $item['id_payment']) ?>" class="btn-download" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Unduh Resi
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="empty-row">Anda belum memiliki riwayat perawatan.</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .content { padding: 20px; }
    .card { background-color: #fff; border-radius: 8px; padding: 25px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .card-title { font-size: 22px; text-align: center; margin-bottom: 25px; color: #333; font-weight: bold; }
    .table-responsive { overflow-x: auto; }
    .excel-table { width: 100%; border-collapse: collapse; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 14px; }
    .excel-table th, .excel-table td { padding: 12px 15px; border: 1px solid #e1e1e1; text-align: left; vertical-align: top; }
    .excel-table thead th { background-color: #f2f2f2; font-weight: 600; color: #333; }
    .suku-cadang-list { padding-left: 18px; margin: 5px 0 0; list-style-type: '– '; color: #555; }
    .total-biaya { font-weight: bold; color: #27ae60; }
    .total-biaya small { font-weight: normal; font-size: 12px; color: #777; }
    .btn-download {
        display: inline-block;
        padding: 8px 12px;
        background-color: #c0392b;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 13px;
        text-align: center;
        transition: background-color 0.2s;
    }
    .btn-download:hover { background-color: #a93226; }
    .btn-download .fas { margin-right: 5px; }
    .empty-row { text-align: center; font-style: italic; color: #999; padding: 20px; }
</style>

=======
    <div class="content-header">
        <h2>Riwayat Service Saya</h2>
    </div>

    <div class="table-responsive">
        <table class="service-table">
            <thead>
                <tr>
                    <th>Kendaraan</th>
                    <th>Tanggal Service</th>
                    <th>Jenis Service</th>
                    <th>Tindakan dari Mekanik</th>
                    <th>Suku Cadang Terpakai</th>
                </tr>
            </thead>
            <tbody>
    <?php if (!empty($riwayat) && is_array($riwayat)) : ?>
        <?php foreach ($riwayat as $item): ?>
            
            <?php if (is_array($item)): ?>
                <tr>
                    <td><?= esc($item['jenis_motor']); ?></td>
                    <td><?= esc(date('d F Y', strtotime($item['tanggal']))); ?></td>
                    <td><?= esc($item['jenis_servis']); ?></td>
                    <td><?= nl2br(esc($item['tindakan'])); ?></td>
                    <td>
                        <?php if (!empty($item['suku_cadang_dibeli'])): ?>
                            <ul class="suku-cadang-riwayat-list">
                                <?php foreach($item['suku_cadang_dibeli'] as $sc): ?>
                                    <li>- <?= esc($sc['nama']) ?> (<?= esc($sc['jumlah']) ?>x)</li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <span>- Tidak ada suku cadang -</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="background-color: #ffcdd2; color: #c62828;">
                        <strong>Ditemukan data tidak valid (string):</strong>
                        <pre style="white-space: pre-wrap;"><?= esc($item) ?></pre>
                    </td>
                </tr>
            <?php endif; ?>
            <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" style="text-align:center;">Anda belum memiliki riwayat service yang sudah selesai.</td>
        </tr>
    <?php endif; ?>
</tbody>
        </table>
    </div>
</div>

>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
<?= $this->endSection(); ?>