<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

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
    body {
        display: flex;
        background-color: #f5f5f5;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .content {
        width: 100%;
        max-width: 1200px;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
    }

    .content-header h2 {
        margin: 0;
        font-size: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .service-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .service-table th, .service-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .service-table th {
        background-color: #f2f2f2;
        color: #333;
    }
    
    .status-tersedia {
        color: green;
        font-weight: bold;
    }
</style>

<?= $this->endSection(); ?>