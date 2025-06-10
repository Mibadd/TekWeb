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

<?= $this->endSection(); ?>