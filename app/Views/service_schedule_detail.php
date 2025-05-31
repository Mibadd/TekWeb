<?= $this->extend('templates/main_template'); ?>
<?= $this->section('content'); ?>

<div class="detail-container">
    <h2 class="detail-header">Detail Jadwal Service</h2>

    <div class="detail-card">
        <ul class="detail-list">
            <li><strong>Tanggal:</strong> <?= esc($schedule['date']); ?></li>
            <li><strong>Jenis Service:</strong> <?= esc($schedule['service_type']); ?></li>
            <li><strong>Status:</strong> 
                <span class="status-label status-<?= strtolower(str_replace(' ', '-', $schedule['status'])); ?>">
                    <?= esc($schedule['status']); ?>
                </span>
            </li>
            <li><strong>Dibuat pada:</strong> <?= esc($schedule['created_at']); ?></li>
            <li><strong>Diperbarui pada:</strong> <?= esc($schedule['updated_at']); ?></li>
        </ul>
    </div>

    <a href="<?= base_url('service-schedule'); ?>" class="btn btn-secondary btn-back">Kembali</a>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }

    .detail-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .detail-header {
        text-align: center;
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .detail-card {
        background: #f5f5f5;
        padding: 15px;
        border-radius: 8px;
    }

    .detail-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .detail-list li {
        font-size: 16px;
        margin-bottom: 10px;
        color: #444;
    }

    .detail-list strong {
        color: #000;
    }

    .status-label {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        color: #fff;
        font-weight: bold;
    }

    .status-belum-dilaksanakan { background-color: #e74c3c; }
    .status-tertunda { background-color: #f39c12; }
    .status-selesai { background-color: #27ae60; }

    .btn-back {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #3498db;
        border: none;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #2980b9;
    }
</style>

<?= $this->endSection(); ?>
