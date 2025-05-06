<!-- app/Views/jadwalservice.php -->
<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>
<h1>Jadwal Service</h1>

<!-- Tampilkan informasi jadwal service -->
<div class="schedule-section">
    <div class="section-title">
        <span>Jadwal Service</span>
    </div>
    <ul style="list-style-type: none;">
        <li><span class="check-icon">✓</span> 20/03/2024</li>
        <li><span class="check-icon">✓</span> 20/06/2024</li>
        <li><span class="check-icon">✓</span> 22/09/2024</li>
        <li><span class="cross-icon">✕</span> 22/12/2024</li>
    </ul>
</div>

<?= $this->endSection(); ?>
