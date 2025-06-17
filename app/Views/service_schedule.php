<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<<<<<<< HEAD
<div class="content">
    <div class="content-header">
        <h2>Jadwal Service Tersedia</h2>
    </div>

    <div class="table-responsive">
        <table class="service-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis Motor</th>
                    <th>Jenis Service</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($schedules)): ?>
                    <?php foreach($schedules as $schedule): ?>
                        <tr>
                            <td data-label="Tanggal"><?= esc(date('d M Y', strtotime($schedule['tanggal']))); ?></td>
                            <td data-label="Jenis Motor"><?= esc($schedule['jenis_motor']); ?></td>
                            <td data-label="Jenis Service"><?= esc($schedule['jenis_servis']); ?></td>
                            <td data-label="Jam"><?= esc($schedule['jam']); ?></td>
                            <td data-label="Status" class="status-<?= strtolower(str_replace(' ', '-', $schedule['status'])); ?>">
                                <?= esc($schedule['status']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada jadwal yang tersedia saat ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    /* (CSS dari file Anda sebelumnya bisa diletakkan di sini) */
=======
<style>
    /* ... CSS Anda yang sudah ada, tidak perlu diubah ... */
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
    body {
        display: flex;
        background-color: #f5f5f5;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    .content {
        width: 100%;
<<<<<<< HEAD
        max-width: 1200px;
=======
        max-width: 1500px;
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
<<<<<<< HEAD
        margin: 20px auto;
    }

    .content-header h2 {
        margin: 0;
        font-size: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

=======
        margin: 20px;
    }
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .content-header h2 { margin: 0; font-size: 1.5rem; }
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
    .service-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
<<<<<<< HEAD
=======
        min-width: 800px;
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
    }
    .service-table th, .service-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
        vertical-align: top;
    }
<<<<<<< HEAD

    .service-table th {
        background-color: #f2f2f2;
        color: #333;
    }
    
    .status-tersedia {
        color: green;
        font-weight: bold;
=======
    .service-table th { background-color: rgb(236, 236, 236); color: #000; }
    .service-table tr:hover { background-color: #f4f4f9; }
    .status-selesai { color: green; font-weight: bold; }
    .status-dibatalkan { color: red; font-weight: bold; }
    .status-belum-dilaksanakan { color: orange; font-weight: bold; }
    .status-sedang-dikerjakan { color: blue; font-weight: bold; }
    .action-buttons { display: flex; flex-direction: column; gap: 5px; }
    .action-buttons a.btn { 
        text-decoration: none;
        padding: 6px 10px; color: white; border-radius: 5px;
        font-size: 14px; display: inline-flex; align-items: center;
        gap: 5px; justify-content: center;
    }
    .btn-info { background-color: #17a2b8; }
    .btn-info:hover { background-color: #138496; }
    .btn-warning { background-color: #ffc107; }
    .btn-warning:hover { background-color: #e0a800; }
    .btn-success { background-color: #28a745; }
    .btn-success:hover { background-color: #218838; }
    .suku-cadang-table-list { list-style: none; padding: 0; margin: 0; font-size: 0.9em; }
    @media (max-width: 768px) {
        .service-table thead { display: none; }
        .service-table tr { display: block; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .service-table td { display: flex; justify-content: space-between; align-items: center; text-align: right; padding-left: 50%; position: relative; border: none; border-bottom: 1px solid #eee; }
        .service-table td:before { content: attr(data-label); position: absolute; left: 15px; width: 45%; padding-right: 10px; font-weight: bold; text-align: left; }
        .service-table td:last-child { border-bottom: 0; }
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
    }
</style>

<div class="content">
    <div class="content-header">
        <h2>Manajemen Jadwal Service</h2>
    </div>

    <div class="table-responsive">
        <table class="service-table">
            <thead>
                <tr>
                    <th>Motor</th>
                    <th>Tanggal & Jam</th>
                    <th>Jenis Service</th>
                    <th>Suku Cadang & Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($schedules)): ?>
                <?php foreach($schedules as $schedule): ?>
                    <tr>
                        <td data-label="Motor"><?= esc($schedule['jenis_motor']); ?></td>
                        <td data-label="Tanggal & Jam"><?= esc(date('d M Y', strtotime($schedule['tanggal']))) ?><br><?= esc($schedule['jam']) ?></td>
                        <td data-label="Jenis Service"><?= esc($schedule['jenis_servis']); ?></td>
                        <td data-label="Suku Cadang & Harga">
                            <?php if (!empty($schedule['suku_cadang_dibeli'])): ?>
                                <ul class="suku-cadang-table-list">
                                    <?php foreach($schedule['suku_cadang_dibeli'] as $item): ?>
                                        <li>- <?= esc($item['nama']) ?> (<?= esc($item['jumlah']) ?>x)</li>
                                    <?php endforeach; ?>
                                </ul>
                                <hr class="my-1">
                            <?php endif; ?>
                            <strong>Total: Rp <?= number_format($schedule['total_harga'], 0, ',', '.') ?></strong>
                        </td>
                        <td data-label="Status" class="status-<?= strtolower(str_replace(' ', '-', $schedule['status'])); ?>">
                            <?= esc($schedule['status']); ?>
                        </td>
                        <td data-label="Aksi">
                            <div class="action-buttons">
                                
                                <?php if(strtolower($schedule['status']) === 'selesai' && $schedule['total_harga'] > 0): ?>
                                    <a href="<?= site_url('payment/form/'.$schedule['id']); ?>" class="btn btn-success"><i class="fa fa-money-bill-wave"></i> <span class="btn-text">Bayar</span></a>
                                <?php endif; ?>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada data jadwal servis.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>