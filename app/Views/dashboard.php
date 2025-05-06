<!-- app/Views/dashboard.php -->
<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>
<h1>Dashboard</h1>

<div class="dashboard-card">
    <img src="/api/placeholder/200/150" alt="Motorcycle" class="bike-img">
    
    <div class="detail-title">Jarak Tempuh</div>
    <div class="detail-value">12.345 km</div>
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
            <li><span class="check-icon">✓</span> 20/03/2024</li>
            <li><span class="check-icon">✓</span> 20/06/2024</li>
            <li><span class="check-icon">✓</span> 22/09/2024</li>
            <li><span class="cross-icon">✕</span> 22/12/2024</li>
        </ul>
    </div>
</div>

<?= $this->endSection(); ?>
