<!-- app/Views/dashboard.php -->
<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>
<h1>Dashboard</h1>

<div class="dashboard-card">
<img src="<?= base_url('image/nmax.jpg'); ?>" alt="Motorcycle" class="bike-img">

    
    <div class="detail-title">Jarak Tempuh</div>
    <div class="detail-value">23.000 km</div>
    <div class="detail-subtitle">Diupdate dari terakhir service</div>
    
    <div class="info-row">
        <div>
            <div style="margin-bottom: 5px;">Terakhir Service:</div>
            <div style="font-weight: bold;">22/09/2024</div>
        </div>
        <div style="text-align: right;">
            <div style="margin-bottom: 5px;">Service Selanjutnya:</div>
            <div style="font-weight: bold;">22/12/2024</div>
        </div>
    </div>
</div>

<div class="service-grid">
    <div class="history-section">
        <div class="section-title">
            <span>Riwayat Perawatan</span>
        </div>
        <ul style="list-style-type: none;">
            <li><span class="cross-icon">✕</span> Service berkala - 20/03/2024</li>
            <li><span class="cross-icon">✕</span> Service berkala - 20/06/2024</li>
            <li><span class="cross-icon">✕</span> Service CVT - 19/07/2024</li>
            <li><span class="cross-icon">✕</span> Service berkala - 22/09/2024</li>
        </ul>
    </div>
    
    <div class="schedule-section">
    <div class="section-title">
        <span>Jadwal Service</span>
        <a href="#" class="section-link">Lihat Jadwal</a>
    </div>
    <ul style="list-style-type: none;">
        <?php if (!empty($latestSchedules)): ?>
            <?php foreach ($latestSchedules as $schedule): ?>
                <li>
                    <span class="check-icon">✓</span>
                    <?= esc(date('d/m/Y', strtotime($schedule['date']))) ?> - <?= esc($schedule['service_type']) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Tidak ada jadwal service.</li>
        <?php endif; ?>
    </ul>
</div>

<?= $this->endSection(); ?>

<style>
    .account-info {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.account-info div {
    margin-bottom: 5px;
}

</style>